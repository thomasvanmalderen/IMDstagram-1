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
    <section id="center">
        <?php if(isset($feedback)){; ?>
            <h1><?php $feedback; ?></h1>
        <?php }; ?>

        <a href="changeProfile.php">Edit Profile</a>
    <a href="logout.php">Log out</a>
    <br>
    <img src="<?php echo $_SESSION['avatar']; ?>" alt="<?php echo $_SESSION['avatar']; ?>">
    <h2><?php echo $_SESSION['username']; ?></h2>
    <p><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?></p>
    <p><?php echo $_SESSION['bio']; ?></p>
    </section>

    </body>
    </html>