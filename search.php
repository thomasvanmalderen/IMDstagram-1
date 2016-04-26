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
<section id="postcenter">
    <?php if(isset($feedback)){; ?>
        <h1><?php $feedback; ?></h1>
    <?php }; ?>

    <?php foreach($post as $p): ?>
        <article id="post">
            <div class="postinfo">
                <a href="profile.php?user=<?php echo $p['username']; ?>"><img src="<?php echo $p['avatar']; ?>" alt="<?php echo $p['avatar']; ?>" class="avatar-small"></a>
                <p><a href="profile.php?user=<?php echo $p['username']; ?>" class="postusername"><?php echo $p['username']; ?></a></p>
            </div>
            <a href="picture.php?post=<?php echo $p['p_id']; ?>"><img src="<?php echo $p['picture']; ?>" alt="<?php echo $p['picture'] ?>" class="postpicture" ></a>
            <div class="postdescription">
                <p><a href="profile.php?user=<?php echo $p['username']; ?>" class="postprofile"><?php echo $p['username'];?> </a><?php echo $p['description'];?></p>
            </div>
        </article>
    <?php endforeach; ?>
</section>
</body>
</html>