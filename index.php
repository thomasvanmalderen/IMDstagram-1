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

    if(!empty($_POST)) {
        if ($_POST['action'] === "foto") {
            $post->Description = $_POST['description'];
            $post->Tags = $_POST['tags'];
            $post->PostSaveImage();
        }
    }

    $user->getAllInfo();

    $post = $post->displayAll();

    

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

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="pictures" id="pictures"><br>
    <input type="text" name="description" id="description" placeholder="What's this photo about?">
    <input type="text" name="tags" id="tags" placeholder="#tags">
    <input type="hidden" name="action" value="foto">
    <input type="submit" name="submit" value="Post">
</form>

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