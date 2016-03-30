<?php

    // IMDSTAGRAM CODE: DATABASE CLASS - Last edited: 24/03/2016
    //######################################################

    class Db {
        
        private static $conn;
        
        public static function getInstance() {
            if( is_null(self::$conn)) {
                self::$conn = new PDO("mysql:host=localhost;dbname=db_imdstagram", "root", "root");
            }
            
        return self::$conn;
    }
}