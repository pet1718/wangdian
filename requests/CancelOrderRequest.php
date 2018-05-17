<?php

namespace petcircle\wangdian\requests;

/**
 * 2.取消单据接口
 */
class CancelOrderRequest extends AbstractRequest
{
    /**
     * @var ERP 内单据编号
     */
    public $OrderCode;

    /**
     * @var 单据类型 (1是订单 ,2是采购单)
     */
    public $OrderType;

    /**
     * @var string 取消原因
     */
    public $Reason;

    /**
     * @var string 签出后是否拦截
     */
    public $Log;
}