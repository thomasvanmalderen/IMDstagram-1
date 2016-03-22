<?php

    // IMDSTAGRAM CODE: HOME - Last edited: 20/03/2016
    //######################################################

    // INCLUDE CLASSES
    include_once("classes/user.class.php");

    session_start();

    if ($_SESSION['loggedin'] == "thomasvm") {
        $conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "");

    }
    else
    {
        header("Location: login.php");
    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram</title>
</head>
<body>
<<<<<<< HEAD
    <a href="login.php">Logout</a>
    <a href="profile.php">Save profile settings</a>
=======


    <nav>
    <?php if(isset($_SESSION['loggedin'])): ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="index.php">Login</a>
    <?php endif; ?>
    </nav>

    <h1>Welcome <?php echo $_SESSION['email']; ?></h1>



>>>>>>> 750edd95073658a6f8f405c9c7eb84d6d25606ce
</body>
</html>