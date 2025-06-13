<?php

// Connexion à la base de données
session_start();
require_once("../connexion.php");

// Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function  creerprospection($nom, $localisation, $telephone, $speculation, $nbsujet, $souche, $ravitaillement, $commentaire, $dateprospection, $longitude, $latitude)
 {
    global $conn;
    $date = date("y/m/d");
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO prospection  (nom, telephone , localisation , speculation, nbsujet, souche, ravitaillement, commentaire, dateprospection, longitude, latitude) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param('sssssssssss', $nom , $telephone , $localisation , $speculation , $nbsujet , $souche , $ravitaillement , $commentaire , $dateprospection , $longitude , $latitude);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
}

// Formulaire d'inscription
if (isset($_POST['submit'])) {

    $nom = $_POST['propect'];
    $telephone = $_POST['telephone'];
    $localisation = $_POST['localisation'];
    $speculation = $_POST['speculation'];
    $nbsujet = $_POST['nbsujet'];
    $souche = $_POST['souche'];
    $ravitaillement = $_POST['ravitaillement'];
    $commentaire = $_POST['commentaire'];
    $dateprospection = $_POST['dateprospection'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];

    // Vérifier si tous les champs sont remplis
    if (!empty($nom) || !empty($localisation) || !empty($commentaire) || !empty($localisation)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            
                // Créer le compte utilisateur
                creerprospection($nom, $localisation, $telephone, $speculation, $nbsujet, $souche, $ravitaillement, $commentaire, $dateprospection, $longitude, $latitude);
                header("Location:liste.php");
                exit();
    }else {
        //header("Location:liste.php");
        exit();
    }
}else if (isset($_POST['edite'])) {
    $id = $_POST['reference'];
    $nom = $_POST['propect'];
    $telephone = $_POST['telephone'];
    $localisation = $_POST['localisation'];
    $speculation = $_POST['speculation'];
    $nbsujet = $_POST['nbsujet'];
    $souche = $_POST['souche'];
    $ravitaillement = $_POST['ravitaillement'];
    $commentaire = $_POST['commentaire'];
    $dateprospection = $_POST['dateprospection'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];

    $sql = "UPDATE prospection SET nom = ?, telephone = ?, localisation = ?, speculation = ?, nbsujet = ?, souche = ?, ravitaillement = ?, commentaire = ?, dateprospection = ?, longitude = ?, latitude = ? WHERE id = ?";
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param('ssssssssssss', $nom, $telephone, $localisation, $speculation, $nbsujet, $souche, $ravitaillement, $commentaire, $dateprospection, $longitude, $latitude, $id);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
    header("Location: liste.php");
}else {
    // Rediriger vers la page de liste si le formulaire n'est pas soumis
    header("Location: liste.php");
    exit();
}

?>

