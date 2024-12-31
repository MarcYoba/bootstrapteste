<?php

// Connexion à la base de données
session_start();
require_once("../connexion.php");

// Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function creerSalaire($utilisateur, $montant) {
    global $conn;
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 
    $sql = "INSERT INTO salaire  (inuser , montant,usersave,datepaiement ) VALUES (?, ?,?,?)";
    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $date = date("y/m/d");
    $stmt->bind_param('ddds', $utilisateur , $montant ,$_SESSION['id'], $date);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
}

// Formulaire d'inscription
if (isset($_POST['enregistrement'])) {

    $utilisateur = $_POST['utilisateur'];
    $montant = $_POST['montant'];
    // $montant = $_POST['montant'];
    // $date = $_POST["date"];
    // Vérifier si tous les champs sont remplis
    if (!empty($utilisateur) && !empty($montant)) {
        
                // Créer le compte utilisateur
                creerSalaire($utilisateur, $montant);
                header("Location:liste.php");
                exit();

            $stmt->close(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

if (isset($_POST['modifier'])) {

    $description = $_POST['description'];
    $motif = $_POST['motif'];
    $montant = $_POST['montant'];
    $reference = $_POST['reference'];
    $date = $_POST["date"];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($description) || !empty($motif) || !empty($montant)) {
        
                // Créer le compte utilisateur
            $sql = "UPDATE salaire SET operation='$description', montant ='$montant', motif='$motif',dateoperation='$date' WHERE id='$reference'";
            $result = $conn->query($sql);
            
                header("Location:liste.php");
            
            
            
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>

