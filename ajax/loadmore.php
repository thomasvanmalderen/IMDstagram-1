<?php

    // IMDSTAGRAM AJAX CODE: LOAD MORE POSTS
    //######################################################

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

    $statement = $PDO->prepare("SELECT DISTINCT  p_id, picture, description, posts.posttime, username, avatar, users.u_id, location, filter FROM posts LEFT JOIN users ON users.u_id = posts.idUser LEFT JOIN follows ON follows.idFollowed = posts.idUser WHERE follows.idFollowing = " . $_SESSION['u_id'] . " OR Posts.idUser = " . $_SESSION['u_id'] . " ORDER BY posts.posttime desc LIMIT $offset, 5");
    $statement->execute();

    // COUNT NEXT AMOUNT OF POSTS
    $result = $statement->fetchAll();
    $row = ($statement->rowCount())%5;

    // IF THERE ARE ENOUGH POSTS TO LOAD ( >5 )
    if( $row == 0 ) {

        for ( $x = 0; $x <= 4; $x++ ) {
            if($like->didLike($result[$x]['p_id']) == true){
                $response[$x] ['like'] = "yes";

            } else {
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
            //$response[$x]['commentid'] = $result2[$x]['c_id'];
            //$response[$x]['comment'] = $result2[$x]['comment'];
            //$response[$x]['commentusername'] = $result2[$x]['username'];
            $response[$x]['numlikes'] =  $like->getLikes($result[$x]['p_id']) . " Likes";
        }

    // THERE ARE LESS THAN 5 POSTS TO LOAD ANYMORE
    } else {

        for ( $x = 0; $x < $row; $x++ ) {
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
            //$response[$x]['commentid'] = $result2[$x]['c_id'];
            //$response[$x]['comment'] = $result2[$x]['comment'];
            //$response[$x]['commentusername'] = $result2[$x]['username'];
        }
    }

    $response['row'] = $row;
    //$response['com'] = $com;
    //$response['numposts'] = $resultnum;

    header('Content-Type: application/json');
    echo json_encode($response);

?>