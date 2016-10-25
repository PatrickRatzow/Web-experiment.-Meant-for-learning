<?php
class Setup {
    private static $db;

    function __construct() {
        $config = include("config.php");
        self::$databaseClass = new Database();
        echo("setup constructed<br>");
    }
    
    function __destruct() {
        self::$databaseClass = null;
    }

    public function createTable() {
        $query = self::$databaseClass->prepare("
        CREATE TABLE IF NOT EXISTS users 
        (
            id int(11) NOT NULL AUTO_INCREMENT,
            username varchar(255) NOT NULL,
            password varchar(255) NOT NULL,
            upload int(32) NOT NULL,
            PRIMARY KEY(id)
        )");
        $query->execute();
    }
}
?>