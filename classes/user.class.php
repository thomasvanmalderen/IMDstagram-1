<?php

    // IMDSTAGRAM CODE: USER CLASS - Last edited: 20/03/2016
    //######################################################

    class User {
        
        // PRIVATE VARIABLES
        private $m_sUsername;
        private $m_sFullname;
        private $m_sEmail;
        private $m_sPassword;
        
        
        // SETTER FUNCTION
        public function __set($p_sProperty, $p_vValue)
        {
            switch ($p_sProperty){
                case "Username":
                    $this->m_sUsername = $p_vValue;
                    break;
                case "Fullname":
                    $this->m_sFullname = $p_vValue;
                    break;
                case "Email":
                    $this->m_sEmail = $p_vValue;
                    break;
                case "Password":
                    $this->m_sPassword = $p_vValue;
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
                case "Fullname":
                    return $this->m_sName;
                    break;
                case "Email":
                    return $this->m_sEmail;
                    break;
                case "Password":
                    return $this->m_sPassword;
                    break;
            }
        }
        
        //SESSIONS
    
        
        
        // LOGIN FUNCTION
        public function canLogin() {
            
            if(!empty($this->m_sUsername) && !empty($this->m_sPassword)){
                
                $PDO = Db::getInstance();
                $statement = $PDO->prepare("SELECT * FROM Users WHERE username = :username");
                $statement->bindValue(":username", $this->m_sUsername, PDO::PARAM_STR );
                $statement->execute();
                
                if($statement->rowCount() > 0){
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                    $password = $this->m_sPassword;
                    $hash = $result['password'];
                    
                    if(password_verify($password, $hash)) {
                        //$this->createSession($result['user_id']);
                        return true;
                        
                        } else{
                        
                            return false;
                        }
                    } else {
                        return false;
                    }
            }
        }
        
        //
        public function DoLogin() {
            
            $_SESSION['loggedin'] = "thomasvm";
            $_SESSION['username_'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
            
            return true;
                  
        }
        
        public function Authenticate(){
            
            if (!empty($_SESSION['loggedin'])){
        
                if ($_SESSION['loggedin'] == "thomasvm") {
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
            if(!empty($this->m_sUsername) && !empty($this->m_sFullname) && !empty($this->m_sEmail) && !empty($this->m_sPassword)){
                
                // CONNECTION WITH DATABASE
                $conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "root");
                //$conn = mysqli_connect("localhost", "root", "root", "imd");
                
                // PREPARE QUERY
                $statement = $conn->prepare("INSERT INTO Users (username, fullname, email, password) VALUES (:username, :fullname, :email, :password)");
                
                // HASH PASSWORD
                $options = ['cost' => 12];
                $password = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);
                
                // BIND VALUES TO QUERY
                $statement->bindValue(":username", $this->m_sUsername);
                $statement->bindValue(":fullname", $this->m_sFullname);
                $statement->bindValue(":email", $this->m_sEmail);
                $statement->bindValue(":password", $password);
                
                if ($this->UsernameAvailable()) {
                    
                    //echo "taken";
                    if ($this->EmailAvailable()){
                        $_SESSION['loginfeedback'] = "This username and email address are already taken!";
                    } else {
                        $_SESSION['loginfeedback'] = "This username is already taken!";
                    }
                    
                    
                } else { 
                    
                    if ($this->EmailAvailable()){
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
        public function UsernameAvailable(){
            
            $PDO = Db::getInstance();
            //$conn = mysqli_connect("localhost", "root", "root", "imd");
            //$conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "root");
            
            $statement = $PDO->prepare("SELECT username FROM Users WHERE username = :username");
            $statement->bindValue(":username", $this->m_sUsername);
            
            $statement->execute();
            $count = count($statement->fetchAll());
            
            if($count > 0){
                //echo "username taken";
                //echo $count;
                return true;
                
            } else {
                
                //echo "Vrij";
                return false;
            }
            
            
        }
        
        public function EmailAvailable(){
            
            $PDO = Db::getInstance();
            
            $statement = $PDO->prepare("SELECT email FROM Users WHERE email = :email");
            $statement->bindValue(":email", $this->m_sEmail);
            
            $statement->execute();
            $count = count($statement->fetchAll());
            
            if($count > 0){
                
                return true;
                
            } else {
                
                return false;
            }
            
            
        }
        
        public function getAllInfo(){
            
            //$conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "root");
            $PDO = Db::getInstance();
            
            $statement1 = $PDO->prepare("SELECT fullname FROM Users WHERE username = :username");
            $statement1->bindValue(":username", $_SESSION['username_']);
            $statement1->execute();
            $_SESSION['fullname'] = $statement1;
            
            $statement2 = $PDO->prepare("SELECT username FROM Users WHERE username = :username");
            $statement2->bindValue(":username", $_SESSION['username_']);
            $statement2->execute();
            $_SESSION['username'] = $statement2;
            
            $statement3 = $PDO->prepare("SELECT email FROM Users WHERE username = :username");
            $statement3->bindValue(":username", $_SESSION['username_']);
            $statement3->execute();
            $_SESSION['email'] = $statement3;
        }
        
        // CHANGE USER INFO FUNCTION
        public function Update(){
            
            $feedback = "Fullname has your attention";
            
            
            // CONNECTION WITH DATABASE
            
            $PDO = Db::getInstance();
            $query = $PDO->prepare("SELECT id FROM Users WHERE username='" . $_SESSION['username_'] . "'");
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            $v_result = $result->id;
    
            // PREPARE QUERY
            $statement = $PDO->prepare('UPDATE Users SET fullname=:fullname WHERE id=' . $v_result);
            // BIND VALUES TO QUERY
            $statement->bindValue(":fullname", $_POST['fullname']);
            $statement->execute();
            
            
        }
    }
?>