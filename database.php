<?php
class Database {
    private static $db;
    function __construct() {
        $config = include("config.php");
        try {
            self::$db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['ip'], $config["username"], $config["password"]);
        } catch (PDOExpection $e) {
            echo "Connection error: " . $e->getMessage();
        }
        echo "database constructed<br>";
    }

    function __destruct() {
        self::$db = null;
    }

    public function login($username, $password) {
        $passwordHashed = hash("sha256", $password);
        $query = self::$db->prepare("SELECT * FROM users WHERE username = '$username' AND password = '$passwordHashed'");
        if (!$query->execute()) {
            print_r($query->errorInfo());
            echo("<br>Failed database query at [class]Database->[public function]login<br>");
            return;
        }
        if ($query->rowCount() == 0) {
            return "failure";
        } else {
            return "success";
        }
    }

    public function register($username, $password) {
        $strlenUsername = mb_strlen($username, "utf8");
        if ($strlenUsername <= 3) {
            return "failure_shortname";
        } elseif ($strlenUsername >= 17) {
            return "failure_longname";
        }

        $strlenPassword = mb_strlen($password, "utf8");
        if ($strlenPassword <= 3) {
            return "failure_shortpass";
        } elseif ($strlenPassword >= 17) {
            return "failure_longpass";
        }

        $query = self::$db->prepare("SELECT * FROM users WHERE username = '$username'");
        $query->execute();
        if ($query->rowCount() > 0) {
            return "failure";
        }
        $passwordHashed = hash("sha256", $password);
        $query = self::$db->prepare("INSERT INTO users (username, password) VALUES('$username', '$passwordHashed')");
        if (!$query->execute()) {
            print_r($query->errorInfo());
            return "failure";
        }
        return "success";
    }

    public function tableExists($table) {
        $query = self::$db->prepare("SELECT 1 FROM $table LIMIT 1");
        if (!$query->execute()) {
            // Table exists
            return true;
        } else {
            // Table doesn't exist;
            return false;
        }
    }
}
?>
