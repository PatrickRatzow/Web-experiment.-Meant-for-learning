<html>
<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="ui/view/css/bootstrap.min.css">
</head>
</html>
<?php
if (!isset($_POST["username"]) && !isset($_POST["password"])) {
    include("ui/view/body.php");
    include("ui/view/login.php");
} else {
    include("library.php");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $account = new Account();
    $account->login($username, $password);
}
?>