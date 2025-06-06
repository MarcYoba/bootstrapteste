<?php

//Define database connection parameters
$dbHost = "127.0.0.1";
$dbUsername = "u238144589_abgroup022";
$dbPassword = "Abgroup022";
$dbName = "u238144589_abcompta_v0";

// $dbHost = "sql304.infinityfree.com";
// $dbUsername = "if0_37303745";
// $dbPassword = "csumj8haa7jBT";
// $dbName = "if0_37303745_stockabgroup";
//Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Echec de connoixin";
}
?>
