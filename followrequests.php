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

    $follow = new Follow();
    $followrequests = new Follow();

} else {
    header('Location: login.php');
}


    //$follow->Following = $_SESSION['u_id'];
    //$follow->Followed = $user[0]['u_id'];

    $followrequests->Followed = $_SESSION['u_id'];

    $followrequests = $followrequests->getFollowRequests();
    //var_dump($followrequests);

    if(!empty($_POST["follow"])) {
        if ($_POST['follow'] === "follow") {
            $dofollow = new Follow();

            $dofollow->Following = $_SESSION['u_id'];
            $dofollow->Followed = $user[0]['u_id'];

            $dofollow->doFollow();
            //header("Location: index.php");
            //var_dump($_GET['post']);
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
    <h2>Your follow requests:</h2>
    <?php foreach($followrequests as $f): ?>
        <article class="profilepost">

            <h3><img src="<?php echo $f['avatar']; ?>" alt="<?php echo $f['avatar']; ?>" class="avatar-small"><?php echo $f['username']; ?></h3>
            <form action="" method="post">
                <input type="hidden" name="follow" value="follow">
                <input type="hidden" name="followerid" value="<?php echo $f['FollowerId']; ?>">
                <p><?php echo $f['FollowingId']; ?></p>
                <input type="submit" name="btnFollow" class="followinput" value="Follow"/>
            </form>

        </article>
    <?php endforeach; ?>
</section>
</div>

</body>
</html>