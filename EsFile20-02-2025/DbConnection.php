<?php
    class DbConnection {
        private static string $host;
        private static string $username;
        private static string $password;
        private static string $database;

        private function __construct() {}

        public static function setConfiguration($host, $username, $password, $database) {
            self::$host = $host;
            self::$username = $username;
            self::$password = $password;
            self::$database = $database;
        }


        public static function getConnection() {
            $dbConnection = new mysqli(self::$host, self::$username, self::$password);
            $dbConnection->select_db(self::$database);
            return $dbConnection;
        }

    }
?>