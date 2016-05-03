<?php
include_once("Db.class.php");

    class Comment
    {
        private $m_sComment;
        private $m_iPostID;
        private $m_iUserID;

        public function __set($p_sProperty, $p_vValue)
        {
            switch ($p_sProperty) {
                case "Comment":
                    $this->m_sComment = $p_vValue;
                    break;
                case "PostID":
                    $this->m_iPostID = $p_vValue;
                    break;
                case "UserID":
                    $this->m_iUserID = $p_vValue;
                    break;
            }
        }
        public function __get($p_sProperty)
        {
            switch ($p_sProperty) {
                case "Comment":
                    return $this->m_sComment;
                    break;
                case "PostID":
                    return $this->m_iPostID;
                    break;
                case "UserID":
                    return $this->m_iUserID;
                    break;
            }
        }

        public function getPostInfo() {

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Posts WHERE idUser = '" . $_SESSION['u_id'] . "'");
            $statement->execute();
            $result = $statement->fetch();
            //return $result;

            $_SESSION['p_id'] = $result[0];
        }


        public function SaveComment()

        {
            $PDO = Db::getInstance();
            $statement = $PDO->prepare("INSERT into COMMENTS (comment, idPost,idUser) VALUES (:comment, :idPost, :idUser)");
            $statement->bindValue(":comment", $this->m_sComment);
            $statement->bindValue(":idPost", $_SESSION['p_id']);
            $statement->bindValue(":idUser", $_SESSION['u_id']);
            $statement->execute();
            $_SESSION['comment'] = $this->m_sComment;
        }

       public function GetComments( )
        {
            $PDO = Db::getInstance();
            //$p_post = $_GET['post'];
            $statement = $PDO->prepare("SELECT * FROM COMMENTS LEFT OUTER JOIN Posts ON comments.idPost=posts.p_id WHERE comments.c_id = :comment");
            $statement->bindValue(":comment",  $this->m_sComment);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }



}

?>