<?php
 require_once("../connexion.php");

 global $conn;

// Récupération de l'ID
$id = $_GET['id'];

// Requête SQL pour récupérer les informations de l'image
$sql = "SELECT * FROM imageprospection WHERE id = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imagePath = $row['image'];
    // Supprimer l'image du répertoire si elle existe
    if (!empty($imagePath) && file_exists($imagePath)) {
        unlink($imagePath);
    }
    
    $sql = "DELETE  FROM imageprospection WHERE id = $id";
    if($conn->query($sql) === TRUE){
        header("Location:image.php");
    }
} else {
    echo "Image non trouvée";
    header("Location:image.php");
}
$conn->close();
?>