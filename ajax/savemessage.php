<?php
    //message ophalen $_POST

    //new Activity
    // ->Save();

    // antwoorden JSON

    include_once("../classes/Activity.class.php");
    $activity = new Activity();

//controleer of er een update wordt verzonden
    if(!empty($_POST['message']))
        {
         $activity->Text = $_POST['message'];
         try
          {
             $activity->Save();
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