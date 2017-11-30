<?php

session_start();

require_once("config/dbconnect.php");
require_once('classes/Class.User.php');

$user = new User($conn);

if (!$user->isLoggedIn()) 
{
    $user->redirect('index.php');
}


?>

<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <title>Welcome</title>
</head>

<body>
    <p>Hi, <?php echo $_SESSION['userName']; ?>. You have succesfully logged in!</p>
    <p><a href="logout.php?logout">Logout</a></p>
</body>
</html>