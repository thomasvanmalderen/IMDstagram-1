<?php

    // IMDSTAGRAM AJAX CODE: LIKE A CERTAIN POST
    //######################################################

    include_once("../classes/db.class.php");
    include_once("../classes/user.class.php");
    include_once("../classes/post.class.php");
    include_once("../classes/Helper.class.php");
    include_once("../classes/Like.class.php");

    $like = new Like();

    // LIKE POST
    if( !empty( $_POST["like"] ) ) {

        $like->LikedPostID = $_POST['like'];

        if ($_POST['like'] === "like") {

            $response['status'] = "like";
            $like->doLike($_POST['postval']);
        }

    }

    // UNLIKE POST
    if( !empty( $_POST["unlike"] ) ) {

        $like->LikedPostID = $_POST['unlike'];

        if ($_POST['unlike'] === "unlike") {

            $response['status'] = "unlike";
            $like->doUnlike($_POST['postval']);
        }
    }

?>