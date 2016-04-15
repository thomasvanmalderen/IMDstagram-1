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
</head>
<body>

<nav>
    <a href="index.php">IMDstagram</a>
    <form action="">
        <input type="text" placeholder="Search">
        <button type="submit"><img src="images/search-icon.png" alt="Search"></button>
    </form>
    <a href="profile.php"><?php echo $_SESSION['username']; ?></a>
    <a href="logout.php">Log out</a>
</nav>
<br>
<h1><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h1>

</body>
</html>