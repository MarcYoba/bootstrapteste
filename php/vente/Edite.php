<?php
 require_once("../connexion.php");

 global $conn;

// Récupération de l'ID
$id = $_GET['id'];

// Requête SQL pour récupérer les informations de la vente
$sql = "SELECT * FROM vente WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Affichage des données dans un formulaire (exemple)
    while($row = $result->fetch_assoc()) {
        echo "<form>";
        echo "<label for='typevente'>Type de vente:</label>";
        echo "<input type='text' name='typevente' value='" . $row["typevente"] . "'><br>";
        // ... (autres champs)
        echo "<input type='submit' value='Modifier'>";
        echo "</form>";
    }
} else {
    echo "Vente non trouvée";
}

$conn->close();
?>