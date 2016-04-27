<?php
    
    class Helper{
        
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

}


?>