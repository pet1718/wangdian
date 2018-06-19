<?php

namespace petcircle\wangdian\requests;


abstract class AbstractRequest
{
    /**
     * constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (! empty($data)) {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Object to array
     *
     * @return array
     */
    public function toArray()
    {
        $fields = get_object_vars($this);
        $fields = array_keys($fields);

        $data = [];
        foreach ($fields as $field) {
            if (! is_null($this->$field)) {
                $data[$field] = $this->$field;
            }
        }

        return $data;
    }

    /**
     * to json
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
    }
}