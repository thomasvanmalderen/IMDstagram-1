<?php
include_once("../classes/db.class.php");
include_once("../classes/user.class.php");
include_once("../classes/post.class.php");
include_once("../classes/Comment.class.php");
include_once("../classes/Follow.class.php");
include_once ("../classes/Like.class.php");
session_start();
$PDO = Db::getInstance();

$offset = $_POST['offset'];
$newoffset = $offset + 3;

$statement = $PDO->prepare("SELECT DISTINCT p_id, picture, description, posttime, username, avatar FROM posts LEFT JOIN users ON users.u_id = posts.idUser LEFT JOIN follows ON follows.idFollowed = posts.idUser WHERE follows.idFollowing = " . $_SESSION['u_id'] . " OR Posts.idUser = " . $_SESSION['u_id'] . " ORDER BY posts.posttime desc LIMIT $offset, $newoffset");
$statement->execute();
$result = $statement->fetchAll();


$response['username'] = $result[0]['username'];
$response['avatar'] = $result[0]['avatar'];
$response['picture'] = $result[0]['picture'];
$response['description'] = $result[0]['description'];
$response['posttime'] = $result[0]['posttime'];

header('Content-Type: application/json');
echo json_encode($response);




?>