<?php

namespace Service;

class Serializer implements EncoderInterface
{
    protected $data = array();

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function encode()
    {
        return array_map("serialize", $this->data);
    }
}