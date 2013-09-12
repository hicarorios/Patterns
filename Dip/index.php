<?php

use Library\Loader\Autoloader,
    Library\Encoder\Strategy\JsonEncoder,
    Library\Encoder\Strategy\Serializer,
    Library\File\FileStorage;

require_once __DIR__ . "/Library/Loader/Autoloader.php";
$autoloader = new Autoloader;
$autoloader->register();

$fileStorage = new FileStorage(new JsonEncoder);
$fileStorage->write(new stdClass());
print_r($fileStorage->read());

$fileStorage = new FileStorage(new Serializer);
$fileStorage->write(array("This", "is", "a", "sample", "array"));
print_r($fileStorage->read());