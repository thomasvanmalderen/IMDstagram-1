<?php
include_once("../classes/db.class.php");
include_once("../classes/user.class.php");

    $user = new User();
    if(!empty($_POST['username'])) {
	        $user->Username = $_POST['username'];

	        if($user->UsernameAvailable()) {
				$response['status'] = "error";
				$response['message'] = 'Username already taken';
		       } else {

				$response['status'] = 'success';
				$response['message'] = 'Username available';
		        }

         header('Content-type: application/json');
         echo json_encode($response);
     }