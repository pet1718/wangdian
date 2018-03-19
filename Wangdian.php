<?php

namespace petcircle\wangdian;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use petcircle\wangdian\exceptions\HttpResponseException;

/**
 * 旺店通sdk
 *
 * @author Atans
 */
class Wangdian
{

    /**
     * 订单状态:
     * 10未确认(等待付款的订单,cod订单不需要等付款，直接进行待发货)
     * 20待尾款(部分付款的订单,要等尾款付完再发货)
     * 30已付款待发货(包含货到付款)
     * 40部分发货(拆分发货才会出现)
     * 50已发货(平台上订单状态已经发货)
     * 60已签收
     * 70已完成
     * 80已退款(付过款后来全部退款了)
     * 90已关闭(未付款直接取消的订单)
     */

    const TRADE_STATUS_UNCONFIRMED       = 10; // 10未确认(等待付款的订单,cod订单不需要等付款，直接进行待发货)
    const TRADE_STATUS_PARTIALLY_PAID    = 20; // 20待尾款(部分付款的订单,要等尾款付完再发货)
    const TRADE_STATUS_PAID_UNSHIPPED    = 30; // 30已付款待发货(包含货到付款)
    const TRADE_STATUS_PARTIALLY_SHIPPED = 40; // 30已付款待发货(包含货到付款)
    const TRADE_STATUS_SHIPPED           = 50; // 50已发货(平台上订单状态已经发货)
    const TRADE_STATUS_RECEIVED          = 60; // 60已签收
    const TRADE_STATUS_COMPLETED         = 70; // 70已完成
    const TRADE_STATUS_REFUNDED          = 80; // 80已退款(付过款后来全部退款了)

    /**
     * 付款状态:
     * 0未付款
     * 1部分付款
     * 2已付款
     * */
    const PAY_STATUS_UNPAID         = 0; // 0未付款
    const PAY_STATUS_PARTIALLY_PAID = 1; // 1部分付款
    const PAY_STATUS_PAID           = 2; // 2已付款

    /**
     * 发货条件:
     * 1款到发货
     * 2货到付款(包含部分货到付款)
     */
    const DELIVERY_TERM_CBD = 1; // 1款到发货
    const DELIVERY_TERM_COD = 2; // 2货到付款(包含部分货到付款)

    /**
     * API HOST
     *
     * @var string
     */
    private $apiHost = 'http://api.wangdian.cn';

    /**
     * @var string
     */
    private $appSecret;

    /**
     * @var sid
     */
    private $sid;

    /**
     * @var app key
     */
    private $appKey;

    /**
     * @var shop no
     */
    private $shopNo;

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var string
     */
    private $logFile = './wangdian.log';

    /**
     * @var Logger
     */
    private $logger;

    /**
     * Wangdian constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        foreach ($config as $key => $value) {
            if (isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * 1.原订单推送
     *
     * @param array $ata
     * @return array
     * @throws HttpResponseException
     */
    public function tradePush($ata)
    {
        return $this->post($this->getApiUrl('openapi2/trade_push.php'), $data);
    }

    /**
     * 4.库存查询
     *
     * @param array $ata
     * @return array
     * @throws HttpResponseException
     */
    public function stockQuery($ata)
    {
        return $this->post($this->getApiUrl('openapi2/stock_query.php'), $data);
    }

    /**
     * 6.订单查询
     *
     * @param array $data
     * @return array
     * @throws HttpResponseException
     */
    public function tradeQuery($data)
    {
        return $this->post($this->getApiUrl('openapi2/trade_query.php'), $data);
    }

    /**
     * 7.创建货品档案
     *
     * @param array $data
     * @return array
     * @throws HttpResponseException
     */
    public function goodsPush($data)
    {
        return $this->post($this->getApiUrl('openapi2/goods_push.php'), $data);
    }

    /**
     * Post request
     *
     * @param string $url
     * @param array $postData
     * @param int $retry
     * @return array
     * @throws HttpResponseException
     */
    public function post($url, $postData, $retry = 2)
    {
        $postData['sid']       = $this->sid;
        $postData['appkey']    = $this->appKey;
        $postData['shop_no']   = $this->shopNo;
        $postData['timestamp'] = time();

        // array value to json
        foreach ($postData as $key => &$value) {
            if (is_array($value)) {
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            }
        }

        // 加sign
        $this->makeSign($postData, $this->appSecret);

        $logger = $this->getLogger();

        $logger->info(sprintf("Request: %s:", $url), $postData);

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        do {
            $content = curl_exec($handle);
            $retry--;
        } while(($http_code = curl_getinfo($handle, CURLINFO_HTTP_CODE)) != 200 && $retry);

        if ($http_code != 200) {
            $this->getLogger()->error(sprintf("\n%s: %s\n\n", $http_code, $content));

            throw new HttpResponseException(sprintf(
                "Http code: %s message: '%s'",
                $http_code,
                $content
            ));
        }

        curl_close($handle);

        $logger->info(sprintf("Response: %s %s", $url, $content));

        if ($response = json_decode($content, true)) {
            return $response;
        }

        return $content;
    }

    /**
     * @return Logger
     * @throws \Exception
     */
    public function getLogger()
    {
        if (! $this->logger instanceof  Logger) {
            $logger = new Logger();

            $level = $this->debug ? Logger::DEBUG : Logger::ERROR;

            $logger->pushHandler(new StreamHandler($this->logFile, $level));

            $this->logger = $logger;
        }

        return $this->logger;
    }

    /**
     * 计算sign值
     *
     * @param array $req
     * @param string $app_secret
     */
    protected function makeSign(&$req, $app_secret)
    {
        $sign = md5($this->packData($req) . $app_secret);
        $req['sign'] = $sign;
    }

    /**
     * @param array $req
     * @return string
     */
    protected function packData(&$req)
    {
        ksort($req);//先排序

        $converted = [];
        foreach($req as $key => $value)
        {
            if($key == 'sign') {
                continue;
            }

            if(count($converted)) {
                $converted[] = ';';
            }

            //键key的长度用2位数字表示
            $converted[] = sprintf("%02d", iconv_strlen($key, 'UTF-8'));
            $converted[] = '-';
            $converted[] = $key;
            $converted[] = ':';

            //值value的长度用4位数字表示
            $converted[] = sprintf("%04d", iconv_strlen($value, 'UTF-8'));
            $converted[] = '-';
            $converted[] = $value;
        }

        return implode('', $converted);
    }

    /**
     * 拼接API
     *
     * @param string $uri
     * @return string
     */
    protected function getApiUrl($uri)
    {
        return rtrim($this->apiHost, '/') . '/' . ltrim($uri, '/');
    }
}