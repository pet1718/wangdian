<?php

namespace petcircle\wangdian\results;


class BaseResult extends AbstractResult
{
    const RESULT_CODE_SUCCESS = 0;

    public $ResultCode;

    public $ResultMsg;


    /*
     * 是否成功
     */
    public function isSuccess()
    {
        return $this->ResultCode == self::RESULT_CODE_SUCCESS;
    }
}