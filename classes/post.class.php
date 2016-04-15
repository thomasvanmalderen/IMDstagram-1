<?php

class Post {
    private $m_sPicture;
    private $m_sDescription;
    private $m_sTags;
    private $m_iReports;
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

        $file_name = $_SESSION['username'] . "-" . time() . $_FILES['pictures']['name'];

        $allow = array("jpg", "jpeg", "gif", "png");

        $todir = 'images/posts/';

        if ( !!$_FILES['pictures']['tmp_name'] ) // is the file uploaded yet?
        {
            $info = explode('.', strtolower( $_FILES['pictures']['name']) ); // whats the extension of the file

            if ( in_array( end($info), $allow) ) // is this file allowed
            {
                if ( move_uploaded_file( $_FILES['pictures']['tmp_name'], $todir . basename( $file_name ) ) )
                {

                    echo "Upload: " .$file_name . "<br>";
                    echo "Type: " . $_FILES["pictures"]["type"] . "<br>";
                    echo "Size: " . ($_FILES["pictures"]["size"] / 1024) . " kB<br>";
                    echo "Stored in: " . $_FILES["pictures"]["tmp_name"];
                }
            }
            else
            {
                echo "Error: " . $_FILES["pictures"]["error"] . "<br>";
            }
        }
    }

    public function Save() {
        $conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "");
        $statement = $conn->prepare("insert into posts (description, userID) values (:description, :userID)");
        $statement->bindValue(":description", $this->m_sPost);
        $statement->bindValue(":userID", $this->m_iUserID);
        $result = $statement->execute();
        return $result;
    }
    public function GetAll() {
        $conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "");
        $statement = $conn->prepare("select * from posts where userID = ".$_SESSION['userID']);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}

?>