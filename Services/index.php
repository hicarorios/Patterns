<?php

use Library\SplClassLoader,
    Library\Database\PdoAdapter,
    Model\Mapper\UserMapper,
    Service\UserService,
    Service\Serializer,
    Service\JsonEncoder;

require_once __DIR__ . "/Library/Loader/Autoloader.php";
$autoloader = new SplClassLoader();
$autoloader->register();

$adapter = new PdoAdapter("mysql:dbname=mydatabase", "myfancyusername", "mysecretpassword");

$userService = new UserService(new UserMapper($adapter));

$userService->setEncoder(new JsonEncoder);
print_r($userService->fetchAllEncoded());
print_r($userService->fetchByIdEncoded(1));

$userService->setEncoder(new Serializer());
print_r($userService->fetchAllEncoded(array("ranking" => "high")));
print_r($userService->fetchByIdEncoded(1));