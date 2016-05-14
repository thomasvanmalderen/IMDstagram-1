<?php
include_once("../classes/db.class.php");
include_once("../classes/user.class.php");
include_once("../classes/post.class.php");
include_once("../classes/Comment.class.php");
include_once("../classes/Follow.class.php");
include_once ("../classes/Like.class.php");
include_once ("../classes/Helper.class.php");
session_start();
$PDO = Db::getInstance();
$like = new Like();
$offset = $_POST['offset'];
//$newoffset = $offset + 3;
//$statement2 = $PDO->prepare("SELECT DISTINCT p_id, picture, description, posttime, username, avatar, users.u_id, location FROM posts LEFT JOIN users ON users.u_id = posts.idUser LEFT JOIN follows ON follows.idFollowed = posts.idUser WHERE follows.idFollowing = " . $_SESSION['u_id'] . " OR Posts.idUser = " . $_SESSION['u_id']);
//$statement2->execute();

//$resultnum = $statement2->rowCount();

$statement = $PDO->prepare("SELECT DISTINCT p_id, picture, description, posttime, username, avatar, users.u_id, location, filter FROM posts LEFT JOIN users ON users.u_id = posts.idUser LEFT JOIN follows ON follows.idFollowed = posts.idUser WHERE follows.idFollowing = " . $_SESSION['u_id'] . " OR Posts.idUser = " . $_SESSION['u_id'] . " ORDER BY posts.posttime desc LIMIT $offset, 3");
$statement->execute();
$result = $statement->fetchAll();

$row = ($statement->rowCount())%3;


if($row == 0) {
    for ($x = 0; $x <= 2; $x++) {

        if($like->didLike($result[$x]['p_id']) == true){
            $response[$x] ['like'] = "yes";
        }
        else{
            $response[$x] ['like'] = "no";
        }
        $response[$x]['userid'] = $result[$x]['u_id'];
        $response[$x]['username'] = $result[$x]['username'];
        $response[$x]['avatar'] = $result[$x]['avatar'];
        $response[$x]['picture'] = $result[$x]['picture'];
        $response[$x]['description'] = $result[$x]['description'];
        $response[$x]['posttime'] = Helper::timeAgo2($result[$x]['posttime']);
        $response[$x]['post'] = $result[$x]['p_id'];
        $response[$x]['location'] = $result[$x]['location'];
        $response[$x]['filter'] = $result[$x]['filter'];
        $response[$x]['numlikes'] =  $like->getLikes($result[$x]['p_id']) . " Likes";
    }
}
else {
    for ($x = 0; $x < $row; $x++) {
        $response[$x]['userid'] = $result[$x]['u_id'];
        $response[$x]['username'] = $result[$x]['username'];
        $response[$x]['avatar'] = $result[$x]['avatar'];
        $response[$x]['picture'] = $result[$x]['picture'];
        $response[$x]['description'] = $result[$x]['description'];
        $response[$x]['posttime'] = $result[$x]['posttime'];
        $response[$x]['post'] = $result[$x]['p_id'];
        $response[$x]['location'] = $result[$x]['location'];
        $response[$x]['filter'] = $result[$x]['filter'];
        $response[$x]['numlikes'] =  $like->getLikes($result[$x]['p_id']) . " Likes";
    }
}

$response['row'] = $row;
//$response['numposts'] = $resultnum;

header('Content-Type: application/json');
echo json_encode($response);

?>