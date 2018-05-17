<?php

namespace petcircle\wangdian\results;


abstract class AbstractResult
{
    public $data;

    /**
     * constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        if (! empty($data)) {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            }
        }
    }
}