<?php

//Define database connection parameters
$dbHost = "127.0.0.1";
$dbUsername = "u238144589_abgroup022";
$dbPassword = "Abgroup022";
$dbName = "u238144589_abcompta_v0";

//Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Echec de connoixin";
}
?>
