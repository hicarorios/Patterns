<?php

use Library\SplClassLoader,
    Library\Database\PdoAdapter,
    Model\Mapper\CommentMapper,
    Model\Proxy\CommentCollectionProxy,
    Model\Comment,
    Model\Post;

require_once __DIR__ . "/Library/SplClassLoader.php";
$autoloader = new SplClassLoader;
$autoloader->register();

$adapter = new PdoAdapter("mysql:dbname=blog", "myfancyusername", "mysecretpassword");

$commentMapper = new CommentMapper($adapter);
$comments = $commentMapper->fetchAll(array("post_id" => 1));

$post = new Post("The post title", "This is just a sample post.",
    $comments);

echo $post->getTitle() . " " .  $post->getContent() . "<br />";

foreach ($post->getComments() as $comment) {
    echo $comment->getContent() . " " . $comment->getPoster() .
        "<br />";
}
