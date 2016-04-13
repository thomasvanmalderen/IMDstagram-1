<?php
    // IMDSTAGRAM CODE: LOGIN FORM - Last edited: 24/03/2016
    //######################################################
    session_start();
    // INCLUDE CLASSES
    include_once("classes/user.class.php");
    include_once("classes/db.class.php");
    // CHANGE INFO FUNCTION

    //$user = new User;
    //$user->getAllInfo();

    /*echo $_SESSION['fullname'];
    echo $_SESSION['username'];
    echo $_SESSION['email'];*/

    if(!empty($_POST)) {
        
        if ($_POST['action'] === "verander") {
            
            if ($_POST['old_password'] === $_SESSION['password']) {
                
                if (!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) ) {
                    $changer = new User();
                    $changer->Firstname = $_POST["firstname"];
                    $changer->Lastname = $_POST["lastname"];
                    $changer->Username = $_POST["username"];
                    $changer->Email = $_POST["email"];
                    $changer->Bio = $_POST["bio"];
                    $changer->Update();
                    
                } else {
                    // USER NOT FOUND
                    $feedback = "You asked for no changes";
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
        <div class="feedback"><?php echo $feedback; ?></div>
        <?php else: ?>
	    <!--<div class="feedback">Gelieve alle velden in te vullen</div>-->
	    <?php endif; ?>
        <h2>Change your settings here</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="firstname">New first name</label>
            <input type="text" name="firstname" placeholder="First name" id="firstname" value="$_SESSION['firstname'];"/>
            <br>
            <label for="lastname">New last name</label>
            <input type="text" name="lastname" placeholder="Last name" id="lastname" value=""/>
            <br>
            <label for="username">New username</label>
                <input type="text" name="username" placeholder="Username" id="username" value=""/>
            <br>
            <label for="email">New email</label>
                <input type="email" name="email" placeholder="Email" id="email" value=""/>
            <br>
            <label for="new_password">New password</label>
                <input type="password" name="new_password" placeholder="Password" id="new_password" />
            <br>
            <label for="bio">Biography</label>
                <textarea name="bio" id="bio" cols="30" rows="2" placeholder="Tell us something about yourself."></textarea>
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