<?php
 require_once("../connexion.php");

 global $conn;

// Récupération de l'ID
$id = $_GET['id'];

// Requête SQL pour récupérer les informations de la vente
$sql = "SELECT * FROM caisse WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sql = "DELETE  FROM caisse WHERE id = $id";

    if($conn->query($sql) === TRUE){
        header("Location:liste.php");
    }else{
        echo"echec de suppresion";
    }
    
} else {
    echo "Vente non trouvée";
}
$conn->close();
?>