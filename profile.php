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
    include_once("classes/follow.class.php");
    include_once("classes/Like.class.php");

    // AUTHENTICATE USER
    $user = new User();
    if($user->Authenticate()){
        $post = new Post();
        $follow = new Follow();

    } else {
        header('Location: login.php');
    }

    $user = $user->getProfileInfo();
    //$user->getAllInfo();
    //var_dump($user[0]['u_id']);

    $post = $post->displayUserPosts();

    $follow->Following = $_SESSION['u_id'];
    $follow->Followed = $user[0]['u_id'];

    /*if( $follow->isFollowing()){
        $kak = true;
    } else {
        $kak = false;
    }*/

    if(!empty($_POST["follow"])) {
        if ($_POST['follow'] === "follow") {
            $follow->doFollow();
            //header("Location: index.php");
            //var_dump($_GET['post']);
        }
    }

    if(!empty($_POST["unfollow"])) {
        if ($_POST['unfollow'] === "unfollow") {
            $follow->doUnfollow();

        }
    }

    

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
    <section class="postcenter">
        <?php if(isset($feedback)){; ?>
            <h1><?php $feedback; ?></h1>
        <?php }; ?>
                <div id="profileavatar">
                <img src="<?php echo $user[0]['avatar']; ?>" alt="<?php echo $user[0]['avatar']; ?>" class="avatar-profile">
                </div>

                <br>
                <div id="profiletop">
                    <div id="profileright">
                    <?php if($_GET['user'] == $_SESSION['username_']) {?>
                        <div class="proflinks">
                            <a href="changeProfile.php"><div id="editprofile">Edit Profile</div></a>
                        <br>
                            <a href="logout.php" "><div id="logout">Log out</div></a>


                    <?php } elseif($follow->isFollowing()) {?>
                        <form action="" method="post">
                            <input type="hidden" name="unfollow" value="unfollow">
                            <input id="unfollow"  type="submit" name="btnunFollow" class="followinput" value="Unfollow"/>
                        </form>

                    <?php } elseif($follow->isFollowing() == false) {?>
                        <form action="" method="post">
                            <input type="hidden" name="follow" value="follow">
                            <input type="submit" name="btnFollow" class="followinput" value="Follow"/>
                        </form>
                    <?php } ?>
                        </div>
                    <div class="profileinfo">
                                <h2 id="username"><?php echo $user[0]['username']; ?></h2>
                                <div id="info">
                                    <p id="info-name"><?php echo $user[0]['firstname'] . " " . $user[0]['lastname'] ?></p>
                                    <p id="info-bio"><?php echo $user[0]['bio']; ?></p>
                                </div>
                            </div>
                            </div>
                </div>
        
    </section>
    <div class="ownposts">
        <?php foreach($post as $p): ?>
            <article class="profilepost">

                <a href="picture.php?post=<?php echo $p['p_id']; ?>">
                    <img src="<?php echo $p['picture']; ?>" alt="<?php echo $p['picture'] ?>" class="postpicture" >
                </a>

            </article>
        <?php endforeach; ?>
    </div>

    </body>
    </html>