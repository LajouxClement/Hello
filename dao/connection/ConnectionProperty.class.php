<?php
/**
 * Description of ee
 *
 * @author Ludo
 */


class ConnectionProperty {

    private static $host = HOST;
    private static $user = USER;
    private static $password = PASS;
    private static $database = DBNAME;
    private static $port = PORT;

    public static function getHost() {
        return self::$host;
    }

    public static function getUser() {
        return self::$user;
    }

    public static function getPassword() {
        return self::$password;
    }

    public static function getDatabase() {
        return self::$database;
    }

    public static function getPort() {
        return self::$port;
    }

}