<?php

namespace petcircle\wangdian;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use petcircle\wangdian\exceptions\Exception;
use petcircle\wangdian\exceptions\HttpResponseException;
use petcircle\wangdian\requests\AbstractRequest;
use petcircle\wangdian\requests\CancelOrderRequest;
use petcircle\wangdian\requests\NewOrderRequest;
use petcircle\wangdian\requests\QueryGoodsInfoRequest;
use petcircle\wangdian\requests\QueryStockoutOrderPurchaseRequest;
use petcircle\wangdian\requests\QueryStockoutOrderRequest;
use petcircle\wangdian\requests\QueryStorageRequest;
use petcircle\wangdian\requests\QueryTradeByMTimeRequest;
use petcircle\wangdian\requests\QueryTradeByNORequest;
use petcircle\wangdian\requests\SyncGoodsRequest;
use petcircle\wangdian\requests\SyncLogisticsRequest;
use petcircle\wangdian\requests\SyncStorageRequest;
use petcircle\wangdian\results\BaseResult;
use petcircle\wangdian\results\NewOrder;

/**
 * 旺店通標準版sdk
 *
 * @author Atans
 */
class Standard
{
    /**
     * 出入库类型标记（0普通入库，1普通出库，2采购入库，3销售订单）
     */
    const OUT_INT_FLAG_NORMAL_IN      = '0';
    const OUT_INT_FLAG_NORMAL_OUT     = '1';
    const OUT_INT_FLAG_PURCHASE_ORDER = '2';
    const OUT_INT_FLAG_SALES_ORDER    = '3';

    /**
     * 货到付款标记，0为不需要货到付款，1为需要货到付款
     */
    const COD_FLAG_FLASE = 0;
    const COD_FLAG_TRUE = 1;

    // 订单状态
    const TRADE_STATUS_CANCEL_TRADE    = 'cancel_trade';
    const TRADE_STATUS_PRE_TRADE       = 'pre_trade';
    const TRADE_STATUS_CHECK_TRADE     = 'check_trade';
    const TRADE_STATUS_FINANCE_TRADE   = 'fanance_trade';
    const TRADE_STATUS_WAIT_SEND_TRADE = 'wait_send_trade';
    const TRADE_STATUS_OVER_TRADE      = 'over_trade';

    //  退款状态
    const REFUND_STATUS_TRADE_NO_REFUND         = 'trade_no_refund';
    const REFUND_STATUS_TRADE_WAIT_SELLER_AGREE = 'wait_seller_agree';
    const REFUND_STATUS_TRADE_PART_REFUNDED     = 'trade_part_refunded';
    const REFUND_STATUS_TRADE_REFUNDED          = 'trade_refunded';

    // 付款方式
    const CHARGE_TYPE_SECURED_TRRANSACTIONS = 1; // 担保交易
    const CHARGE_TYPE_BANK_RECEIPTS         = 2; // 银行收款
    const CHARGE_TYPE_CASH                  = 3; // 现金收款
    const CHARGE_TYPE_COD                   = 4; // 货到付款
    const CHARGE_TYPE_CREDITED              = 5; // 欠款记应收
    const CHARGE_TYPE_PREPAYMENT            = 6; // 客户预存款

    /**
     * API HOST
     *
     * @var string
     */
    private $apiHost;

    /**
     * @var string
     */
    private $key;

    /**
     * @var sid
     */
    private $sellerId;

    /**
     * @var shop no
     */
    private $interfaceId;

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var string
     */
    private $logFile = './wangdian_standard.log';

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
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * 1.创建单据接口
     *
     * @param array $content
     * @return \petcircle\wangdian\results\NewOrder
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function newOrder(NewOrderRequest $request)
    {
        return $this->post(__FUNCTION__, $request);
    }

    /**
     * 2.取消单据接口
     *
     * @param CancelOrderRequest $request
     * @return \petcircle\wangdian\results\BaseResult
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function cancelOrder(CancelOrderRequest $request)
    {
        return $this->post(__FUNCTION__, $request);
    }

    /**
     * 3.查询货品库存信息
     *
     * @param QueryStorageRequest $requet
     * @return \petcircle\wangdian\results\QueryStorage
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function queryStorage(QueryStorageRequest $requet)
    {
        return $this->post(__FUNCTION__, $requet);
    }

    /**
     * 5.库存同步接口
     *
     * @param SyncStorageRequest $request
     * @return \petcircle\wangdian\results\QueryStorage
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function syncStorage(SyncStorageRequest $request)
    {
        return $this->post(__FUNCTION__, $request);
    }

    /**
     * 6.查询订单接口(根据订单编号)
     *
     * @param QueryTradeByNORequest $request
     * @return \petcircle\wangdian\results\QueryTradeByNO
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function queryTradeByNO(QueryTradeByNORequest $request)
    {
        return $this->post(__FUNCTION__, $request);
    }

    /**
     * 7.查询订单接口(根据订单修改时间)
     *
     * @param QueryTradeByNORequest $request
     * @return \petcircle\wangdian\results\QueryTradeByNO
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function queryTradeByMTime(QueryTradeByMTimeRequest $request)
    {
        return $this->post(__FUNCTION__, $request);
    }

    /**
     * 8.订单物流同步接口
     *
     * @param SyncLogisticsRequest $request
     * @return mixed|BaseResult
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function syncLogistics(SyncLogisticsRequest $request)
    {
        return $this->post(__FUNCTION__, $request);
    }

    /**
     * 9.货品信息同步接口
     *
     * @param SyncGoodsRequest $request
     * @return mixed|BaseResult
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function syncGoods(SyncGoodsRequest $request)
    {
        return $this->post(__FUNCTION__, $request);
    }

    /**
     * 10.查询详细出库单接口
     *
     * @param QueryStockoutOrderRequest $request
     * @return mixed|BaseResult
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function queryStockoutOrder(QueryStockoutOrderRequest $request)
    {
        return $this->post(__FUNCTION__, $request);
    }

    /**
     * 11.查询详细入库单接口
     *
     * @param QueryStockinOrderRequest $request
     * @return mixed|BaseResult
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function queryStockinOrder(QueryStockinOrderRequest $request)
    {
        return $this->post(__FUNCTION__, $request);
    }

    /**
     * 12.查询ERP货品信息
     *
     * @param QueryGoodsInfoRequest $request
     * @return mixed|BaseResult
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function queryGoodsInfo(QueryGoodsInfoRequest $request)
    {
        return $this->post(__FUNCTION__, $request);
    }

    /**
     * 13.查询ERP采购退货出库单信息
     *
     * @param QueryStockoutOrderPurchaseReturnRequest $request
     * @return mixed|BaseResult
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function queryStockoutOrderPurchaseReturnRequest(QueryStockoutOrderPurchaseReturnRequest $request)
    {
        return $this->post(__FUNCTION__, $request);
    }

    /**
     * @param string $method
     * @param AbstractRequest $request
     * @return mixed|\petcircle\wangdian\results\BaseResult
     * @throws HttpResponseException
     * @throws \Exception
     */
    public function post($method, AbstractRequest $request)
    {
        $method = ucfirst($method);

        $key = $this->key;

        $jsonedContent = (string) $request;

        $sign = base64_encode(md5($jsonedContent . $key));

        $data = [
            'Method'      => $method,
            'SellerID'    => $this->sellerId,
            'InterfaceID' => $this->interfaceId,
            'Content'     => $jsonedContent,
            'Sign'        => $sign,
        ];

        foreach ($data as $key => &$value) {
            $value = urlencode($value);
        }

        $url = $this->apiHost;

        if ($this->debug) {
            $this->getLogger()->info(sprintf("Request: %s:", $url), $data);
        }

        $post_data = http_build_query($data);
        $length = strlen($post_data);

        $handle = curl_init();
        curl_setopt($handle,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle,CURLOPT_HTTPHEADER,array("Content-Type: application/x-www-form-urlencoded","Content-length: ".$length));

        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle,CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $retry = 1;
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

        if ($this->debug) {
            $this->getLogger()->info(sprintf("Response: %s %s", $url, $content));
        }

        $resultClass = sprintf('\petcircle\wangdian\results\%sResult', $method);

        // 未定義用默認的BaseResult
        if (class_exists($resultClass)) {
            $resultClass = '\petcircle\wangdian\results\BaseResult';
        }

        if ($response = json_decode($content, true)) {
            return new $resultClass($response);
        }

        throw new Exception('Error response');
    }

    /**
     * @return Logger
     * @throws \Exception
     */
    public function getLogger()
    {
        if (! $this->logger instanceof  Logger) {
            $logger = new Logger('wangdian_standard');

            $level = $this->debug ? Logger::DEBUG : Logger::ERROR;

            $logger->pushHandler(new StreamHandler($this->logFile, $level));

            $this->logger = $logger;
        }

        return $this->logger;
    }
}