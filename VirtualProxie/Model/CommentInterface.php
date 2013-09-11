<?php

namespace Model;

interface CommentInterface
{
    public function setId($id);
    public function getId();

    public function setContent($content);
    public function getContent();

    public function setPoster($poster);
    public function getPoster();
}