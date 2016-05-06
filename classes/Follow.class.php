<?php

    class Follow {

        private $m_iFollowingId;
        private $m_iFollowedId;

        public function __set($p_sProperty, $p_vValue)
        {
            switch ($p_sProperty) {
                case "Following":
                    $this->m_iFollowingId = $p_vValue;
                    break;
                case "Followed":
                    $this->m_iFollowedId = $p_vValue;
                    break;
            }
        }
        public function __get($p_sProperty)
        {
            switch ($p_sProperty) {
                case "Following":
                    return $this->m_iFollowingId;
                    break;
                case "Followed":
                    return $this->m_iFollowedId;
                    break;
            }
        }

        public function isFollowing(){
            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM FOLLOWS WHERE idFollowing = :idFollowing AND idFollowed = :idFollowed");
            $statement->bindValue(":idFollowing", $this->m_iFollowingId);
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
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

        public function requestFollow(){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("INSERT into Followrequests (FollowingId, FollowedId) VALUES (:idFollowing, :idFollowed)");
            $statement->bindValue(":idFollowing", $this->m_iFollowingId);
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
            $statement->execute();

        }

        public function getFollowRequests(){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Followrequests LEFT JOIN Users ON Users.u_id = Followrequests.FollowingId WHERE FollowedId = :idFollowed AND accepted = 'no'");
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
            $statement->execute();

            $result = $statement->fetchAll();
            return $result;

        }

        public function acceptFollowRequest(){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("UPDATE Followrequests WHERE FollowedId = :idFollowed AND FollowingId = :idFollowing");
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
            $statement->bindValue(":idFollowing", $this->m_iFollowingId);
            $statement->execute();

            $result = $statement->fetchAll();
            return $result;

        }

        public function doFollow(){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("INSERT into Follows (idFollowing, idFollowed) VALUES (:idFollowing, :idFollowed)");
            $statement->bindValue(":idFollowing", $this->m_iFollowingId);
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
            $statement->execute();

        }

        public function doUnfollow(){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("DELETE FROM Follows WHERE idFollowing = :idFollowing AND idFollowed = :idFollowed");
            $statement->bindValue(":idFollowing", $this->m_iFollowingId);
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
            $statement->execute();
        }
    }

?>