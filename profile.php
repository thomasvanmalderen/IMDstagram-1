<?php

    // IMDSTAGRAM CODE: HOME - Last edited: 14/04/2016
    //######################################################

    ob_start();

    // SESSION START
    session_start();

    // INCLUDE CLASSES
    include_once("classes/db.class.php");
    include_once("classes/user.class.php");

    // AUTHENTICATE USER
    $user = new User();
    if($user->Authenticate()){

    } else {
        header('Location: login.php');
    }

    $user->getAllInfo();

    

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
    <img src="<?php echo $_SESSION['avatar']; ?>" alt="<?php echo $_SESSION['avatar']; ?>" class="avatar-profile">
    </div>
        <div id="profileinfo">
            <div id="profilelinks">
        <a href="changeProfile.php">Edit Profile</a>
                <br>
                <br>
    <a href="logout.php" id="editprofile">Log out </a>
                <br>
                </div>
    <h2 id="username"><?php echo $_SESSION['username']; ?></h2>
            <div id="info">
    <p id="info-name"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?></p>
    <p id="info-bio"><?php echo $_SESSION['bio']; ?></p>
            </div>
        </div>
    </section>

    </body>
    </html>