<?php

// Connexion à la base de données
session_start();
require_once("../connexion.php");

// Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function creerClient($nom, $adress, $email, $telephone,$numerofacture,$datefacture) {
    global $conn;
    $date = date("y/m/d");
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO fournisseur (nom, adresse, telephone, email,datecreation,numerofacature,dateachat) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param('ssdssds', $nom , $adress ,$telephone, $email, $date,$numerofacture,$datefacture);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
}

// Formulaire d'inscription
if (isset($_POST['submit'])) {

    $nom = $_POST['FirstName'];
    $adress = $_POST['adressfournisseur'];
    $email = $_POST['InputEmail'];
    $telephone = $_POST['Inputphone'];
    $datefacture = $_POST['datefacture'];
    $numerofacture = $_POST['numerofacture'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($nom) || !empty($adress) || !empty($email) || !empty($telephone)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            $sql = "SELECT * FROM fournisseur WHERE email = ?";

            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo 'Ce fourniseur est déjà utilisée.';
            } else {
                // Créer le compte utilisateur
                creerClient($nom, $adress, $email, $telephone,$numerofacture , $datefacture);
                header("Location:liste.php");
                exit();
            }

            $stmt->close(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}else{
    echo 'non';
}

?>

