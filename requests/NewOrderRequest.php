<?php

namespace petcircle\wangdian\requests;

/**
 * 1.创建单据接口
 */
class NewOrderRequest extends AbstractRequest
{
    /**
     * 必填
     * @var integer 出入库类型标记
     * @see Standard
     */
    public $OutInFlag;

    /**
     * 必填
     * @var 外部订单编号
     */
    public $IF_OrderCode;

    /**
     * 必填
     * @var string 仓库编号
     */
    public $WarehouseNO;

    /**
     * @var string 备注
     */
    public $Remark;

    /**
     * @var string 出入库原因
     */
    public $TheCause;

    /**
     * @var string 供应商编号
     */
    public $ProviderNO;

    /**
     * @var string 供应商名称
     */
    public $ProviderName;

    /**
     * @var string 供应商联系人
     */
    public $LinkMan;

    /**
     * @var string 供应商电话
     */
    public $LinkManTel;

    /**
     * @var string 供应商地址
     */
    public $LinkManAdr;

    /**
     * @var string 业务员编号
     */
    public $RegOperatorNO;

    /**
     * 必填
     * @var float 货款合计
     */
    public $GoodsTotal;

    /**
     * @var string 优惠金额
     */
    public $FavourableTotal;

    /**
     * @var 其他费用
     */
    public $OtherFee;

    /**
     * @var integer 货到付款标记
     */
    public $COD_Flag;

    /**
     * @var float 订单付款金额 (含运费) （出库时非空）
     */
    public $OrderPay;

    /**
     * @var float 运费 (出库时非空)
     */
    public $LogisticsPay;

    /**
     * @var string 物流公司编号
     */
    public $LogisticsCode;

    /**
     * @var string 订单所属店铺名称 (出库时非空)
     */
    public $shopName;

    /**
     * @var string 客户平台昵称
     */
    public $NickName;

    /**
     * @var string 收货人改名 （出库时非空）
     */
    public $BuyerName;

    /**
     * @var string 收货人邮编  （出库时非空）
     */
    public $BuyerPostCode;

    /**
     * @var string 收货人联系方式
     */
    public $BuyerTel;

    /**
     * @var string 收货人所在省 （出库时非空）
     */
    public $BuyerProvince;

    /**
     * @var string 收货人所在市 （出库时非空）
     */
    public $BuyerCity;

    /**
     * @var string 收货人所在区、县 （出库时非空）
     */
    public $BuyerDistract;

    /**
     * @var string 收货人地址 （出库时非空）
     */
    public $BuyerAddr;

    /**
     * @var string 收货人Email
     */
    public $BuyerEmail;

    /**
     * @var string 是否需要发票
     */
    public $NeedInvoice;

    /**
     * @var string 发票抬头
     */
    public $InvoiceTitle;

    /**
     * @var string 发票内容
     */
    public $InvoiceContent;

    /**
     * @var integer 货品详细的项目数量
     */
    public $ItemCount;

    /**
     * @var string 付款时间
     */
    public $PayTime;

    /**
     * @var string 交易时间
     */
    public $TradeTIme;

    /**
     * @var 支付单号
     */
    public $ChargeID;

    /**
     * @var array 货品明细
     */
    public $ItemList;
}