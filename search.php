<?php

// IMDSTAGRAM CODE: HOME - Last edited: 14/04/2016
//######################################################

ob_start();

// SESSION START
session_start();

// INCLUDE CLASSES
include_once("classes/db.class.php");
include_once("classes/user.class.php");
include_once("classes/post.class.php");

// AUTHENTICATE USER
$user = new User();
if($user->Authenticate()){
    $post = new Post();
} else {
    header('Location: login.php');
}

$user->getAllInfo();

//$post = $post->displayAll();

if(!empty($_POST["search"])) {
    $_SESSION['search'] = $_POST['search'];
    header('Location: search.php');
}
    
    $post = $post->search();


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="favicon" href="favicon.ico">
</head>
<body>

<?php include_once("nav.inc.php") ?>
<br>
<section id="center">
    <?php if(isset($feedback)){; ?>
        <h1><?php $feedback; ?></h1>
    <?php }; ?>

    <?php foreach($post as $p): ?>
        <article>
            <img style="width: 10%; border-radius: 100%" src="<?php echo $p['avatar']; ?>" alt="<?php echo $p['avatar']; ?>">
            <p><?php echo $p['username']; ?></p>
            <img  style="width: 100%" src="<?php echo $p['picture']; ?>" alt="<?php echo $p['picture'] ?>">
            <p><?php echo $p['description'];?></p>
            <p><?php echo $p['tags']; ?></p>
        </article>
    <?php endforeach; ?>
</section>
</body>
</html>