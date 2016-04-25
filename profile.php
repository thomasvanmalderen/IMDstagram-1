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

    $user = $user->getProfileInfo();
    //$user->getAllInfo();


    $post = $post->displayAll();

?><!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>IMDstagram</title>
        <link rel="favicon" href="favicon.ico">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/media.css">
    </head>
    <body>

    <?php include_once("nav.inc.php") ?>
    <br>
    <section id="center-profile">
        <?php if(isset($feedback)){; ?>
            <h1><?php $feedback; ?></h1>
        <?php }; ?>
    <div id="profileavatar">
    <img src="<?php echo $user[0]['avatar']; ?>" alt="<?php echo $user[0]['avatar']; ?>" class="avatar-profile">
    </div>
        <div id="profileinfo">
            <div id="profilelinks">
        <a href="changeProfile.php">Edit Profile</a>
                <br>
                <br>
    <a href="logout.php" id="editprofile">Log out </a>
                <br>
                </div>
    <h2 id="username"><?php echo $user[0]['username']; ?></h2>
            <div id="info">
    <p id="info-name"><?php echo $user[0]['firstname'] . " " . $user[0]['lastname'] ?></p>
    <p id="info-bio"><?php echo $user[0]['bio']; ?></p>
            </div>
        </div>
        <?php foreach($post as $p): ?>
            <article id="post">
                <div class="postinfo">
                    <img src="<?php echo $p['avatar']; ?>" alt="<?php echo $p['avatar']; ?>" class="avatar-small">
                    <p class="postusername"><?php echo $p['username']; ?></p>
                </div>
                <img src="<?php echo $p['picture']; ?>" alt="<?php echo $p['picture'] ?>" class="postpicture" >
                <div class="postdescription">
                    <p><a href="profile.php" class="postprofile"><?php echo $p['username'] ?> </a><?php echo $p['description'];?></p>
                </div>
            </article>
        <?php endforeach; ?>

    </section>

    </body>
    </html>