<?php

// Define database connection parameters
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "stockabgroup";

// Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Echec de connoixin";
}
?>