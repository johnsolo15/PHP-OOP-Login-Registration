<?php

$DBHOST = "localhost";  //your hostname
$DBUSER = "root";       //your username
$DBPASS = "";           //your password
$DBNAME = "database";   //your database name

//Create Connection
$conn = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>