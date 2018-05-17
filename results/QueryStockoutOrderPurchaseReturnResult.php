<?php

namespace petcircle\wangdian\results;

/**
 * 13.查询ERP采购退货出库单信息
 */
class QueryStockoutOrderPurchaseReturnResult extends BaseResult
{
    /**
     * @var integer 符合条件的总单据数
     */
    public $TotalCount;

    /**
     * @var array 采购单列表
     */
    public $StockoutOrderList;
}