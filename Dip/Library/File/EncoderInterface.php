<?php

namespace Library\File;

interface EncoderInterface
{
    public function encode($data);
    public function decode($data);
}