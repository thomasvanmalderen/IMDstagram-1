<?php

    // IMDSTAGRAM CODE: REPORT CLASS
    //######################################################

    class Report{

        private $m_sReporter;
        private $m_sReportedPost;

        // SETTER FUNCTION
        public function __set( $p_sProperty, $p_vValue ){

            switch ( $p_sProperty) {
                case "Reporter":
                    $this->m_sReporter = $p_vValue;
                    break;

                case "ReportedPost":
                    $this->m_sReportedPost = $p_vValue;
                    break;
            }
        }

        // GETTER FUNCTION
        public function __get ( $p_sProperty ) {

            switch ( $p_sProperty ) {
                case "Reporter":
                    return $this->m_sReporter;
                    break;
                case "ReportedPost":
                    return $this->m_sReportedPost;
                    break;
            }
        }

        // CHECK IF CURRENT USER REPORTED CURRENT POSTS
        public function didReport( $thispost ) {

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Reports WHERE reporter = :reporter AND reportedPost = :reportedPost");
            $statement->bindValue(":reporter", $_SESSION['u_id']);
            $statement->bindValue(":reportedPost", $thispost);
            $statement->execute();

            if( $statement->rowCount() > 0) {
                $followresult = $statement->fetchAll();
                return true;

            } else {
                // DID NOT REPORT
            }
        }

        // GET THE AMOUNT OF REPORTS ON CURRENT POST
        public function getReports( $reportedPost ) {

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Reports WHERE reportedPost = $reportedPost");
            $statement->execute();

            return $statement->rowCount();

        }

        // REPORT CURRENT POST
        public function doReport( $thispost ){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("INSERT into Reports (reporter, reportedPost) VALUES (:reporter, :reportedPost)");
            $statement->bindValue(":reporter", $_SESSION['u_id']);
            $statement->bindValue(":reportedPost", $thispost);
            $statement->execute();

        }

        // UN-REPORT THIS POST
        public function doUnReport( $thispost ){

            $PDO = Db::getInstance();
            $statement = $PDO->prepare("DELETE FROM Reports WHERE reporter = :reporter AND reportedPost = :reportedPost");
            $statement->bindValue(":reporter", $_SESSION['u_id']);
            $statement->bindValue(":reportedPost", $thispost);
            $statement->execute();
        }

        /*public function InappropiatePost($reportedPost) {
            $PDO = Db::getInstance();
            $statement = $PDO->prepare("SELECT * FROM Reports WHERE reportedPost = $reportedPost");
            //$statement->bindValue(":idLiker", $this->m_iLikerId);
            //$statement->bindValue(":idPostLiked", $this->m_iLikedPostId);
            $statement->execute();

            if( $statement->rowCount() >= 3) {

                $followresult = $statement->fetchAll();
                //var_dump($followresult);
                echo "This should be hidden";
                //return $followresult;
                //echo "tis just";

            } else {
                //echo "tis ni just";
            }
        }*/

}
?>