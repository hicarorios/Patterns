<?php

require_once __DIR__ . "/Library/SplClassLoader.php";
$autoloader = new SplClassLoader();
$autoloader->register();

//TODO declare 'use' for classes

// create a PDO adapter
$adapter = new PdoAdapter("mysql:dbname=blog", "myfancyusername","myhardtoguesspassword");

// create the mappers
$userMapper = new UserMapper($adapter);
$commentMapper = new CommentMapper($adapter, $userMapper);
$postMapper = new PostMapper($adapter, $commentMapper);

$postMapper->insert(
    new Post(
        "Welcome to SitePoint",
        "To become yourself a true PHP master, you must first master PHP."));

$postMapper->insert(
    new Post(
        "Welcome to SitePoint (Reprise)",
        "To become yourself a PHP Master, you must first master... Wait! Did I post that already?"));


$user = new User("Everchanging Joe", "joe@example.com");
$userMapper->insert($user);

// Joe's comments for the first post (post ID = 1, user ID = 1)
$commentMapper->insert(
    new Comment(
        "I just love this post! Looking forward to seeing more of this stuff.",
        $user),
    1, $user->id);

$commentMapper->insert(
    new Comment(
        "I just changed my mind and dislike this post! Hope not seeing more of this stuff.",
        $user),
    1, $user->id);

// Joe's comment for the second post (post ID = 2, user ID = 1)
$commentMapper->insert(
    new Comment(
        "Not quite sure if I like this post or not, so I cannot say anything for now.",
        $user),
    2, $user->id);

$posts = $postMapper->findAll();

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Building a Domain Model in PHP</title>
</head>
<body>
<header>
    <h1>SitePoint.com</h1>
</header>
<section>
    <ul>
        <?php
        foreach ($posts as $post) {
            ?>
            <li>
                <h2><?php echo $post->title;?></h2>
                <p><?php echo $post->content;?></p>
                <?php
                if ($post->comments) {
                    ?>
                    <ul>
                        <?php
                        foreach ($post->comments as $comment) {
                            ?>
                            <li>
                                <h3><?php echo $comment->user->name;?> says:</h3>
                                <p><?php echo $comment->content;?></p>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                <?php
                }
                ?>
            </li>
        <?php
        }
        ?>
    </ul>
</section>
</body>
</html>