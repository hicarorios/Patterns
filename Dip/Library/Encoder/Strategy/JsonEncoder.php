<?php

namespace Library\Encoder\Strategy;

class JsonEncoder implements \Library\File\EncoderInterface
{
    public function encode($data)
    {
        if (is_resource($data)) {
            throw new \InvalidArgumentException("PHP resources cannot be JSON-encoded.");
        }

        if (($data = json_encode($data)) === false) {
            throw new \RuntimeException("Unable to JSON-encode the supplied data.");
        }

        return $data;
    }

    public function decode($data)
    {
        if (!is_string($data) || empty($data)) {
            throw new \InvalidArgumentException("The data to be decoded must be a non-empty string.");
        }

        if (($data = json_decode($data)) === false) {
            throw new \RuntimeException("Unable to JSON-decode the supplied data.");
        }

        return $data;
    }
}