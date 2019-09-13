<?php

namespace utility;


use PDO;
use PDOException;


class DataBase
{
    private static $servername = "websteel.mysql.tools";
    private static $username = "websteel_books";
    private static $dbName = "websteel_books";
    private static $password = "4&S0klVu5(";

    public static function query($qry){
        // Create connection
        //connect
        try {
            $conn = new PDO('mysql:host=' . self::$servername . ';dbname=' . self::$dbName, self::$username, self::$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare($qry);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        return $stmt;
    }
}