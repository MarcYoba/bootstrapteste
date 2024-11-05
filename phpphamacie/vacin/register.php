<?php
require_once("../connexion.php");


function creerClient($Name, $age, $nomclient, $Type, $premiervacin,$secondvacin) {
    global $conn;

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO animale (nomSujet, age, typesujet, idclient, datevacin, daterappel, dateenregistrement) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $date = date("y/m/d");
    $stmt->bind_param('sdsdsss', $Name, $age,$Type,$nomclient,$premiervacin,$secondvacin, $date);

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
    $age = $_POST['age'];
    $nomclient = $_POST['idclient'];
    $Type = $_POST['Type'];
    $premiervacin = $_POST['premiervacin'];
    $secondvacin = $_POST['secondvacin'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($Name) || !empty($age) || !empty($nomclient) || !empty($Type) || !empty($premiervacin) || !empty($secondvacin)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            $sql = "SELECT * FROM animale WHERE nomSujet = ?";

            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            
            $stmt->bind_param('s', $Name);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo 'Cette animale est déjà utilisée.';
                //exit();
            } else {
                // Créer le compte utilisateur
                creerClient($Name, $age, $nomclient, $Type, $premiervacin,$secondvacin);
                header("Location:liste.php");
                exit();
            }

            $stmt->close(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>