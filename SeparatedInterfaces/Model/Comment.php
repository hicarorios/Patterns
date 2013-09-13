<?php

namespace SeparatedInterfaces\Model;

class Comment extends AbstractEntity implements CommentInterface
{
    protected $content;
    protected $author;

    public function __construct($content, $author)
    {
        $this->setContent($content);
        $this->setAuthor($author);
    }

    public function setContent($content)
    {
        $this->content = $this->sanitizeString($content);
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setAuthor($author)
    {
        $this->author = $this->sanitizeString($author);
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}