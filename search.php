<?php

    // IMDSTAGRAM CODE: SEARCH PAGE
    //######################################################

    ob_start();
    session_start();
    
    include_once("classes/Db.class.php");
    include_once("classes/User.class.php");
    include_once("classes/Post.class.php");
    include_once("classes/Helper.class.php");
    include_once("classes/Like.class.php");
    
    $user = new User();
    if($user->Authenticate()){
        $post = new Post();
        $like = New Like();
    } else {
        header('Location: login.php');
    }

    $user->getAllInfo();

    if(!empty($_POST["search"])) {
        $_SESSION['search'] = htmlspecialchars($_POST['search']);
        header('Location: search.php');
    }
    
    $post = $post->search();

    // LIKE POST
    if(!empty($_POST["like"])) {
        if ($_POST['like'] === "like") {
            $like->doLike($_POST['postval']);
        }
    }

    // UNLIKE POST
    if(!empty($_POST["unlike"])) {
        if ($_POST['unlike'] === "unlike") {
            $like->doUnlike($_POST['postval']);
        }
    }
    

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/cssgram.min.css">
    <link rel="favicon" href="favicon.ico">
</head>
<body>

<?php include_once("nav.inc.php") ?>
<br>
<section class="postcenter">
    <?php if(isset($feedback)){; ?>
        <h1><?php $feedback; ?></h1>
    <?php }; ?>

    <?php foreach($post as $p): ?>
        <article class="post">
            <div class="postinfo">
                <a href="profile.php?user=<?php echo $p['username']; ?>"><img src="<?php echo $p['avatar']; ?>" alt="<?php echo $p['avatar']; ?>" class="avatar-small"></a>
                <p><a href="profile.php?user=<?php echo $p['username']; ?>" class="postusername"><?php echo $p['username']; ?></a></p>
                <p class="time"><?php Helper::timeAgo($p['posttime']); ?></p>
            </div>
            <a href="picture.php?post=<?php echo $p['p_id']; ?>"><figure class="<?php echo $p['filter']; ?>"><img src="<?php echo $p['picture']; ?>" alt="<?php echo $p['picture'] ?>" class="postpicture" ></figure></a>
            <div class="postdescription">
                <p><a href="profile.php?user=<?php echo $p['username']; ?>" class="postprofile"><?php echo $p['username'];?> </a><?php echo $p['description'];?></p>

                <?php if($like->didLike($p['p_id']) == true){?>
                    <form action="" method="post">
                        <input type="hidden" name="unlike" value="unlike">
                        <input type="hidden" name="postval" value="<?php echo $p['p_id'];?>">
                        <input id="unlike"  type="submit" name="btnunLike" value=""/>
                    </form>
                <?php } elseif($like->didLike($p['p_id']) == false){?>
                    <form action="" method="post">
                        <input type="hidden" name="like" value="like">
                        <input type="hidden" name="postval" value="<?php echo $p['p_id'];?>">
                        <input id="like"  type="submit" name="btnLike" value=""/>
                    </form>
                <?php } ?>
                <p id="likes"><?php echo $like->getLikes($p['p_id']) . " Likes"; ?></p>

            </div>
        </article>
    <?php endforeach; ?>
</section>
</body>
</html>