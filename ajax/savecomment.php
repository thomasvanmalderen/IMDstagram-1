<?php
    //message ophalen $_POST

    //new Activity
    // ->Save();

    // antwoorden JSON

    include_once("../classes/Comment.class.php");
    $comment = new Comment();

//controleer of er een update wordt verzonden
    if(!empty($_POST['message']))
        {
         $comment->Text = $_POST['message'];
         try
          {
             $comment->SaveComment();
              $response['status'] = 'success';
              $response['message'] = 'Update successful';

          }
          catch (Exception $e)
         {
             $feedback = $e->getMessage();
             $response['status'] = 'error';
             $response['message'] = $feedback;
         }
            header('Content-Type: application/json');
           echo json_encode($response);// de array encoderen via json zodat javascript dit kan lezen. {status: 'error', message: ''}
    }


?>