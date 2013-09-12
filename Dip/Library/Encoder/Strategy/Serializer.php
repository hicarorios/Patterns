<?php

namespace Library\Encoder\Strategy;

class Serializer implements \Library\File\EncoderInterface
{
    protected $unserializeCallback;

    public function __construct($unserializeCallback = false)
    {
        $this->unserializeCallback = (boolean) $unserializeCallback;
    }

    public function getUnserializeCallback()
    {
        return $this->unserializeCallback;
    }

    public function encode($data)
    {
        if (is_resource($data)) {
            throw new \InvalidArgumentException("PHP resources are not serializable.");
        }

        if (($data = serialize($data)) === false) {
            throw new \RuntimeException("Unable to serialize the supplied data.");
        }

        return $data;
    }

    public function decode($data)
    {
        if (!is_string($data) || empty($data)) {
            throw new \InvalidArgumentException("The data to be decoded must be a non-empty string.");
        }

        if ($this->unserializeCallback) {
            $callback = ini_get("unserialize_callback_func");
            if (!function_exists($callback)) {
                throw new \BadFunctionCallException("The php.ini unserialize callback function is invalid.");
            }
        }

        if (($data = @unserialize($data)) === false) {
            throw new \RuntimeException("Unable to unserialize the supplied data.");
        }

        return $data;
    }
}