<?php

namespace Service;

class JsonEncoder implements EncoderInterface
{
    protected $data = array();

    public function setData(array $data)
    {
        foreach ($data as $key => $value) {
            if (is_object($value)) {
                $array = array();
                $reflect = new ReflectionObject($value);

                foreach ($reflect->getProperties() as $prop) {
                    $prop->setAccessible(true);
                    $array[$prop->getName()] =
                        $prop->getValue($value);
                }
                $data[$key] = $array;
            }
        }

        $this->data = $data;
        return $this;
    }

    public function encode()
    {
        return array_map("json_encode", $this->data);
    }
}