<?php

namespace petcircle\wangdian\results;

class QueryStorageResult extends BaseResult
{
    /**
     * @var string 查询的货品总数量
     */
    public $TotalCount;

    /**
     * @var string 仓库编号
     */
    public $WarehouseNO;

    /**
     * @var array 货品明细
     */
    public $ItemList;
}