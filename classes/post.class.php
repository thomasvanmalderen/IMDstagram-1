<?php

class Post {
    private $m_sPicture;
    private $m_sDescription;
    private $m_iReport;
    private $m_iUserID;



    public function __set($p_sProperty, $p_vValue)
    {
        switch ($p_sProperty) {
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
        }
    }
    public function __get($p_sProperty)
    {
        switch ($p_sProperty) {
            case "Description":
                return $this->m_sDescription;
                break;
            case "UserID":
                return $this->m_iUserID;
                break;
        }
    }

    public function PostSaveImage() {

        $file_name = $_SESSION['username'] . "-" . time() . "-" .$_FILES['pictures']['name'];
        $allow = array("jpg", "jpeg", "gif", "png");
        $todir = 'images/posts/';

        if ( $_FILES['pictures']['tmp_name'] ) // is the file uploaded yet?
        {
            $info = explode('.', strtolower( $_FILES['pictures']['name']) ); // whats the extension of the file

            if ( in_array( end($info), $allow) ) // is this file allowed
            {
                if ( move_uploaded_file( $_FILES['pictures']['tmp_name'], $todir . basename( $file_name ) ) )
                {

                }
            }
            else
            {
                echo "Error: " . $_FILES["pictures"]["error"] . "<br>";
            }
        }

        $PDO = Db::getInstance();
        $statement = $PDO->prepare("INSERT into posts (picture, description, posttime,idUser) VALUES (:picture, :description, :posttime, :idUser)");
        $statement->bindValue(":picture", $todir . $file_name);
        $statement->bindValue(":description", $this->m_sDescription);
        $statement->bindValue(":posttime", date("Y-m-d H:i:sa"));
        $statement->bindValue(":idUser", $_SESSION['u_id']);
        $statement->execute();
    }

    public function displayAll() {

        $PDO = Db::getInstance();
        $limit =20;

        $statement = $PDO->prepare("SELECT * FROM posts LEFT OUTER JOIN Users ON posts.idUser=users.u_id ORDER BY posts.posttime desc LIMIT $limit");
        $statement->execute();

        $result = $statement->fetchAll();
        
        return $result;

    }

    public function displayUserPosts() {

        $PDO = Db::getInstance();
        $p_user = $_GET['user'];
        $statement = $PDO->prepare("SELECT * FROM posts LEFT OUTER JOIN Users ON posts.idUser=users.u_id WHERE users.username = :user LIMIT 10");
        $statement->bindValue(":user", $p_user);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;

    }
    
    public function DisplayPicture(){

        $PDO = Db::getInstance();
        $p_post = $_GET['post'];
        $statement = $PDO->prepare("SELECT * FROM posts LEFT OUTER JOIN Users ON posts.idUser=users.u_id WHERE posts.p_id = :post LIMIT 10");
        $statement->bindValue(":post", $p_post);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }


    public function removePicture() {
        $PDO = Db::getInstance();
        $statement = $PDO-> prepare("DELETE FROM posts WHERE p_id = " . $_GET['post']);
        $statement->execute();
    }


    public function search() {
        $PDO = Db::getInstance();
        $statement = $PDO-> prepare("SELECT * FROM posts LEFT OUTER JOIN Users ON posts.idUser=users.u_id WHERE description LIKE '%" . $_SESSION['search']  . "%'");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
    
    /*public function loadmore(){
        $limit = $limit + 3;
    }*/


    public function displayPostsFollowing() {

        $PDO = Db::getInstance();
        $limit =20;

        $statement = $PDO->prepare("SELECT DISTINCT p_id, picture, description, posttime, username, avatar FROM posts LEFT JOIN users ON users.u_id = posts.idUser LEFT JOIN follows ON follows.idFollowed = posts.idUser WHERE follows.idFollowing = " . $_SESSION['u_id'] . " OR Posts.idUser = " . $_SESSION['u_id'] . " ORDER BY posts.posttime desc LIMIT 20");
        $statement->execute();

        $result = $statement->fetchAll();

        return $result;

    }



}

?>