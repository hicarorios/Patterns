<?php

use RepositoryPattern\Library\LoaderAutoloader,
    RepositoryPattern\Library\DatabasePdoAdapter,
    RepositoryPattern\Mapper\UserMapper,
    RepositoryPattern\Model\Collection\UserCollection,
    RepositoryPattern\Model\Repository\UserRepository;

require_once __DIR__ . "/Library/Loader/Autoloader.php";
$autoloader = new Autoloader;
$autoloader->register();

$adapter = new PdoAdapter("mysql:dbname=users", "myfancyusername", "mysecretpassword");
$userRepository = new UserRepository(new UserMapper($adapter,
    new UserCollection()));

$users = $userRepository->fetchByName("Rachel");
foreach ($users as $user) {
    echo $user->getName() . " " . $user->getEmail() . "<br>";
}

$users = $userRepository->fetchByEmail("username@domain.com");
foreach ($users as $user) {
    echo $user->getName() . " " . $user->getEmail() . "<br>";
}

$administrators = $userRepository->fetchByRole("administrator");
foreach ($administrators as $administrator) {
    echo $administrator->getName() . " " .
        $administrator->getEmail() . "<br>";
}

$guests = $userRepository->fetchByRole("guest");
foreach ($guests as $guest) {
    echo $guest->getName() . " " . $guest->getEmail() . "<br>";
}