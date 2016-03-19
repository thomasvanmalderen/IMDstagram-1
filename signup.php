<?php

    // IMDSTAGRAM CODE: REGISTER FORM - Last edited: 19/03/2016
    //######################################################
    
    // INCLUDE CLASSES
    include_once("classes/user.class.php");
    

    
    // ON POST FORM: REGISTER USER
    if( !empty($_POST) ) {
        
        
        if(!empty($_POST["fullname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST['password'])) {
            
            $user = new User();
            $user->Fullname = $_POST["fullname"];
            $user->Username = $_POST["username"];
            $user->Email = $_POST["email"];
            $user->Password = $_POST["password"];
            $user->Register();
            
            $feedback = "Welcome aboard!";
        } else {
            $feedback = "Gelieve alle velden in te vullen.";
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram - Sign up for free!</title>
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
    
    <section id="signup">
        <!-- IMDstagram Logo goes here -->
        <?php if(isset($feedback)): ?>
        <div class="feedback"><?php echo $feedback; ?></div>
        <?php else: ?>
	    <!--<div class="feedback">Gelieve alle velden in te vullen</div>-->
	    <?php endif; ?>
        <h2>Sign up to see photos and videos from your friends.</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="fullname" placeholder="Full name" />
            <input type="text" name="username" placeholder="username" />
            <input type="email" name="email" placeholder="Email" />
            <input type="password" name="password" placeholder="Password" />

            <input type="hidden" name="action" value="registreer">
            <input type="submit" name="btnSignup" value="Sign up"/>
        </form>
        
        <!--Feedback section-->
        
        <h4>By signing up, you agree to our Terms &amp; Privacy Policy.</h4>

    </section>
</body>
</html>