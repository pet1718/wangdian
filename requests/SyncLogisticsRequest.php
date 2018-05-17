<?php

namespace petcircle\wangdian\requests;

/**
 * 8.订单物流同步接口
 */
class SyncLogisticsRequest extends AbstractRequest
{
    /**
     * 必填
     * @var string ERP订单编号
     */
    public $TradeCode;

    /**
     * @var string 物流方式编号或者名称
     */
    public $LogisticsCode;


    /**
     * @var string 物流单号
     */
    public $LogisticsNumber;

    /**
     * @var string 操作类型，默认为0
     * 0 只同步发货信息不扣减库存
     * 1 同步发货信息并扣减库存
     */
    public $Type;
}