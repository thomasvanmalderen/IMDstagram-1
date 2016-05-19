<?php

    // IMDSTAGRAM CODE: FOLLOW CLASS
    //######################################################

    class Follow {

        private $m_iFollowingId;
        private $m_iFollowedId;

        // SETTER FUNCTION
        public function __set( $p_sProperty, $p_vValue ) {

            switch ($p_sProperty) {
                case "Following":
                    $this->m_iFollowingId = $p_vValue;
                    break;

                case "Followed":
                    $this->m_iFollowedId = $p_vValue;
                    break;
            }
        }

        // GETTER FUNCTION
        public function __get( $p_sProperty ) {

            switch ($p_sProperty) {
                case "Following":
                    return $this->m_iFollowingId;
                    break;

                case "Followed":
                    return $this->m_iFollowedId;
                    break;
            }
        }

        // CHECK IF CURRENT USER IS FOLLOWING INDICATED USER
        public function isFollowing() {

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM FOLLOWS WHERE idFollowing = :idFollowing AND idFollowed = :idFollowed");
            $statement->bindValue(":idFollowing", $this->m_iFollowingId);
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
            $statement->execute();

            // IF ARE FOLLOWING
            if( $statement->rowCount() > 0) {
                $followresult = $statement->fetchAll();
                return true;

            } else {
                // NOT FOLLOWING
            }
        }

        // SEND FOLLOW REQUEST (INSERT INTO FOLLOWREQUEST TABLE)
        public function requestFollow() {

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("INSERT into Followrequests (FollowingId, FollowedId) VALUES (:idFollowing, :idFollowed)");
            $statement->bindValue(":idFollowing", $this->m_iFollowingId);
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
            $statement->execute();

        }

        // FETCH ALL FOLLOW REQUESTS SENT TO CURRENT USER
        public function getFollowRequests() {

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Followrequests LEFT JOIN Users ON Users.u_id = Followrequests.FollowingId WHERE FollowedId = :idFollowed AND accepted = 'no'");
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
            $statement->execute();

            $result = $statement->fetchAll();
            return $result;

        }

        // ACCEPT INDICATED FOLLOW REQUEST
        public function acceptFollowRequest() {

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("UPDATE Followrequests SET accepted = 'yes' WHERE FollowedId = :idFollowed AND FollowingId = :idFollowing");
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
            $statement->bindValue(":idFollowing", $this->m_iFollowingId);
            $statement->execute();

            $result = $statement->fetchAll();
            return $result;

        }

        // FOLLOW INDICATED USER
        public function doFollow() {

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("INSERT into Follows (idFollowing, idFollowed) VALUES (:idFollowing, :idFollowed)");
            $statement->bindValue(":idFollowing", $this->m_iFollowingId);
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
            $statement->execute();

        }

        // UNFOLLOW INDICATED USER
        public function doUnfollow() {

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("DELETE FROM Follows WHERE idFollowing = :idFollowing AND idFollowed = :idFollowed");
            $statement->bindValue(":idFollowing", $this->m_iFollowingId);
            $statement->bindValue(":idFollowed", $this->m_iFollowedId);
            $statement->execute();
        }
    }

?>