<?php

    class Like{
        private $m_iLikerId;
        private $m_iLikedPostId;

        public function __set($p_sProperty, $p_vValue)
        {
            switch ($p_sProperty) {
                case "LikerId":
                    $this->m_iLikerId = $p_vValue;
                    break;
                case "LikedPostId":
                    $this->m_iLikedPostId = $p_vValue;
                    break;
            }
        }
        public function __get($p_sProperty)
        {
            switch ($p_sProperty) {
                case "LikerID":
                    return $this->m_iLikerId;
                    break;
                case "LikedPostId":
                    return $this->m_iLikedPostId;
                    break;
            }
        }

        public function didLike($thispost){
            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Likes WHERE likerId = :idLiker AND postLikedId = :idPostLiked");
            $statement->bindValue(":idLiker", $_SESSION['u_id']);
            $statement->bindValue(":idPostLiked", $thispost);
            $statement->execute();

            if( $statement->rowCount() > 0) {

                $followresult = $statement->fetchAll();
                //var_dump($followresult);
                return true;
                //return $followresult;
                //echo "tis just";

            } else {
                //echo "tis ni just";
            }
        }

        public function getLikes($likedpost){
            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Likes WHERE postLikedId = $likedpost");
            //$statement->bindValue(":idLiker", $this->m_iLikerId);
            //$statement->bindValue(":idPostLiked", $this->m_iLikedPostId);
            $statement->execute();

            return $statement->rowCount();

        }

        public function doLike($thispost){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("INSERT into Likes (likerId, postLikedId) VALUES (:idLiker, :idPostLiked)");
            $statement->bindValue(":idLiker", $_SESSION['u_id']);
            $statement->bindValue(":idPostLiked", $thispost);
            $statement->execute();

        }

        public function doUnlike($thispost){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("DELETE FROM Likes WHERE likerId = :idLiker AND postLikedId = :idPostLiked");
            $statement->bindValue(":idLiker", $_SESSION['u_id']);
            $statement->bindValue(":idPostLiked", $thispost);
            $statement->execute();
        }


    
    }
?>