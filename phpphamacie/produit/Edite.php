<?php
 require_once("../connexion.php");

 global $conn;

// Récupération de l'ID
$id = $_GET['id'];

// Requête SQL pour récupérer les informations de la vente
$sql = "SELECT * FROM produit WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Vérification si la vente existe
    $row = $result->fetch_assoc();
    // Encode Une variable JavaScript
    $tableaujson = json_encode($row);
    header("Location:produit.php?tableau=$tableaujson");
} else {
    echo "Vente non trouvée";
}
$conn->close();
?>