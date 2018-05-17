<?php

namespace petcircle\wangdian\requests;

/**
 * 6.查询订单接口 (根据订单编号)
 */
class QueryTradeByNORequest extends AbstractRequest
{
    /**
     * @var string ERP 内单据编号
     */
    public $OrderCode;

}