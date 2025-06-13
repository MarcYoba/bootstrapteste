<?php
 require_once("../connexion.php");

 global $conn;
 $data = json_decode(file_get_contents('php://input'), true);
 // Vérification de la connexion à la base de données

// Récupération de l'ID
if (isset($data['id'])) {
    $id = $data['id'];

    $sql = "SELECT * FROM prospection WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Vérification si la vente existe
        $row = $result->fetch_assoc();
        // Encode Une variable JavaScript
        $tableaujson = json_encode($row);
        echo $tableaujson;
    } else {
        echo "Nom prospection introuvable";
    }
    $conn->close();
}
?>