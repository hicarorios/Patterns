<?php

namespace SeparatedInterfaces\Model;

interface PostInterface
{
    public function setId($id);
    public function getId();

    public function setTitle($title);
    public function getTitle();

    public function setContent($content);
    public function getContent();

    public function getComments();
}