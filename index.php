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
        $post = new Post();
    } else {
        header('Location: login.php');
    }

if(!empty($_POST)) {
    if ($_POST['action'] === "foto") {
        $post->Description = $_POST['description'];
        $post->Tags = $_POST['tags'];
        $post->PostSaveImage();
    }
}

    $user->getAllInfo();
    $post->displayAll();

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
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="pictures" id="pictures"><br>
    <input type="text" name="description" id="description">
    <input type="text" name="tags" id="tags">
    <input type="hidden" name="action" value="foto">
    <input type="submit" name="submit" value="Post">
</form>

<?php foreach($_SESSION['photo'] as $post): ?>
<article>
    <img src="<?php echo $post['picture']; ?>" alt="<?php echo $post['picture'] ?>">
    <p><?php echo $post['description']; ?></p>
    <p><?php echo $post['tags']; ?></p>
</article>
<?php endforeach; ?>
</section>
</body>
</html>