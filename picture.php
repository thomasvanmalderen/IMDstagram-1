<?php

    // IMDSTAGRAM CODE: INDIVIDUAL PICTURE PAGE
    //######################################################

    ob_start();
    session_start();

    include_once("classes/Db.class.php");
    include_once("classes/User.class.php");
    include_once("classes/Post.class.php");
    include_once("classes/Helper.class.php");
    include_once("classes/Like.class.php");
    include_once("classes/Comment.class.php");
    include_once("classes/Report.class.php");


    $user = new User();
    if($user->Authenticate()){
        $post = new Post();
        $d_post  =new Post();
        $like = New Like();
        $comment = new Comment();
        $report = new Report();

    } else {
        header('Location: login.php');
    }

    $user->getAllInfo();
    $post = $post->displayPicture();

    // DELETE PICTURE
    if(!empty($_POST["delete"])) {
        if ($_POST['delete'] === "delete") {
            $d_post->removePicture();
            header("Location: index.php");
        }
    }

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

    // REPORT POST
    if(!empty($_POST["report"])) {
        if ($_POST['report'] === "report") {
            $report->doReport($_POST['postval']);
        }
    }

    // UN-REPORT POST
    if(!empty($_POST["unreport"])) {
        if ($_POST['unreport'] === "unreport") {
            $report->doUnReport($_POST['postval']);
        }
    }

    // COMMENT ON POST
    if(!empty($_POST['comment'])) {
        $comment->Comment = htmlspecialchars($_POST['comment']);
        $comment->PostID = htmlspecialchars($_POST['postid']);
        $comment->SaveComment();
    }

    $comments = $comment->GetComments();

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
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.1.min.js" integrity="sha256-gvQgAFzTH6trSrAWoH1iPo9Xc96QxSZ3feW6kem+O00=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/comments.js"></script>
    <script type="text/javascript" src="js/location-api.js"></script>
</head>
<body>

<?php include_once("nav.inc.php") ?>
<br>
<section class="postcenter">
    <?php if(isset($feedback)){; ?>
        <h1><?php $feedback; ?></h1>
    <?php }; ?>

<?php foreach ($post as $p): ?>

        <article class="post">
            <div class="postinfo">
                <a href="profile.php?user=<?php echo $p['username']; ?>"><img src="<?php echo $p['avatar']; ?>" alt="<?php echo $p['avatar']; ?>" class="avatar-small"></a>
                <p><a href="profile.php?user=<?php echo $p['username']; ?>" class="postusername"><?php echo $p['username']; ?></a></p>
                <p class="time"><?php Helper::timeAgo($p['posttime']); ?></p>
                <p class="location"><?php echo $p['location']; ?></p>

                <?php if($p['username'] == $_SESSION['username_']){ ?>
                    <form action="" method="post">
                        <input type="hidden" name="delete" value="delete">
                        <input type="submit" name="btnDelete" class="deleteinput" value="Delete this picture"/>
                    </form>


                <?php } ?>
            </div>

            <figure class="<?php echo $p['filter']; ?>"><img src="<?php echo $p['picture']; ?>" alt="<?php echo $p['picture'] ?>" class="postpicture" ></figure>
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

                <?php if($report->didReport($p['p_id']) == true){?>
                    <form action="" method="post">
                        <input type="hidden" name="unreport" value="unreport">
                        <input type="hidden" name="postval" value="<?php echo $p['p_id'];?>">
                        <input id="unreport"  type="submit" name="btnunReport" value="Unreport"/>
                    </form>
                <?php } elseif($report->didReport($p['p_id']) == false){?>
                    <form action="" method="post">
                        <input type="hidden" name="report" value="report">
                        <input type="hidden" name="postval" value="<?php echo $p['p_id'];?>">
                        <input id="report"  type="submit" name="btnReport" value="Report"/>
                    </form>
                <?php } ?>
                <!--<p id="reports"><?php echo $report->getReports($p['p_id']) . " Reports"; ?></p>-->

            </div>

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <div class="comments">
                    <input type="text" class="com<?php echo $p['p_id'] ?>" name="comment" placeholder="Write your comment here" />
                    <input type="hidden" name="userid" value="<?php $_SESSION['u_id'] ?>"/>
                    <input type="hidden" name="postid" value="<?php echo $p['p_id'] ?>"/>
                    <input class="btnComment" type="submit" name="btnComment" value="Place your comment" data-postid="<?php echo $p['p_id'] ?>" data-userid ="<?php $_SESSION['u_id'] ?>" />

                </div>
            </form>
            <ul class="displaycomments<?php echo $p['p_id'] ?>">
            <?php foreach($comments as $c): ?>
                <div id="displaycomment">
                <li><a href="profile.php?user=<?php echo $c['username']; ?>" class="postprofile"><?php echo $c['username'] ?></a> <?php echo "&nbsp;" . $c["comment"] ?></li>
                </div>
            <?php endforeach; ?>
            </ul>
        </article>
<?php endforeach; ?>
</section>
</body>

</html>