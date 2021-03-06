<?php

    // IMDSTAGRAM CODE: POST CLASS
    //######################################################

    class Post {

        private $m_sPicture;
        private $m_sDescription;
        private $m_iUserID;
        private $m_sLocation;
        private $m_sFilter;

        // SETTER FUNCTION
        public function __set( $p_sProperty, $p_vValue ) {

            switch ( $p_sProperty ) {
                case "Picture":
                    $this->m_sPicture = $p_vValue;
                    break;

                case "Description":
                    $this->m_sDescription = $p_vValue;
                    break;

                case "Reports":
                    $this->m_sDescription = $p_vValue;
                    break;

                case "UserID":
                    $this->m_iUserID = $p_vValue;
                    break;

                case "Location":
                    $this->m_sLocation = $p_vValue;
                    break;

                case "Filter":
                    $this->m_sFilter = $p_vValue;
                    break;
            }
        }

        // GETTER FUNCTION
        public function __get( $p_sProperty ) {
            switch ($p_sProperty) {
                case "Description":
                    return $this->m_sDescription;
                    break;

                case "UserID":
                    return $this->m_iUserID;
                    break;

                case "Location":
                    return $this->m_sLocation;
                    break;

                case "Filter":
                    return $this->m_sFilter;
                    break;
            }
        }

        // SAVE / UPLOAD POST
        public function PostSaveImage() {

            $todir = 'images/posts/';
            $ext = strtolower(end(explode('.',$_FILES['pictures']['name'])));

            if ($_FILES["pictures"]["size"] < 2097152) {
                if (($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif")) {
                    $newname = $_SESSION['username'] . "-" . time() . "-" . $_FILES['pictures']['name'];
                    if (!file_exists($todir . $newname)) {
                        if ((move_uploaded_file($_FILES['pictures']['tmp_name'], $todir . $newname))) {
                            //file is uploaded
                        } else {
                            echo "Error: A problem occurred during file upload!";
                        }
                    }
                }
            }


            $PDO = Db::getInstance();
            $statement = $PDO->prepare("INSERT into posts (picture, description, posttime,idUser, location, filter) VALUES (:picture, :description, :posttime, :idUser, :location, :filter)");
            $statement->bindValue(":picture", $todir . $newname);
            $statement->bindValue(":description", $this->m_sDescription);
            $statement->bindValue(":posttime", date("Y-m-d H:i:sa"));
            $statement->bindValue(":idUser", $_SESSION['u_id']);
            $statement->bindValue(":location", $this->Location);
            $statement->bindValue(":filter", $this->Filter);
            $statement->execute();
        }

        // IMAGE SPECS VERIFICATION ( IMAGE SIZE AND TYPE )
        public function CanSaveImage() {

            if ($_FILES["pictures"]["size"] < 2097152) {
                $ext = strtolower(end(explode('.', $_FILES['pictures']['name'])));
                if (($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif")) {
                    return true;
                } else {
                    echo "Only jpg/jpeg/png/gif images are accepted for upload";
                return false;
                }
            } else {
                echo "Your file is too big";
                return false;
            }
        }
        /*
        public function displayAll() {

            $PDO = Db::getInstance();
            $limit =20;
            $statement = $PDO->prepare("SELECT * FROM posts LEFT OUTER JOIN Users ON posts.idUser=users.u_id ORDER BY posts.posttime desc LIMIT $limit");
            $statement->execute();

            $result = $statement->fetchAll();
            return $result;
        }
    */
        // DISPLAY ALL POSTS OF INDICATED USER
        public function displayUserPosts() {

            $PDO = Db::getInstance();
            $p_user = $_GET['user'];
            $statement = $PDO->prepare("SELECT * FROM posts LEFT OUTER JOIN Users ON posts.idUser=users.u_id WHERE users.username = :user ORDER BY posttime DESC LIMIT 10");
            $statement->bindValue(":user", $p_user);
            $statement->execute();

            $result = $statement->fetchAll();
            return $result;

        }

        // DISPLAY ALL INFO OF INDICATED PICTURE
        public function DisplayPicture() {

            $PDO = Db::getInstance();
            $p_post = $_GET['post'];
            $statement = $PDO->prepare("SELECT * FROM posts LEFT OUTER JOIN Users ON posts.idUser=users.u_id WHERE posts.p_id = :post LIMIT 10");
            $statement->bindValue(":post", $p_post);
            $statement->execute();

            $result = $statement->fetchAll();
            return $result;
        }

        // DELETE INDICATED PICTURE FROM DATABASE
        public function removePicture() {

            $PDO = Db::getInstance();
            $statement = $PDO-> prepare("DELETE FROM posts WHERE p_id = " . $_GET['post']);
            $statement->execute();
        }

        // SEARCH FOR SPECIFIC TAGS, DESCRIPTIONS, OR LOCATION
        public function search() {

            $PDO = Db::getInstance();
            $statement = $PDO-> prepare("SELECT * FROM posts LEFT OUTER JOIN Users ON posts.idUser=users.u_id WHERE description LIKE '%" . $_SESSION['search']  . "%' OR location LIKE '%". $_SESSION['search'] . "%'");
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }

        // INDEX FEED: DISPLAY ONLY OWN POSTS AND POSTS OF USER THAT YOU FOLLOW
        public function displayPostsFollowing() {

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT DISTINCT p_id, picture, description, posttime, username, avatar, location, filter FROM posts LEFT JOIN users ON users.u_id = posts.idUser LEFT JOIN follows ON follows.idFollowed = posts.idUser LEFT JOIN reports ON reports.reportedPost = posts.p_id WHERE follows.idFollowing = " . $_SESSION['u_id'] . " OR Posts.idUser = " . $_SESSION['u_id'] . " ORDER BY posts.posttime desc LIMIT 0,5");
            $statement->execute();

            $result = $statement->fetchAll();
            return $result;
        }



    }

?>