<?php

    
    // IMDSTAGRAM CODE: LOGIN FORM - Last edited: 30/03/2016
    //######################################################

    // SESSION START
    session_start();

    // INCLUDE CLASSES
    include_once("classes/user.class.php");
    include_once("classes/db.class.php");


    // LOGIN 
    if(!empty($_POST)){
        
    if($_POST['action'] === "inloggen") {
        
        if(!empty($_POST["username"]) && !empty($_POST["password"])){
            $user = new User();
            $user->Username = $_POST["username"];
            $user->Password = $_POST["password"];
            
            if($user->canLogin()){
                
                // USER FOUND
                $user->DoLogin();
                header('Location: index.php');
            }  else {
                // USER NOT FOUND
                $feedback = "Could not log you on";
            }
            
        }else{
            // EMPTY FIELDS
            $feedback = "Please fill in all the fields";
        }
    } else {
        header('Location: login.php');
    }
    }


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram - Log In here!</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
</head>
<body>
      
       <section id="login">
       <div id="logo">IMDstagram</div>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="text" name="username" placeholder="Username" /><br>
		<input type="password" name="password" placeholder="Password" /><br>
		
        <input type="hidden" name="action" value="inloggen">
		<input type="submit" name="btnLogin" value="Log in" />
            <?php if(isset($feedback)): ?>
                <div class="feedback"><?php echo $feedback; ?></div>
            <?php else: ?>
                <!--<div class="feedback">Gelieve alle velden in te vullen</div>-->
            <?php endif; ?>
		</form>
		
	</section>
      <section id="account">
          <h4>Don't have a account? <a href="signup.php">Click here to create one.</a></h4>
      </section>
       
</body>
</html>