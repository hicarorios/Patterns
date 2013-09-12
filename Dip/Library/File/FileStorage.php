<?php

namespace Library\File;

class FileStorage
{
    const DEFAULT_STORAGE_FILE = "default.dat";

    protected $encoder;
    protected $file;

    public function __construct(EncoderInterface $encoder, $file = self::DEFAULT_STORAGE_FILE)
    {
        $this->encoder = $encoder;
        $this->setFile($file);
    }

    public function getEncoder()
    {
        return $this->encoder;
    }

    public function setFile($file)
    {
        if (!is_file($file) || !is_readable($file)) {
            throw new \InvalidArgumentException("The supplied file is not readable or writable.");
        }

        $this->file = $file;
        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function resetFile()
    {
        $this->file = self::DEFAULT_STORAGE_FILE;
        return $this;
    }

    public function write($data)
    {
        try {
            return file_put_contents($this->file, $this->encoder->encode($data));

        }
        catch (\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }

    public function read()
    {
        try {
            return $this->encoder->decode(@file_get_contents($this->file));

        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}