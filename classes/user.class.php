<?php

    // IMDSTAGRAM CODE: USER CLASS - Last edited: 14/04/2016
    //######################################################

    class User {
        
        // PRIVATE VARIABLES
        private $m_sUsername;
        private $m_sFirstname;
        private $m_sLastname;
        private $m_sEmail;
        private $m_sBio;
        private $m_sPassword;
        private $m_sAvatar;
        
        
        // SETTER FUNCTION
        public function __set($p_sProperty, $p_vValue)
        {
            switch ($p_sProperty){
                case "Username":
                    $this->m_sUsername = $p_vValue;
                    break;
                case "Firstname":
                    $this->m_sFirstname = $p_vValue;
                    break;
                case "Lastname":
                    $this->m_sLastname = $p_vValue;
                    break;
                case "Email":
                    $this->m_sEmail = $p_vValue;
                    break;
                case "Bio":
                    $this->m_sBio = $p_vValue;
                    break;
                case "Password":
                    $this->m_sPassword = $p_vValue;
                    break;
                case "Avatar":
                    $this->m_sAvatar = $p_vValue;
                    break;
            }
        }
        
        // GETTER FUNCTION
        public function __get($p_sProperty)
        {
            switch ($p_sProperty) {
                case "Username":
                    return $this->m_sUsername;
                    break;
                case "Firstname":
                    return $this->m_sFirstname;
                    break;
                case "Lastname":
                    return $this->m_sLastname;
                    break;
                case "Email":
                    return $this->m_sEmail;
                    break;
                case "Bio":
                    return $this->m_sBio;
                    break;
                case "Password":
                    return $this->m_sPassword;
                    break;
                case "Avatar":
                    return $this->m_sAvatar;
                    break;
            }
        }
        
        // LOGIN VERIFICATION FUNCTION
        public function canLogin() {
            
            if( !empty( $this->m_sUsername ) && !empty( $this->m_sPassword ) ) {
                
                $PDO = Db::getInstance();
                $statement = $PDO->prepare("SELECT * FROM Users WHERE username = :username");
                $statement->bindValue(":username", $this->m_sUsername, PDO::PARAM_STR );
                $statement->execute();
                
                if( $statement->rowCount() > 0) {
                    
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                    $password = $this->m_sPassword;
                    $hash = $result['password'];
                    
                    if(password_verify($password, $hash)) {
                        return true;
                    } else{
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }
        
        // LOGIN SESSIONS FUNCTION
        public function DoLogin() {
            
            $_SESSION['loggedin'] = "thomasvm";
            $_SESSION['username_'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['username'] = $_SESSION['username_'];
            
            return true;
                  
        }
        
        // CHECK IF USER IS LOGGED IN
        public function Authenticate() {
            
            if ( isset( $_SESSION['loggedin'] ) ) {
        
                if ( $_SESSION['loggedin'] == "thomasvm" ) {
                    return true;
                } else {
                    echo "Session is not set correctly";
                }
        
            } else {
                echo "Session is empty";
            }
        }

        // SIGNUP FUNCTION
        public function Register() {
            
            // VERIFICATION: IF FILLED IN
            if(!empty($this->m_sUsername) && !empty($this->m_sFirstname) && !empty($this->m_sLastname) && !empty($this->m_sEmail) && !empty($this->m_sPassword)){
                
                // CONNECTION WITH DATABASE
                $conn = Db::getInstance();
                //$conn = mysqli_connect("localhost", "root", "root", "imd");
                
                // PREPARE QUERY
                $statement = $conn->prepare("INSERT INTO Users (username, firstname, lastname, email, password, avatar) VALUES (:username, :firstname, :lastname, :email, :password, :avatar)");
                
                // HASH PASSWORD
                $options = ['cost' => 12];
                $password = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);
                
                // BIND VALUES TO QUERY
                $statement->bindValue(":username", $this->m_sUsername);
                $statement->bindValue(":firstname", $this->m_sFirstname);
                $statement->bindValue(":lastname", $this->m_sLastname);
                $statement->bindValue(":email", $this->m_sEmail);
                $statement->bindValue(":avatar", "images/avatars/basic_avatar.jpg");
                $statement->bindValue(":password", $password);
                
                // CHECK IF USERNAME/EMAIL ALREADY EXISTS
                if ( $this->UsernameAvailable() ) {
                    
                    if ( $this->EmailAvailable() ){
                        $_SESSION['loginfeedback'] = "This username and email address are already taken!";
                    } else {
                        $_SESSION['loginfeedback'] = "This username is already taken!";
                    }
                    
                } else { 
                    
                    if ( $this->EmailAvailable() ) {
                        $_SESSION['loginfeedback'] = "This email address is already taken!";
                    } else {
                        $_SESSION['loginfeedback'] = "Welcome aboard!";
                        $statement->execute();
                    }
                    
                }
                
            }
            else {
            }
        }
        
        // CHECK IF USERNAME IS TAKEN
        public function UsernameAvailable() {
            
            $PDO = Db::getInstance();
            
            $statement = $PDO->prepare("SELECT username FROM Users WHERE username = :username");
            $statement->bindValue(":username", $this->m_sUsername);
            
            $statement->execute();
            $count = count( $statement->fetchAll() );
            
            if($count > 0){
                
                return true;
                
            } else {
                
                return false;
            }
            
            
        }


        
        // CHECK IF EMAILADDRESS IS TAKEN
        public function EmailAvailable() {
            
            $PDO = Db::getInstance();
            
            $statement = $PDO->prepare("SELECT email FROM Users WHERE email = :email");
            $statement->bindValue(":email", $this->m_sEmail);
            
            $statement->execute();
            $count = count( $statement->fetchAll() );
            
            if($count > 0){
                
                return true;
                
            } else {
                
                return false;
            }
            
            
        }
        
        // GET INFO OF USER
        public function getAllInfo() {
            
            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Users WHERE username = '" . $_SESSION['username_'] . "'");
            $statement->execute();
            $result = $statement->fetch();
            //return $result;
            
            $_SESSION['u_id'] = $result[0];
            $_SESSION['firstname'] = $result[2];
            $_SESSION['lastname'] = $result[3];
            $_SESSION['email'] = $result[4];
            $_SESSION['avatar'] = $result[6];
            $_SESSION['bio'] = $result[7];
        }
        
        // CHANGE USER INFO FUNCTION
        public function Update(){
             
            $PDO = Db::getInstance();
            $query = $PDO->prepare("SELECT u_id FROM Users WHERE username='" . $_SESSION['username_'] . "'");
            $query->execute();
            $result = $query->fetch( PDO::FETCH_OBJ );
            $v_result = $result->u_id;

            $allow = array("jpg", "jpeg", "png");
            $todir = 'images/avatars/';



                if (!!$_FILES['avatar']['tmp_name']) // is the file uploaded yet?
                {
                    $info = explode('.', strtolower($_FILES['avatar']['name'])); // whats the extension of the file

                    if (in_array(end($info), $allow)) // is this file allowed
                    {

                        $file_name = $_SESSION['username'] . "-" . time() . "-" . $_FILES['avatar']['name'];

                        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $todir . basename($file_name))) {

                        }


                    } else {
                        echo "<p>Your file isn't a \"jpg\", \"jpeg\" or a \"png\</p> <br>";
                    }
                }


            $this->getAllInfo();

            if( $_FILES['avatar']['name'] == ""){
                echo "gebruik session";
                $this->m_sAvatar = $_SESSION['avatar'];

            } else {
                if ($_FILES["avatar"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $this->m_sAvatar = $_SESSION['avatar'];
                } else {
                    echo "nieuwe file";
                    $this->m_sAvatar = $todir . $file_name;
                }
            }


            $options = ['cost' => 12];
            $password = password_hash( $this->m_sPassword, PASSWORD_DEFAULT, $options );
            
            $statement = $PDO->prepare('UPDATE Users SET username=:username, firstname=:firstname, lastname=:lastname, email=:email, password=:password, bio=:bio, avatar=:avatar WHERE u_id=' . $v_result);
            
            $statement->bindValue(":username", $this->m_sUsername);
            $statement->bindValue(":firstname", $this->m_sFirstname);
            $statement->bindValue(":lastname", $this->m_sLastname);
            $statement->bindValue(":email", $this->m_sEmail);
            $statement->bindValue(":bio", $this->m_sBio);
            $statement->bindValue(":avatar", $this->m_sAvatar);
            $statement->bindValue(":password", $password);


            $feedback = "Settings saved!";
            $statement->execute();
            $_SESSION['username_'] = $_POST["username"];
            $_SESSION['username'] = $_POST["username"];
            
        }

        public function getProfileInfo(){
            $PDO = Db::getInstance();
            $p_user = $_GET['user'];
            $statement = $PDO->prepare('SELECT * FROM Users WHERE username=:username');
            $statement->bindValue(":username", $p_user);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;

        }

    }

?>