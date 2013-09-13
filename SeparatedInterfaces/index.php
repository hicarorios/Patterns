<?php

use Library\LoaderAutoloader,
    Library\DatabasePdoAdapter,
    SeparatedInterfaces\Mapper\CommentMapper,
    SeparatedInterfaces\Model\Post,
    SeparatedInterfaces\Model\Comment;

require_once __DIR__ . "/Library/Loader/Autoloader.php";
$autoloader = new Autoloader;
$autoloader->register();

$adapter = new PdoAdapter("mysql:dbname=test", "fancyusername",
    "hardtoguesspassword");

$commentMapper = new CommentMapper($adapter);

$post = new Post("A naive sample post",
    "This is the content of the sample post",
    $commentMapper);
$post->id = 1;

echo $post->title . " " . $post->content . "<br>";

foreach ($post->comments as $comment) {
    echo $comment->content . " " . $comment->author . "<br>";
}