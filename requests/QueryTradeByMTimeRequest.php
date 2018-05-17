<?php

namespace petcircle\wangdian\requests;

/**
 * 7.查询订单接口 (根据订单修改时间)
 */
class QueryTradeByMTimeRequest extends AbstractRequest
{
    /**
     * @var string 查询修改时间满足的起始时间
     */
    public $StartTime;

    /**
     * @var string 查询修改时间满足的中止时间
     */
    public $EndTime;


    /**
     * @var string 订单状态
     */
    public $TradeStatus;

    /**
     * @var integer 页码 大于0的整数
     */
    public $PageNO;

    /**
     * @var integer 每页条数, 取值范围1-40
     */
    public $PageSize;
}