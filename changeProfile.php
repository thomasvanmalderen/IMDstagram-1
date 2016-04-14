<?php
    // IMDSTAGRAM CODE: LOGIN FORM - Last edited: 24/03/2016
    //######################################################
    session_start();
    // INCLUDE CLASSES
    include_once("classes/user.class.php");
    include_once("classes/db.class.php");
    // CHANGE INFO FUNCTION

    $user = new User();
    $user->getAllInfo();
    
    
    if(!empty($_POST)) {
        
        if ($_POST['action'] === "verander") {
            
            if ($_POST['old_password'] === $_SESSION['password']) {
                
                if (!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["email"])) {
                    $changer = new User();
                    $changer->Firstname = $_POST["firstname"];
                    $changer->Lastname = $_POST["lastname"];
                    $changer->Username = $_POST["username"];
                    $changer->Email = $_POST["email"];
                    $changer->Bio = $_POST["bio"];
                    
                    if(empty($_POST['new_password'])){
                        $changer->Password = $_SESSION['password'];
                    } else {
                        $changer->Password = $_POST['new_password'];
                    }
                    
                    
                    $changer->Update();
                    header('Location: index.php');
                    //$_SESSION['username_'] = $_POST["username"];
                    //$_SESSION['username'] = $_POST["username"];
                    
                } elseif(!empty($_POST["firstname"]) || !empty($_POST["lastname"]) || !empty($_POST["username"]) || !empty($_POST["email"]))  {
                    // USER NOT FOUND
                    $changer = new User();
                    $changer->Firstname = $_POST["firstname"];
                    $changer->Lastname = $_POST["lastname"];
                    $changer->Username = $_POST["username"];
                    $changer->Email = $_POST["email"];
                    $changer->Bio = $_POST["bio"];
                    
                    if(empty($_POST['new_password'])){
                        $changer->Password = $_SESSION['password'];
                    } else {
                        $changer->Password = $_POST['new_password'];
                    }
                    
                    
                    $changer->Update();
                    header('Location: index.php');
                    
                    
                } elseif(empty($_POST["firstname"]) && empty($_POST["lastname"]) && empty($_POST["username"]) && empty($_POST["email"]) && empty($_POST["bio"]) && !empty($_POST["password"])) {
                    $feedback = "You asked for no changes";
                } else {
                    
                }
            } else {
                //WRONG PASSWORD
                $feedback = "Wrong password";
            }
        } else {
            // EMPTY FIELDS
            $feedback = "You cannot send an empty form";
        }
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile settings</title>
</head>
<body>

    <a href="index.php">Back to home</a>
    
    <section id="signup">
        <!-- IMDstagram Logo goes here -->
        <?php if(isset($feedback)): ?>
        <div class="feedback"><?php echo $_SESSION['loginfeedback']; ?></div>
        <?php else: ?>
	    <!--<div class="feedback">Gelieve alle velden in te vullen</div>-->
	    <?php endif; ?>
        <h2>Change your settings here</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="firstname">New first name</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['firstname']; ?>"/>
            <br>
            <label for="lastname">New last name</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['lastname']; ?>"/>
            <br>
            <label for="username">New username</label>
                <input type="text" name="username" id="username" value="<?php echo $_SESSION['username_']; ?>"/>
            <br>
            <label for="email">New email</label>
                <input type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>"/>
            <br>
            <label for="new_password">New password</label>
                <input type="password" name="new_password" placeholder="Password" id="new_password" />
            <br>
            <label for="bio">Biography</label>
                <input type="text" name="bio" id="bio" value="<?php echo $_SESSION['bio']; ?>"/>
            <br>
            <br>

            <label for="old_password">Type here your current password for validation</label>
            <input type="password" name="old_password" placeholder="Current password" id="old_password">


            <input type="hidden" name="action" value="verander">
            <input type="submit" name="btnSignup" value="Save changes"/>
        </form>
    </section>
        
</body>
</html>