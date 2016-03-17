<?php

    // IMDSTAGRAM CODE: USER CLASS - Last edited: 17/03/2016
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
        
        
        // LOGIN FUNCTION
        public function canLogin() {
            
            if(!empty($this->m_sUsername) && !empty($this->m_sPassword)){
                
                $conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "root");
                $stmt = $conn->prepare("SELECT * FROM Users WHERE email = :email");
                $stmt->bindValue(":email", $this->m_sEmail, PDO::PARAM_STR );
                $stmt->execute();
                
                if($stmt->rowCount() > 0){
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $password = $this->m_sPassword;
                    $hash = $result['password'];
                    
                    if(password_verify($password, $hash)) {
                        $this->createSession($result['user_id']);
                        return true;
                        
                        } else{
                        
                            return false;
                        }
                    } else {
                        return false;
                    }
            }
        }
        
        // SIGNUP FUNCTION
        public function Register() {
            
            // VERIFICATION: IF FILLED IN
            if(!empty($this->m_sUsername) && !empty($this->m_sFullname) && !empty($this->m_sEmail) && !empty($this->m_sPassword)){
                
                // CONNECTION WITH DATABASE
                $conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "root");
                
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
                
                $statement->execute();
            }
            else {
            }
        }
    }
?>