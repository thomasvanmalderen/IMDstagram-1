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
    include_once("classes/Like.class.php");
    include_once("classes/Comment.class.php");
    include_once("classes/Report.class.php");
    
    // AUTHENTICATE USER
    $user = new User();
    if($user->Authenticate()){
        $post = new Post();
        $like = new Like();
        $comment = new Comment();
    } else {
        header('Location: login.php');
    }

    if(!empty(!empty($_FILES["pictures"]) || !empty($_POST["description"]) )) {
        if ($post->CanSaveImage()) {
            if ($_POST['action'] === "foto") {
                $post->Description = htmlspecialchars($_POST['description']);
                $post->Location = htmlspecialchars($_POST['location']);
                $post->Filter = htmlspecialchars($_POST['filterselect']);
                $post->PostSaveImage();
            }
        }
    }

    $user->getAllInfo();

    $post = $post->displayPostsFollowing();
    //var_dump($post);
    //var_dump($post);
/*
if(!empty($_POST["load"])) {
    $post->loadmore();
}*/

if(!empty($_POST["like"])) {
    if ($_POST['like'] === "like") {
        $like->doLike($_POST['postval']);
        //header("Location: index.php");
        //var_dump($_GET['post']);
    }
}

if(!empty($_POST["unlike"])) {
    if ($_POST['unlike'] === "unlike") {
        $like->doUnlike($_POST['postval']);

    }
}


if(!empty($_POST['comment']))
{
    $comment->Comment = htmlspecialchars($_POST['comment']);
    $comment->PostID = htmlspecialchars($_POST['postid']);
    $comment->SaveComment();
}

//altijd alle laatste comments ophalen
//$comments = $comment->GetCommentsOnIndex();
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
        <figure class="" id="imageUploadFilter1"><img src="" id="imageUpload" class="imageUpload"></figure>
        
    <div id="btnUp">
    <label class="myLabel">
    <input type="file" name="pictures" class="pictures" id="fileUpload"/>
    <span>Upload picture</span>
    </label>
    </div>
    <input type="text" class="uploadFile" disabled="disabled"/>
    <input type="text" name="description" id="description" placeholder="What's this photo about?">
    <input type="hidden" name="action" value="foto">
        <input type="hidden" name="location" class="location-summary"/>
        <select name="filterselect" id="filterselect">
            <option value="nofilter">No filter</option>
            <option value="_1977">1977</option>
            <option value="aden">Aden</option>
            <option value="brooklyn">Brooklyn</option>
            <option value="clarendon">Clarendon</option>
            <option value="earlybird">Earlybird</option>
            <option value="gingham">Gingham</option>
            <option value="hudson">Hudson</option>
            <option value="inkwell">Inkwell</option>
            <option value="lo-fi">Lo-Fi</option>
            <option value="mayfair">Mayfair</option>
            <option value="moon">Moon</option>
            <option value="nashville">Nashville</option>
            <option value="perpetua">Perpetua</option>
            <option value="rise">Rise</option>
            <option value="slumber">Slumber</option>
            <option value="toaster">Toaster</option>
            <option value="walden">Walden</option>
            <option value="willow">Willow</option>
            <option value="xpro2">X-Pro II</option>
        </select>
    <input type="submit" name="submit" value="Post">
</form>
</div>
    </section>
<section class="postcenter">
    <div class="loadpost">
<?php foreach($post as $p): ?>
<article class="post">
    <div class="postinfo">
        <a href="profile.php?user=<?php echo $p['username']; ?>"><img src="<?php echo $p['avatar']; ?>" alt="<?php echo $p['avatar']; ?>" class="avatar-small"></a>
    <p><a href="profile.php?user=<?php echo $p['username']; ?>" class="postusername"><?php echo $p['username']; ?></a></p>
        <p class="time"><?php Helper::timeAgo($p['posttime']); ?></p>
        <p class="location"><?php echo $p['location']; ?></p>

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
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="comments">
            <input type="text" name="comment" placeholder="Write your comment here" class="com<?php echo $p['p_id'] ?>" />
            <input type="hidden" name="userid" value="<?php $_SESSION['u_id'] ?>"/>
            <input type="hidden" name="postid" value="<?php echo $p['p_id'] ?>"/>
            <input class="btnComment" type="submit" name="btnComment" value="Place your comment" data-postid="<?php echo $p['p_id'] ?>" data-userid ="<?php $_SESSION['u_id'] ?>" />

        </div>
    </form>
    <ul class="displaycomments<?php echo $p['p_id'] ?>">
        <?php $thiscomment = new Comment(); ?>
        <?php $thiscomment = $thiscomment->GetCommentsOnIndex($p['p_id']); ?>
        <?php foreach($thiscomment as $c): ?>

            <div class="listcomment">
                <li><a href="profile.php?user=<?php echo $c['username']; ?>" class="postprofile"><?php echo $c['username'] ?></a> <?php echo "&nbsp;" . $c["comment"] ?></li>
            </div>
        <?php endforeach; ?>
    </ul>
</article>

<?php endforeach; ?>
    </div>
    <div id="loadmore" class="loadmore" data-offset="5">
    <p >Loadmore</p>
    </div>
</section>

</body>

    <script type="text/javascript" src="js/preview-image.js"></script>

</html>