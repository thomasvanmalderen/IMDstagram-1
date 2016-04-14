<?php

    // IMDSTAGRAM CODE: REGISTER FORM - Last edited: 14/04/2016
    //######################################################
    
    // INCLUDE CLASSES
    include_once("classes/db.class.php");
    include_once("classes/user.class.php");
    
    // ON POST FORM: REGISTER USER
    if( !empty($_POST) ) {
        
        
        if( !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST['password']) ) {
            
            $user = new User();
            $user->Firstname = $_POST["firstname"];
            $user->Lastname = $_POST["lastname"];
            $user->Username = $_POST["username"];
            $user->Email = $_POST["email"];
            $user->Password = $_POST["password"];
            $user->Register();
            
        } else {
            
            $_SESSION['loginfeedback'] = "Please fill in all the fields.";
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram - Sign up for free!</title>
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css">
     <link rel="stylesheet" href="css/bootstrap-theme.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
</head>
<body>
    
    <section id="login">
        <div id="logo">IMDstagram</div>
        <?php if(isset($_SESSION['loginfeedback'])): ?>
        <div class="feedback"><?php echo $_SESSION['loginfeedback']; ?></div>
        <?php else: ?>
	    <!--<div class="feedback">Gelieve alle velden in te vullen</div>-->
	    <?php endif; ?>
        <h2>Sign up to see photos and videos from your friends.</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="firstname" placeholder="First name" />
            <input type="text" name="lastname" placeholder="Last name" />
            <input type="text" name="username" placeholder="Username" />
            <input type="text" name="email" placeholder="Email" />
            <input type="password" name="password" placeholder="Password" />

            <input type="hidden" name="action" value="registreer">
            <input type="submit" name="btnSignup" value="Sign up"/>
        </form>

      </section>
       <section id="account">

        <h4>Already an account <a href="login.php">Click here to log in!</a></h4>
        
         <br>
        
        <h4>By signing up, you agree to our Terms &amp; Privacy Policy.</h4>
        </section>
        
        <!--Feedback section-->

       
        
        

    
</body>
</html>