<?php

    
    // IMDSTAGRAM CODE: LOGIN FORM - Last edited: 20/03/2016
    //######################################################

    // INCLUDE CLASSES
    include_once("classes/user.class.php");
    include_once("classes/db.class.php");

    //session_start();

    // LOGIN 
    if(!empty($_POST)){
        
    if($_POST['action'] === "inloggen") {
        
        if(!empty($_POST["email"]) && !empty($_POST["password"])){
            $user = new User();
            $user->Email = $_POST["email"];
            $user->Password = $_POST["password"];
            
            if($user->canLogin()){
                
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $_POST["email"];
                $_SESSION['loggedin'] = "thomasvm";
                $_SESSION['email'] = $_POST['email'];
                header('Location: index.php');
                
            }  else {
                // USER NOT FOUND
                $feedback = "Could not log you on";
            }
        }else{
            // EMPTY FIELDS
            $feedback = "Please fill in all the fields";
        }
    }
    }


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram - Log In</title>
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css">
    <link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.css">
</head>
<body>
   
   <!--<nav>
    <?php //if(isset($_SESSION['loggedin'])): ?>
        <a href="logout.php">Logout</a>
    <?php //else: ?>
        <a href="index.php">Login</a>
    <?php //endif; ?>
    </nav>-->
   
   <section id="login">
       <?php if(isset($feedback)): ?>
        <div class="feedback"><?php echo $feedback; ?></div>
        <?php else: ?>
	    <!--<div class="feedback">Gelieve alle velden in te vullen</div>-->
	    <?php endif; ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="text" name="email" placeholder="Email" /><br>
		<input type="password" name="password" placeholder="Password" /><br>
		<input type="checkbox" name="rememberme" value="yes" id="rememberme">
		<label for="rememberme">Remember me</label>
        <br>
        <input type="hidden" name="action" value="inloggen">
		<input type="submit" name="btnLogin" value="Log in" />
		</form>

       <br>

       <h4>You don't have a account? <a href="signup.php">Click here to create one</a></h4>
		
	</section>
    
</body>
</html>