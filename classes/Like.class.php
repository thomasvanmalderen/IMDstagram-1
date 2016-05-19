<?php

    // IMDSTAGRAM CODE: LIKE CLASS
    //######################################################

    class Like {

        private $m_iLikerId;
        private $m_iLikedPostId;

        // SETTER FUNCTION
        public function __set($p_sProperty, $p_vValue) {

            switch ($p_sProperty) {
                case "LikerId":
                    $this->m_iLikerId = $p_vValue;
                    break;

                case "LikedPostId":
                    $this->m_iLikedPostId = $p_vValue;
                    break;
            }
        }

        // GETTER FUNCTION
        public function __get($p_sProperty) {

            switch ($p_sProperty) {
                case "LikerID":
                    return $this->m_iLikerId;
                    break;

                case "LikedPostId":
                    return $this->m_iLikedPostId;
                    break;
            }
        }

        // CHECK IF CURRENT USER LIKED INDICATED POST
        public function didLike( $thispost ) {

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Likes WHERE likerId = :idLiker AND postLikedId = :idPostLiked");
            $statement->bindValue(":idLiker", $_SESSION['u_id']);
            $statement->bindValue(":idPostLiked", $thispost);
            $statement->execute();

            // IF USER LIKED POST
            if( $statement->rowCount() > 0) {
                $followresult = $statement->fetchAll();
                return true;

            } else {
                // DID NOT LIKE POST
            }
        }

        // GET AMOUNT OF LIKES ON INDICATED POST
        public function getLikes( $likedpost ){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Likes WHERE postLikedId = $likedpost");
            $statement->execute();

            return $statement->rowCount();

        }

        // LIKE INDICATED POST
        public function doLike( $thispost ){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("INSERT into Likes (likerId, postLikedId) VALUES (:idLiker, :idPostLiked)");
            $statement->bindValue(":idLiker", $_SESSION['u_id']);
            $statement->bindValue(":idPostLiked", $thispost);
            $statement->execute();

        }

        // UNLIKE INDICATED POST
        public function doUnlike( $thispost ){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("DELETE FROM Likes WHERE likerId = :idLiker AND postLikedId = :idPostLiked");
            $statement->bindValue(":idLiker", $_SESSION['u_id']);
            $statement->bindValue(":idPostLiked", $thispost);
            $statement->execute();
        }


    
    }
?>