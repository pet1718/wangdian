<?php

namespace petcircle\wangdian\requests;


abstract class AbstractRequest
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

    /**
     * Object to array
     *
     * @return array
     */
    public function toArray()
    {
        $fields = get_object_vars($this);
        $fields = array_combine($fields, $fields);

        $data = [];
        foreach ($fields as $field) {
            $data[$field] = $this->$field;
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
        return json_encode($this->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


}