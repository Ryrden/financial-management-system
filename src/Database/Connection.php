<?php
abstract class Connection
{
    public static $conn;

    public static function getConnection() {
        if (self::$conn == null) {
            self::$conn = new PDO("mysql: host=localhost; dbname=sistema_financeiro_tcc;", "root", "root");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$conn;
        }
        return self::$conn;
    }
}