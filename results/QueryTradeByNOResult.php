<?php

namespace petcircle\wangdian\results;

/**
 * 6.查询订单接口 (根据订单编号)
 */
class QueryTradeByNOResult extends BaseResult
{
    /**
     * @var string ERP 内订单编号
     */
    public $TradeNO;

    /**
     * @var string 来源单号
     */
    public $TradeNO2;

    /**
     * @var string 支付单号
     */
    public $ChargeID;

    /**
     * @var string 仓库编号
     */
    public $WarehouseNO;

    /**
     * @var string 订单创建时间
     */
    public $RegTime;

    /**
     * @var string 交易时间
     */
    public $TradeTime;

    /**
     * @var string 付款时间
     */
    public $PayTime;

    /**
     * @var string 审单时间
     */
    public $ChkTime;

    /**
     * @var string 出库时间
     */
    public $StockOutTime;

    /**
     * @var string 发货时间
     */
    public $sndTime;

    /**
     * @var string 最后修改时间
     */
    public $LastModifyTime;

    /**
     * @var string 订单状态
     */
    public $TradeStatus;

    /**
     * @var string 退款状态
     */
    public $RefundStatus;

    /**
     * @var string 是否需要发票
     */
    public $bInvoice;

    /**
     * @var string 发票抬头
     */
    public $InvoiceTitle;

    /**
     * @var string 发票内容
     */
    public $InvoiceContent;

    /**
     * @var string 客户网名
     */
    public $NickName;

    /**
     * @var string 收件人姓名
     */
    public $SndTo;

    /**
     * @var string 收件人国家
     */
    public $Country;

    /**
     * @var string 收件人省份
     */
    public $Province;

    /**
     * @var string 收件人城市
     */
    public $City;

    /**
     * @var string 收件人区县
     */
    public $Town;

    /**
     * @var string 收件人地址
     */
    public $Adr;

    /**
     * @var string 收件人电话
     */
    public $Tel;

    /**
     * @var string 收件人邮编
     */
    public $Zip;

    /**
     * @var string 是否打印快递单
     */
    public $bPrintExpress;

    /**
     * @var string 付款方式
     */
    public $ChargeType;

    /**
     * @var integer 货品数量
     */
    public $SellSkuCount;

    /**
     * @var float 货品总额
     */
    public $GoodsTotal;

    /**
     * @var float 应收邮费
     */
    public $PostageTotal;

    /**
     * @var float 订单总优惠
     */
    public $FavourableTotal;

    /**
     * @var float 应收金额
     */
    public $AllTotal;

    /**
     * @var string 物流公司编码
     */
    public $LogisticsCode;

    /**
     * @var string 预计到货时间
     */
    public $ConfirmStatus;

    /**
     * @var string 称重时间
     */
    public $WeightTime;

    /**
     * @var float 预估重量
     */
    public $EstimateWeight;

    /**
     * @var float 实际重量
     */
    public $Weight;

    /**
     * @var string 货运单号
     */
    public $PostID;

    /**
     * @var string 买家留言
     */
    public $CustomerRemark;

    /**
     * @var string 卖家备注
     */
    public $Remark;

    /**
     * @var string 平台类型
     */
    public $ShopType;

    /**
     * @var string 平台商店名称
     */
    public $ShopName;

    /**
     * @var string ERP 订单标记名称
     */
    public $TradeFlag;

    /**
     * @var string 审单员名称
     */
    public $ChkOperatorName;

    /**
     * @var array
     */
    public $DetailList;
}