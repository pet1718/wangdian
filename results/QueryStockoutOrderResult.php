<?php

namespace petcircle\wangdian\results;

/**
 * 10.查询详细出库单接口
 */
class QueryStockoutOrderResult extends BaseResult
{
    /**
     * @var integer 符合条件的总单据数
     */
    public $TotalCount;

    /**
     * @var array 单据信息
     */
    public $OrderList;
}