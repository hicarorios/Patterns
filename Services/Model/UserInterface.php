<?php

namespace Model;

interface UserInterface
{
    public function setId($id);
    public function getId();

    public function setName($name);
    public function getName();

    public function setEmail($email);
    public function getEmail();

    public function setRanking($ranking);
    public function getRanking();
}