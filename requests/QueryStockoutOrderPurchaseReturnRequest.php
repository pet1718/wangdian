<?php

namespace petcircle\wangdian\requests;

/**
 * 13.查询ERP采购退货出库单信息
 *
 */
class QueryStockoutOrderPurchaseReturnRequest extends AbstractRequest
{
    /**
     * 必填
     * @var string 开始时间
     */
    public $StartTime;

    /**
     * 必填
     * @var string 结束时间
     */
    public $EndTime;

    /**
     * @var string 采购单状态
     */
    public $StockoutStatus;

    /**
     * @var integer 页码, 大于0的整数
     */
    public $PageNO;

    /**
     * @var integer 每页条数, 取值范围1-30
     */
    public $PageSize;
}