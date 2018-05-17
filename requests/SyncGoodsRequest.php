<?php

namespace petcircle\wangdian\requests;

/**
 * 12.查询ERP货品信息
 */
class SyncGoodsRequest extends AbstractRequest
{
    /**
     * 必填
     * @var string 货品编号
     */
    public $GoodsNO;

    /**
     * 必填
     * @var string 货品名称
     */
    public $GoodsName;


    /**
     * @var float 重量(kg)
     */
    public $Weight;

    /**
     * @var float 单价(元)
     */
    public $Price;

    /**
     * @var 条码
     */
    public $Bracode;

    /**
     * @var array Sku 列表
     */
    public $SkuList;
}