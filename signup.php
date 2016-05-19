<?php

    // IMDSTAGRAM CODE: REGISTER FORM
    //######################################################

    include_once("classes/Db.class.php");
    include_once("classes/User.class.php");

    // SEND SIGNUP INFORMATION
    if( !empty($_POST) ) {
        
        if( !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST['password']) ) {
            
            $user = new User();
            $user->Firstname = htmlspecialchars($_POST["firstname"]);
            $user->Lastname = htmlspecialchars($_POST["lastname"]);
            $user->Username = htmlspecialchars($_POST["username"]);
            $user->Email = htmlspecialchars($_POST["email"]);
            $user->Password = htmlspecialchars($_POST["password"]);

            if( $user->UsernameAvailable() ) {
                $_SESSION['loginfeedback'] = "Username already taken";

            } else {
                $user->Register();
                header('Location: index.php');
            }
        } else {
            $_SESSION['loginfeedback'] = "Please fill in all the fields.";
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDstagram - Sign up for free!</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.1.min.js" integrity="sha256-gvQgAFzTH6trSrAWoH1iPo9Xc96QxSZ3feW6kem+O00=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</head>
<body>
    
    <section id="login">
        <div id="logo">IMDstagram</div>

        <h2>Sign up to see photos and videos from your friends.</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="firstname" placeholder="First name" />
            <input type="text" name="lastname" placeholder="Last name" />
            <input type="text" name="username" placeholder="Username" id="username" />

            <input type="email" name="email" placeholder="Email" />
            <input type="password" name="password" placeholder="Password" />

            <input type="hidden" name="action" value="registreer">
            <input type="submit" name="btnSignup" value="Sign up"/>
            <div class="usernameFeedback"><span></span></div>
            <?php if(isset($_SESSION['loginfeedback'])): ?>
                <div class="feedback"><?php echo $_SESSION['loginfeedback']; ?></div>
            <?php else: ?>
                <!--<div class="feedback">Gelieve alle velden in te vullen</div>-->
            <?php endif; ?>
        </form>



      </section>
       <section id="account">
        <h4>Already an account <a href="login.php">Click here to log in!</a></h4>
        
         <br>
        
        <h4>By signing up, you agree to our Terms &amp; Privacy Policy.</h4>
        </section>
        <!--Feedback section-->

    <?php if (isset($feedback)): ?>
        <div class="feedback">
            <?php echo $feedback; ?>
        </div>
    <?php endif;?>
       
        
        

    
</body>
</html>