<html>
<head>
    <title></title>
    <meta charset="utf8">

    <link rel="stylesheet" href="ui/view/css/bootstrap.min.css">
    <link rel="stylesheet" href="ui/view/css/index.php.css">
</head>
<body>
    <?php include("ui/view/navbar.php");?>
</body>
</html>

<?php
include("library.php");
//$setup = new Setup();
//$setup->createTable();

session_start();

$account = new Account();
$account->register("kek23", "marcuserenfucktard");
$account->login("kek23", "marcuserenfucktard");
?>


