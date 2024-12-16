<?php

//Define database connection parameters
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "stockabgroup";

// $dbHost = "sql211.infinityfree.com";
// $dbUsername = "if0_37894408";
// $dbPassword = "3xZx7ZMieH";
// $dbName = "if0_37894408_stockabgroup";
//Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Echec de connoixin";
}
?>