<?php

    // IMDSTAGRAM CODE: LOGIN FORM - Last edited: 17/03/2016
    //######################################################

    // INCLUDE CLASSES
    include_once("classes/user.class.php");

    if(!empty($_POST)){
        
        
		if( !empty($_POST["username"]) && !empty($_POST["password"])){
            
			$userLogin = new User();
			$userLogin->Username = $_POST["username"];
			$userLogin->Password = $_POST["password"];
            
            // IF LOGIN SUCCESSFUL
			if( $userLogin->canLogin()){
				$_SESSION['loggedin'] = true;
                
                echo "success";
				header('Location: index.php');
                
            } else {
                echo "not logged in :T";
                
			}
		}else{
            echo "empty!";
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
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="text" name="username" placeholder="Username" /><br>
		<input type="password" name="password" placeholder="Password" /><br>
		<input type="checkbox" name="rememberme" value="yes" id="rememberme">
		<label for="rememberme">Remember me</label>
        <br>
		<input type="submit" name="btnLogin" value="Log in" />
		</form>
		
	</section>
    
</body>
</html>