<?php

    // IMDSTAGRAM CODE: USER CLASS - Last edited: 20/03/2016
    //######################################################

    class User {
        
        // PRIVATE VARIABLES
        private $m_sUsername;
        private $m_sFirstname;
        private $m_sLastname;
        private $m_sEmail;
        private $m_sBio;
        private $m_sPassword;
        
        
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
            $_SESSION['username'] = $_SESSION['username_'];
            
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
            if(!empty($this->m_sUsername) && !empty($this->m_sFirstname) && !empty($this->m_sLastname) && !empty($this->m_sEmail) && !empty($this->m_sPassword)){
                
                // CONNECTION WITH DATABASE
                $conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "root");
                //$conn = mysqli_connect("localhost", "root", "root", "imd");
                
                // PREPARE QUERY
                $statement = $conn->prepare("INSERT INTO Users (username, firstname, lastname, email, password) VALUES (:username, :firstname, :lastname, :email, :password)");
                
                // HASH PASSWORD
                $options = ['cost' => 12];
                $password = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);
                
                // BIND VALUES TO QUERY
                $statement->bindValue(":username", $this->m_sUsername);
                $statement->bindValue(":firstname", $this->m_sFirstname);
                $statement->bindValue(":lastname", $this->m_sLastname);
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
            $statement = $PDO->prepare("SELECT * FROM Users WHERE username = '" . $_SESSION['username_'] . "'");
            //$statement1->bindValue(":username", );
            $statement->execute();
            $result = $statement->fetch();
            //return $result;
            
            //echo $result[3];
            $_SESSION['firstname'] = $result[2];
            $_SESSION['lastname'] = $result[3];
            $_SESSION['email'] = $result[4];
            $_SESSION['bio'] = $result[7];
            //var_dump($result[0][0]);
        }
        
        // CHANGE USER INFO FUNCTION
        public function Update(){
            
            
            //$this->getAllInfo(); 
            $PDO = Db::getInstance();
            $query = $PDO->prepare("SELECT id FROM Users WHERE username='" . $_SESSION['username_'] . "'");
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            $v_result = $result->id;
            
            $options = ['cost' => 12];
            $password = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);
            
            $statement = $PDO->prepare('UPDATE Users SET username=:username, firstname=:firstname, lastname=:lastname, email=:email, password=:password, bio=:bio WHERE id=' . $v_result);
            
            $statement->bindValue(":username", $this->m_sUsername);
            $statement->bindValue(":firstname", $this->m_sFirstname);
            $statement->bindValue(":lastname", $this->m_sLastname);
            $statement->bindValue(":email", $this->m_sEmail);
            $statement->bindValue(":bio", $this->m_sBio);
            $statement->bindValue(":password", $password);
            
            
            if($this->Username == $_SESSION['username_']){
                $_SESSION['loginfeedback'] = "Settings saved!";
                $statement->execute();
                $_SESSION['username_'] = $_POST["username"];
                $_SESSION['username'] = $_POST["username"];
            } else {
                
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
                        $_SESSION['loginfeedback'] = "Settings saved!";
                        $statement->execute();
                        $_SESSION['username_'] = $_POST["username"];
                        $_SESSION['username'] = $_POST["username"];
                    }
                    
                }
            }
            
            
            
            
            
            
        }
    }
?>