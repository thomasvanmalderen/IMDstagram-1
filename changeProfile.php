<?php

    // IMDSTAGRAM CODE: LOGIN FORM - Last edited: 20/03/2016
    //######################################################

    session_start();

    // INCLUDE CLASSES
    include_once("classes/user.class.php");
    include_once("classes/db.class.php");

    // CHANGE INFO FUNCTION

    if(!empty($_POST)) {

        if ($_POST['action'] === "verander") {

            if ($_POST['old_password'] === $_SESSION['password']) {

                if (!empty($_POST["fullname"])) {

                    $feedback = "Fullname has your attention";
                    $changer = new User();
                    $changer->Fullname = $_POST["fullname"];

                    // CONNECTION WITH DATABASE
                    /*$email = $_SESSION['email'];*/

                    $PDO = Db::getInstance();

                    /*$query = $PDO->prepare("SELECT id FROM users WHERE email='$email'");
                    $query->execute();
                    $result = $query->fetchAll();
                    $v_result = var_dump((string)$result);
                    // PREPARE QUERY
                    $statement = $PDO->prepare('UPDATE Users SET fullname=:fullname WHERE id=' . $v_result[0]);

                    // BIND VALUES TO QUERY
                    $statement->bindValue(":fullname", $this->Fullname);

                    $statement->execute();*/



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
        <h2>Change you settings here</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="fullname">New fullname</label>
                <input type="text" name="fullname" placeholder="Full name" id="fullname" />
            <br>
            <label for="username">New username</label>
                <input type="text" name="username" placeholder="Username" id="username" />
            <br>
            <label for="email">New email</label>
                <input type="email" name="email" placeholder="Email" id="email" />
            <br>
            <label for="new_password">New password</label>
                <input type="password" name="new_password" placeholder="Password" id="new_password" />
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