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
    include_once("classes/Helper.class.php");
    
    // AUTHENTICATE USER
    $user = new User();
    if($user->Authenticate()){
        $post = new Post();
    } else {
        header('Location: login.php');
    }

    if(!empty(!empty($_FILES["pictures"]) || !empty($_POST["description"]) )) {
        if ($_POST['action'] === "foto") {
            $post->Description = $_POST['description'];
            $post->PostSaveImage();
        }
    }


    $user->getAllInfo();

    $post = $post->displayPostsFollowing();
    //var_dump($post);

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="favicon" href="favicon.ico">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.1.min.js" integrity="sha256-gvQgAFzTH6trSrAWoH1iPo9Xc96QxSZ3feW6kem+O00=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>

<?php include_once("nav.inc.php") ?>
<br>
<section class="postcenter">
    <?php if(isset($feedback)){; ?>
        <h1><?php $feedback; ?></h1>
    <?php }; ?>
<div id="addpicture">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <div id="file">
        <h3>Add picture</h3>
    <div id="btnUp">
    <label class="myLabel">
    <input type="file" name="pictures" id="pictures"/>
    <span>Upload picture</span>
    </label>
    </div>
    <input type="text" class="uploadFile" disabled="disabled"/>
    <input type="text" name="description" id="description" placeholder="What's this photo about?">
    <input type="hidden" name="action" value="foto">
    <input type="submit" name="submit" value="Post">
</form>
</div>
    </section>
<section class="postcenter">
<?php foreach($post as $p): ?>
<article class="post">
    <div class="postinfo">
        <a href="profile.php?user=<?php echo $p['username']; ?>"><img src="<?php echo $p['avatar']; ?>" alt="<?php echo $p['avatar']; ?>" class="avatar-small"></a>
    <p><a href="profile.php?user=<?php echo $p['username']; ?>" class="postusername"><?php echo $p['username']; ?></a></p>
        <p class="time"><?php Helper::timeAgo($p['posttime']); ?></p>

    </div>
    <a href="picture.php?post=<?php echo $p['p_id']; ?>"><img src="<?php echo $p['picture']; ?>" alt="<?php echo $p['picture'] ?>" class="postpicture" ></a>
    <div class="postdescription">
    <p><a href="profile.php?user=<?php echo $p['username']; ?>" class="postprofile"><?php echo $p['username'];?> </a><?php echo $p['description'];?></p>
        
    </div>
</article>
<?php endforeach; ?>
</section>
</body>
</html>