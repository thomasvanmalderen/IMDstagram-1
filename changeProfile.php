<?php

    // IMDSTAGRAM CODE: LOGIN FORM - Last edited: 20/03/2016
    //######################################################

    // INCLUDE CLASSES
    include_once("classes/user.class.php");
    include_once("classes/db.class.php");

    // CHANGE INFO FUNCTION
    if(!empty($_POST)){
        
    if($_POST['action'] === "verander") {
        
        if( !empty($_POST["fullname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
            $
            
            $user = new User();
            $user->Fullname = $_POST["fullname"];
            $user->Username = $_POST["username"];
            $user->Email = $_POST["email"];
            $user->Password = $_POST["password"];
            $user->Update($_POST["username"]);
            //$_SESSION['email'] = $_POST["email"];
                
            }  else {
                // USER NOT FOUND
                $feedback = "Could not save changes";
            }
        }else{
            // EMPTY FIELDS
            $feedback = "Please fill in all the fields";
        }
    }
    



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

    <a href="index.php">Back to home</a>
    
    <section id="signup">
        <!-- IMDstagram Logo goes here -->
        <?php if(isset($feedback)): ?>
        <div class="feedback"><?php echo $feedback; ?></div>
        <?php else: ?>
	    <!--<div class="feedback">Gelieve alle velden in te vullen</div>-->
	    <?php endif; ?>
        <h2>Change you settings here</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="fullname" placeholder="Full name" />
            <input type="text" name="username" placeholder="Username" />
            <input type="email" name="email" placeholder="Email" />
            <input type="password" name="password" placeholder="Password" />

            <input type="hidden" name="action" value="verander">
            <input type="submit" name="btnSignup" value="Save changes"/>
        </form>
    </section>
        
</body>
</html>