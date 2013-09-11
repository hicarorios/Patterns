<?php

namespace Service;

class Serializer implements EncoderInterface
{
    protected $data = array();

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function encode()
    {
        return array_map("serialize", $this->data);
    }
}