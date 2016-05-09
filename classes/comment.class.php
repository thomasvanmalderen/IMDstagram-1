<?php


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


        public function SaveComment()

        {
            $PDO = Db::getInstance();
            $statement = $PDO->prepare("INSERT into COMMENTS (comment, idPost,idUser,posttime) VALUES (:comment, :idPost, :idUser, :posttime)");
            $statement->bindValue(":comment", $this->m_sComment);
            $statement->bindValue(":idPost", $this->m_iPostID);
            $statement->bindValue(":idUser", $_SESSION['u_id']);
            $statement->bindValue(":posttime", date("Y-m-d H:i:sa"));
            $statement->execute();
        }

       public function GetComments( )
        {
            $PDO = Db::getInstance();
            //$p_post = $_POST['postid'];
            $statement = $PDO->prepare("SELECT * FROM COMMENTS LEFT OUTER JOIN Posts ON comments.idPost=posts.p_id LEFT OUTER JOIN Users ON comments.idUser=users.u_id WHERE posts.p_id = :p_id ");
            $statement->bindValue(":p_id",  $_GET['post']);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }

        public function GetCommentsOnIndex( $thispost )
        {
            $PDO = Db::getInstance();
            //$p_post = $_POST['postid'];
            $statement = $PDO->prepare("SELECT * FROM COMMENTS LEFT OUTER JOIN Posts ON comments.idPost=posts.p_id LEFT OUTER JOIN Users ON comments.idUser=users.u_id WHERE posts.p_id = :p_id ");
            $statement->bindValue(":p_id",  $thispost);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }


}

?>