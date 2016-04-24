<?php

class Post {
    private $m_sPicture;
    private $m_sDescription;
    private $m_sTags;
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
            case "Tags":
                $this->m_sTags = $p_vValue;
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

        if ( !!$_FILES['pictures']['tmp_name'] ) // is the file uploaded yet?
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
        $statement = $PDO->prepare("INSERT into posts (picture, description, tags, idUser) VALUES (:picture, :description, :tags, :idUser)");
        $statement->bindValue(":picture", $todir . $file_name);
        $statement->bindValue(":description", $this->m_sDescription);
        $statement->bindValue(":tags", $this->m_sTags);
        $statement->bindValue(":idUser", $_SESSION['id']);
        $statement->execute();
    }

    public function displayAll() {

        $PDO = Db::getInstance();
        $statement = $PDO->prepare("SELECT * FROM posts LEFT OUTER JOIN Users ON posts.idUser=users.id ORDER BY idUser desc");
        $statement->execute();
        $result = $statement->fetchAll();
        $result = array_slice($result, -20, 20, true);
        return $result;

    }

    public function search() {
        $PDO = Db::getInstance();
        $statement = $PDO-> prepare("SELECT * FROM posts LEFT OUTER JOIN Users ON posts.idUser=users.id WHERE description LIKE '%" . $_SESSION['search']  . "%' OR tags LIKE '%" . $_SESSION['search']  . "%'");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}

?>