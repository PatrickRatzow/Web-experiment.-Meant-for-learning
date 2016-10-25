<?php
class Account {
    private $userid;
    private $username;
    private static $databaseClass;

    function __construct() {
        self::$databaseClass = new Database();
        echo("account constructed<br>");
    }

    public function login($username, $password) {
        $loginAttempt = self::$databaseClass->login($username, $password);
        if ($loginAttempt == "success") {
            echo "<br>Logging in";
            if (!isset($_SESSION["loggedin"])) {
                $_SESSION["loggedin"] = true;
            } 
        } else {
            echo "<br>Wrong username/password";
        }
    }

    public function register($username, $password) {
        $registerAttempt = self::$databaseClass->register($username, $password);
        if ($registerAttempt == "success") {
            echo "<br>Redirecting to register page";
        } elseif ($registerAttempt == "failure_shortname") {
           echo "<br>Too short name, minimum 4 characters";
        } elseif ($registerAttempt == "failure_longname") {
            echo "<br>Too long name, maximum 16 characters";
        } elseif ($registerAttempt == "failure_shortpass") {
            echo "<br>Too short password, minimum 4 characters";
        } elseif ($registerAttempt == "failure_longpass") {
            echo "<br>Too long password, maximum 16 characters";
        } else {
            echo "<br>That username is taken!";
        }
    }
}
?>