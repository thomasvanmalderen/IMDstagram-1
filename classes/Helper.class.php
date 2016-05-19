<?php

    // IMDSTAGRAM CODE: HELPER CLASS - ASSIST METHODS
    //######################################################

    class Helper{

        // CALCULATE HOW LONG AGO POST WAS UPLOADED
        public static function timeAgo($date){

            if(time("Y-m-d H:i:sa") - strtotime($date) < 60){
                echo 'Just now';
            } elseif( time("Y-m-d H:i:sa") - strtotime($date) < 3600){
                echo floor((time("Y-m-d H:i:sa") - strtotime($date))/ 60) . ' mins ago';
            } elseif( time("Y-m-d H:i:sa") - strtotime($date) < 86400){
                echo floor((time("Y-m-d H:i:sa") - strtotime($date))/ 3600) . ' hrs ago';
            } else{
                echo floor((time("Y-m-d H:i:sa") - strtotime($date))/ 86400) . ' days ago';
            }
        }

        // TIMEAGO FUNCTION FOR STATIC LOAD MORE POSTS
        public static function timeAgo2($date){
            $output = "";
            if(time("Y-m-d H:i:sa") - strtotime($date) < 60){
                $output = "Just now";
            } elseif( time("Y-m-d H:i:sa") - strtotime($date) < 3600){
                $output = floor((time("Y-m-d H:i:sa") - strtotime($date))/ 60) . ' mins ago';
            } elseif( time("Y-m-d H:i:sa") - strtotime($date) < 86400){
                $output = floor((time("Y-m-d H:i:sa") - strtotime($date))/ 3600) . ' hrs ago';
            } else{
                $output = floor((time("Y-m-d H:i:sa") - strtotime($date))/ 86400) . ' days ago';
            }

            return $output;
        }
}


?>