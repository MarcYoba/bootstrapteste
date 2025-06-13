<?php
 require_once("../connexion.php");

 global $conn;

// Récupération de l'ID
$id = $_GET['id'];

// Requête SQL pour récupérer les informations de la vente
$sql = "SELECT * FROM prospection WHERE id = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sql = "DELETE  FROM prospection WHERE id = $id";
    if($conn->query($sql) === TRUE){
        header("Location:liste.php");
    }
} else {
    echo "Vente non trouvée";
    header("Location:liste.php");
}
$conn->close();
?>