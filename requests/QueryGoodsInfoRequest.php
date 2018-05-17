<?php

namespace petcircle\wangdian\requests;

class QueryGoodsInfoRequest extends AbstractRequest
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
     * @var string ERP内部商品编号
     */
    public $GoodsNO;

    /**
     * @var string 商品编码 (旺店通内商品唯一标识)
     */
    public $SkuCode;

    /**
     * @var integer 页码, 大于0的整数
     */
    public $PageNO;

    /**
     * @var integer 每页条数, 取值范围1-30
     */
    public $PageSize;
}