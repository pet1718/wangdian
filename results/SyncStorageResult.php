<?php

namespace petcircle\wangdian\results;

/**
 * 5.库存同步接口
 */
class SyncStorageResult extends BaseResult
{
    /**
     * @var string 仓库编号
     */
    public $WarehouseNO;

    /**
     * @var string 货品商家编号
     */
    public $Sku_Code;


    /**
     * @var string 外部编码 Sku_Code 二选一
     */
    public $Outer_Code;

    /**
     * @var string 需要同步的数量
     */
    public $Qty;
}