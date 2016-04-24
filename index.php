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

    if(!empty(!empty($_FILES["pictures"]) || !empty($_POST["description"]) || !empty($_POST["tags"]))) {
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
<section id="postcenter">
    <?php if(isset($feedback)){; ?>
        <h1><?php $feedback; ?></h1>
    <?php }; ?>
<div id="addpicture">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <div id="file">
        <label for="file">Filename:</label>
    <input type="file" name="pictures" id="pictures"><br>
    </div>
    <input type="text" name="description" id="description" placeholder="What's this photo about?">
    <input type="text" name="tags" id="tags" placeholder="#tags">
    <input type="hidden" name="action" value="foto">
    <input type="submit" name="submit" value="Post">
</form>
</div>
<?php foreach($post as $p): ?>
<article id="post">
    <div class="postinfo">
    <img src="<?php echo $p['avatar']; ?>" alt="<?php echo $p['avatar']; ?>" class="avatar-small">
    <p class="postusername"><?php echo $p['username']; ?></p>
    </div>
    <img  style="width: 100%" src="<?php echo $p['picture']; ?>" alt="<?php echo $p['picture'] ?>">
    <div class="postdescription">
    <p><a href="profile.php" class="postprofile"><?php echo $p['username'] ?> </a><?php echo $p['description'];?></p>
    <p class="tags"><?php echo $p['tags']; ?></p>
    </div>
</article>
<?php endforeach; ?>
</section>
</body>
</html>