<?php

namespace petcircle\wangdian\results;

/**
 * 7.查询订单接口 (根据订单修改时间)
 */
class QueryTradeByMTimeResult extends BaseResult
{
    /**
     * @var integer 查询到的单据数
     */
    public $TotalCount;

    /**
     * @var array 货品商家编号
     */
    public $TradeList;
}