<?php

    // IMDSTAGRAM CODE: USER CLASS - Last edited: 20/03/2016
    //######################################################

    include_once ("db.class.php");

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

        //CHECK USERNAME AVAILIBILITY
        public function UsernameAvailable()
        {
            $username = $this->m_sUsername;
            $PDO = Db::getInstance(); //open connection to Dbase
            $sSql = $PDO->prepare("select * from users where username = '" . $username . "';");
            $sSql->execute();
            $rResult = $sSql->num_rows();
            if ($rResult != 0) {
                throw new Exception('Oops! Something went wrong!');
            } else {
                return false;
            }
        }

        // SIGNUP FUNCTION
        public function Register() {

            // VERIFICATION: IF FILLED IN
            if(!empty($this->m_sUsername) && !empty($this->m_sFullname) && !empty($this->m_sEmail) && !empty($this->m_sPassword)) {
                if ($this->UsernameAvailable() == false) {
                    // CONNECTION WITH DATABASE
                    $PDO = Db::getInstance();

                    // PREPARE QUERY
                    $statement = $PDO->prepare("INSERT INTO Users (username, fullname, email, password) VALUES (:username, :fullname, :email, :password)");

                    // HASH PASSWORD
                    $options = ['cost' => 12];
                    $password = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);

                    // BIND VALUES TO QUERY
                    $statement->bindValue(":username", $this->m_sUsername);
                    $statement->bindValue(":fullname", $this->m_sFullname);
                    $statement->bindValue(":email", $this->m_sEmail);
                    $statement->bindValue(":password", $password);

                    $statement->execute();
                } else {
                }
            }
        }
    
        
        
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
        
        //IF IT'S POSSIBLE TO LOGIN, LOGIN
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
        
        /*public function getInfo(){
            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Users WHERE email = :email");
            $statement->bindValue(":email", $this->m_sEmail, PDO::PARAM_STR );
            $statement->execute();
            
            return $statement;
        }*/
        
        // CHANGE USER INFO FUNCTION
        /*public function Update( $p_sPrevName ){
            
            if(!empty($this->m_sUsername) && !empty($this->m_sFullname) && !empty($this->m_sEmail) && !empty($this->m_sPassword)){
                
                // CONNECTION WITH DATABASE
                $conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "");
                
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
            }
        }*/

        public function Update() {
            if(!empty($_POST)) {

                if ($_POST['action'] === "verander") {

                    if ($_POST['old_password'] === $_SESSION['password']) {

                        if (!empty($_POST["fullname"])) {

                            $feedback = "Fullname has your attention";


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
        }
    }
?>