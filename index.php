<?php

    // IMDSTAGRAM CODE: HOME - Last edited: 20/03/2016
    //######################################################
    
    ob_start();
    // SESSION START
    session_start();

    // INCLUDE CLASSES
    include_once("classes/user.class.php");
    
    $user = new User();
    if($user->Authenticate()){

    } else {
        header('Location: login.php');
    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram</title>
    <link rel="favicon" href="favicon.ico">
</head>
<body>

    
    <nav>
    <a href="changeProfile.php">Change profile settings</a>
    <a href="logout.php">Log out</a>
    </nav>
    <br>
    <h1>Welcome <?php echo $_SESSION['username_']; ?>!</h1>


</body>
</html>