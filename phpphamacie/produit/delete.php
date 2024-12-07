<?php
 require_once("../connexion.php");

 global $conn;

// Récupération de l'ID
$id = $_GET['id'];

// Requête SQL pour récupérer les informations de la produitphamacie
$sql = "SELECT * FROM produitphamacie WHERE id = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    $sql = "DELETE  FROM historiquestockphamacie WHERE idproduit = $id";
    if($conn->query($sql) === TRUE){
        $sql = "DELETE  FROM produitphamacie WHERE id = $id";
        if($conn->query($sql) === TRUE){
            
            header("Location:liste.php");
        }
    }else{
        echo"echec de suppresion";
    }
    
} else {
    echo "Produit non trouvée";
}
$conn->close();
?>