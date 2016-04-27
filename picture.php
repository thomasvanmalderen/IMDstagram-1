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
    $d_post  =new Post();
} else {
    header('Location: login.php');
}

$user->getAllInfo();


    
    $post = $post->displayPicture();


if(!empty($_POST["delete"])) {
    if ($_POST['delete'] === "delete") {
        $d_post->removePicture();
        header("Location: index.php");
        //var_dump($_GET['post']);
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
    <link rel="favicon" href="favicon.ico">
</head>
<body>

<?php include_once("nav.inc.php") ?>
<br>
<section id="postcenter">
    <?php if(isset($feedback)){; ?>
        <h1><?php $feedback; ?></h1>
    <?php }; ?>

<?php foreach ($post as $p): ?>

        <article id="post">
            <div class="postinfo">
                <a href="profile.php?user=<?php echo $p['username']; ?>"><img src="<?php echo $p['avatar']; ?>" alt="<?php echo $p['avatar']; ?>" class="avatar-small"></a>
                <p><a href="profile.php?user=<?php echo $p['username']; ?>" class="postusername"><?php echo $p['username']; ?></a></p>
                <p><?php Helper::timeAgo($p['posttime']); ?></p>
                <?php if($p['username'] == $_SESSION['username_']){ ?>
                    <form action="" method="post">
                        <input type="hidden" name="delete" value="delete">
                        <input type="submit" name="btnDelete" class="deleteinput" value="Delete this picture"/>
                    </form>


                <?php } ?>
            </div>
            <img src="<?php echo $p['picture']; ?>" alt="<?php echo $p['picture'] ?>" class="postpicture" >
            <div class="postdescription">
                <p><a href="profile.php?user=<?php echo $p['username']; ?>" class="postprofile"><?php echo $p['username'];?> </a><?php echo $p['description'];?></p>

            </div>
        </article>
<?php endforeach; ?>
</section>
</body>

</html>