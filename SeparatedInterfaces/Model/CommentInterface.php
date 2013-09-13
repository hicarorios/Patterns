<?php

namespace SeparatedInterfaces\Model;

interface CommentInterface
{
    public function setId($id);
    public function getId();

    public function setContent($content);
    public function getContent();

    public function setAuthor($author);
    public function getAuthor();
}