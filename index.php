<?php

    // IMDSTAGRAM CODE: HOME - Last edited: 14/04/2016
    //######################################################
    
    ob_start();

    // SESSION START
    session_start();

    // INCLUDE CLASSES
    include_once("classes/db.class.php");
    include_once("classes/user.class.php");
    include_once ("classes/post.class.php");
    
    // AUTHENTICATE USER
    $user = new User();
    if($user->Authenticate()){
        
    } else {
        header('Location: login.php');
    }

if(!empty($_POST)) {
    if ($_POST['action'] === "foto") {
        $post = new Post();
        $post->PostSaveImage();
    }
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

<?php include_once("nav.inc.php") ?>
<br>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="pictures" id="pictures"><br>
    <input type="hidden" name="action" value="foto">
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>