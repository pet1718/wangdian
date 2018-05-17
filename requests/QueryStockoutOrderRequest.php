<?php

namespace petcircle\wangdian\requests;

class QueryStockoutOrderRequest extends AbstractRequest
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
     * @var integer 不填查询所有类型， 1 查询销售出库单
     */
    public $type;

    /**
     * @var integer 页码, 大于0的整数
     */
    public $PageNO;

    /**
     * @var integer 每页条数, 取值范围1-30
     */
    public $PageSize;
}