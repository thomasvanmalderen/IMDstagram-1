<?php
include_once("../classes/db.class.php");
include_once("../classes/user.class.php");
include_once("../classes/post.class.php");
include_once("../classes/Comment.class.php");
include_once("../classes/Follow.class.php");
include_once ("../classes/Like.class.php");
session_start();
$PDO = Db::getInstance();

$statement = $PDO->prepare("SELECT DISTINCT p_id, picture, description, posttime, username, avatar FROM posts LEFT JOIN users ON users.u_id = posts.idUser LEFT JOIN follows ON follows.idFollowed = posts.idUser WHERE follows.idFollowing = " . $_SESSION['u_id'] . " OR Posts.idUser = " . $_SESSION['u_id'] . " ORDER BY posts.posttime desc LIMIT 5, 10");
$statement->execute();

$response['username'] = $_SESSION['username'];
$response['postid'] = $_SESSION['username'];
$response['avatar'] = $_SESSION['avatar'];
$response['description'] = $_SESSION['description'];
$response['picture'] = $_SESSION['picture'];
$response['posttime'] = $_SESSION['posttime'];




?>