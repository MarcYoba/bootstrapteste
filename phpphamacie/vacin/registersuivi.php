<?php
require_once("../connexion.php");


function suivianimale($Name, $datetraite, $nomclient, $Observation, $Conduite,$Montant) {
    global $conn;

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO suivianimale (nom, idclient, jour, observation, conduit, montant, datejour) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $date = date("y/m/d");
    $stmt->bind_param('sdsssds', $Name, $nomclient,$datetraite,$Observation,$Conduite,$Montant, $date);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
    $conn->close();
}

// Formulaire d'enregistrement produit
if (isset($_POST['submit'])) {

    $Name = $_POST['Name'];
    $nomclient = $_POST['idclient'];
    $datetraite = $_POST['datetraite'];
    $Observation = $_POST['Observation'];
    $Conduite = $_POST['Conduite'];
    $Montant = $_POST['Montant'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($Name) || !empty($datetraite) || !empty($nomclient) || !empty($Observation) || !empty($Conduite) || !empty($Montant)) {
                // Créer le compte utilisateur
                suivianimale($Name, $datetraite, $nomclient, $Observation, $Conduite,$Montant);
                header("Location:listesuivi.php");
                exit();
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>