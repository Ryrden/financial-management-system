<?php
abstract class Connection
{
    public static $conn;

    public static function getConnection() {
        if (self::$conn == null) {
            $dbname = $_ENV["DATABASE_NAME"];
            $dbuser = $_ENV["DATABASE_USER"];
            $dbpass = $_ENV["DATABASE_PASSWORD"];
            $dbhost = $_ENV["DATABASE_HOST"];
            self::$conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$conn;
        }
        return self::$conn;
    }
}