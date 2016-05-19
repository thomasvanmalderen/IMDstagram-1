<?php

    // IMDSTAGRAM AJAX CODE: COMMENT ON A POST
    //######################################################

    include_once("../classes/db.class.php");
    include_once("../classes/Comment.class.php");

    session_start();
    $comment = new Comment();

    // CHECK IF COMMENT IS SUMBITTED -> POST COMMENT
        if( !empty($_POST['comment'] ) ) {

            $comment->Comment = $_POST['comment'];
            $comment->PostID = $_POST['postid'];

            try {
                $comment->SaveComment();
                $response['status'] = 'success';
                $response['comments'] = $_POST['comment'];
                $response['username'] = $_SESSION['username'];
            } catch (Exception $e) {
                $feedback = $e->getMessage();
                $response['status'] = 'error';
                $response['comments'] = $feedback;
            }

            header('Content-Type: application/json');
            echo json_encode($response);// de array encoderen via json zodat javascript dit kan lezen. {status: 'error', message: ''}
    }


?>