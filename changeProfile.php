<?php

    // IMDSTAGRAM CODE: LOGIN FORM - Last edited: 14/04/2016
    //######################################################
    
    ob_start();
    // START SESSION
    session_start();

    // INCLUDE CLASSES
    include_once("classes/user.class.php");
    include_once("classes/db.class.php");

    // GET USER INFO
    $user = new User();
    
    if($user->Authenticate()){

    } else {
        header('Location: login.php');
    }

    $user->getAllInfo();
    
    
    if( !empty($_POST) ) {
        
        if ( $_POST['action'] === "verander" ) {
            
            if ( $_POST['old_password'] === $_SESSION['password'] ) {
                
                if ( !empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_FILES["avatar"]) ) {
                    
                    // ALL FILLED IN (EXCEPT PASSWORD)
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
                        $_SESSION['password'] = $_POST['new_password'];
                    }

                    $changer->Avatar = $_FILES["avatar"];

                    if($_POST['username'] == $_SESSION['username_'] && $_POST['email'] == $_SESSION['email']){

                        $changer->Update();
                        header('Location: profile.php?user=' . $_SESSION['username_']);

                    } elseif($_POST['username'] == $_SESSION['username_']) {
                        if($changer->EmailAvailable()){
                            $feedback="This email address is already taken.";
                        } else {

                            $changer->Update();
                            header('Location: profile.php?user=' . $_SESSION['username_']);
                        }

                    } elseif($_POST['email'] == $_SESSION['email']) {
                        if($changer->UsernameAvailable()){
                            $feedback="This username is already taken.";
                        } else {

                            $changer->Update();
                            header('Location: profile.php?user=' . $_SESSION['username_']);
                        }

                    } else {

                        if($changer->UsernameAvailable() || $changer->EmailAvailable()){
                            $feedback="This username and/or email address is already taken.";
                        } else {

                            $changer->Update();
                            header('Location: profile.php?user=' . $_SESSION['username_']);
                        }
                    }




                    
                } elseif( !empty($_POST["firstname"]) || !empty($_POST["lastname"]) || !empty($_POST["username"]) || !empty($_POST["email"]) || !empty($_POST["avatar"]) ) {
                    
                    
                    // SOME FIELDS LEFT EMPTY
                    $changer = new User();
                    $changer->Firstname = $_POST["firstname"];
                    $changer->Lastname = $_POST["lastname"];
                    $changer->Username = $_POST["username"];
                    $changer->Email = $_POST["email"];
                    $changer->Bio = $_POST["bio"];

                    if ($_FILES["avatar"]['name'] == "") {
                        $changer->Avatar = $_SESSION["avatar"];
                    }
                    else {

                        $changer->Avatar = $_FILES["avatar"];
                    }
                    
                    if(empty($_POST['new_password'])){
                        $changer->Password = $_SESSION['password'];
                    } else {
                        $changer->Password = $_POST['new_password'];
                        $_SESSION['password'] = $_POST['new_password'];
                    }

                    if($_POST['username'] == $_SESSION['username_']){
                        if($changer->EmailAvailable()){
                            $feedback="This email address is already taken.";
                        } else {

                            $changer->Update();
                            //header('Location: profile.php?user=' . $_SESSION['username_']);
                        }
                    } else {
                        if($changer->UsernameAvailable() || $changer->EmailAvailable()){
                            $feedback="This username and/or email address is already taken.";
                        } else {

                            $changer->Update();
                            //header('Location: profile.php?user=' . $_SESSION['username_']);
                        }
                    }
                    
                    
                } elseif ( empty($_POST["firstname"]) && empty($_POST["lastname"]) && empty($_POST["username"]) && empty($_POST["email"]) && empty($_POST["bio"]) && !empty($_POST["password"]) ) {
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
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.1.min.js" integrity="sha256-gvQgAFzTH6trSrAWoH1iPo9Xc96QxSZ3feW6kem+O00=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</head>
<body>

<?php include_once("nav.inc.php") ?>
    
    <section id="center">
        <!-- IMDstagram Logo goes here -->


        <h3>Change your settings here</h3>
        <?php if(isset($feedback)){; ?>
            <h1><?php echo $feedback; ?></h1>
        <?php }; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <img src="<?php echo $_SESSION['avatar']; ?>" alt="<?php echo $_SESSION['username'] . " avatar"; ?>" class="avatar">
            <br>
            <div class="changeavatar">
            <label for="file" class="profilelabel">Avatar</label>
            <input type="file" name="avatar" id="avatar" class="profileinput" ?>
            <br>
            </div>
            <label for="firstname" class="profilelabel">First name</label>
            <input type="text" name="firstname" id="firstname" class="profileinput" value="<?php echo $_SESSION['firstname']; ?>"/>
            <br>
            <label for="lastname" class="profilelabel">Last name</label>
            <input type="text" name="lastname" id="lastname" class="profileinput" value="<?php echo $_SESSION['lastname']; ?>"/>
            <br>
            <label for="username" class="profilelabel">Username</label>
                <input type="text" name="username" id="username" class="profileinput" value="<?php echo $_SESSION['username_']; ?>"/>
            <br>
            <label for="email" class="profilelabel">Email</label>
                <input type="email" name="email" id="email" class="profileinput" value="<?php echo $_SESSION['email']; ?>"/>
            <br>
            <label for="new_password" class="profilelabel">New Password</label>
                <input type="password" name="new_password" class="profileinput" placeholder="New password" id="new_password" />
            <br>
            <label for="bio" class="profilelabel">Biography</label>
                <input type="text" name="bio" id="bio" class="profileinput" value="<?php echo $_SESSION['bio']; ?>"/>
            <br>
            <br>

            <label for="old_password" class="profilelabel">Type here your current password for validation</label>
            <input type="password" name="old_password" class="profileinput" placeholder="Current password" id="old_password">


            <input type="hidden" name="action" value="verander">
            <input type="submit" name="btnSignup" class="profileinput" value="Save changes"/>

        </form>
        <div class="usernameFeedback"><span></span></div>
    </section>
        
</body>
</html>