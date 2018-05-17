<?php

namespace petcircle\wangdian\requests;

class QueryStorageRequest extends AbstractRequest
{
    /**
     * 必填
     * @var 仓库编号
     */
    public $WarehouseNO;

    /**
     * @var 货品商家编号
     */
    public $Sku_Code;

    /**
     * @var string 指定页码
     */
    public $PageNO;

    /**
     * @var string 货品编号
     */
    public $GoodsNO;

    /**
     * @var string 开始时间
     */
    public $StartTime;

    /**
     * @var 结束时间
     */
    public $EndTime;
}