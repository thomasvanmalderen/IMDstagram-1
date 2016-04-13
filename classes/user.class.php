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
            $_SESSION['username'] = $_POST['username'];
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
        
        // CHANGE USER INFO FUNCTION
        public function Update( $p_sPrevName ){
            
            
            
            /*if(!empty($this->m_sUsername) && !empty($this->m_sFullname) && !empty($this->m_sEmail) && !empty($this->m_sPassword)){
                
                // CONNECTION WITH DATABASE
                $conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "root");
                
                //$query = mysql_query("SELECT * FROM Users");
                //$row = mysql_fetch_array($query);
                //print_r($row);
                
                // PREPARE QUERY
                $statement = $conn->prepare("UPDATE Users SET username=:username, fullname=:fullname, email=:email, password=:password WHERE username=:prevName");
                
                // HASH PASSWORD
                $options = ['cost' => 12];
                $password = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);
                
                // BIND VALUES TO QUERY
                $statement->bindValue(":prevName", $p_sPrevName);
                $statement->bindValue(":username", $this->m_sUsername);
                $statement->bindValue(":fullname", $this->m_sFullname);
                $statement->bindValue(":email", $this->m_sEmail);
                $statement->bindValue(":password", $password);
                
                $statement->execute();
            }
            else {
            }*/
        }
    }
?>