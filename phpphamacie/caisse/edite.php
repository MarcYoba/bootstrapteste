<?php
session_start();
 require_once("../connexion.php");

 global $conn;

// Récupération de l'ID
$id = $_GET['id'];
// Requête SQL pour ";
 $sql = "SELECT * FROM caisse WHERE id ='$id'";
 $result = $conn->query($sql);

if ($result->num_rows > 0 ) {
    $row = $result->fetch_assoc();
    // // Encode Une variable JavaScript
    $tableaujson = json_encode($row);
    header("Location:caisse.php?tableau=$tableaujson");
} else {
    header("location :depense.php");
}
$conn->close();
?>