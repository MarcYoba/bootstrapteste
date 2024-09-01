<?php

// Connexion à la base de données
session_start();
require_once("../connexion.php");

// Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function creerCaisse($description, $motif, $montant) {
    global $conn;
    $date = date("y/m/d");
    
    if($description == "sortie en caisse"){
        $montant = "-".$montant;
    }
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO caisse (operation, montant, iduser, dateoperation, motif) VALUES (?, ?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param('sdsss', $description , $montant ,$_SESSION['id'], $date,$motif);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
}

// Formulaire d'inscription
if (isset($_POST['enregistrement'])) {

    $description = $_POST['description'];
    $motif = $_POST['motif'];
    $montant = $_POST['montant'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($description) || !empty($motif) || !empty($montant)) {
        
                // Créer le compte utilisateur
                creerCaisse($description, $motif, $montant);
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
    
    // Vérifier si tous les champs sont remplis
    if (!empty($description) || !empty($motif) || !empty($montant)) {
        
                // Créer le compte utilisateur
            $sql = "UPDATE caisse SET operation='$description', montant ='$montant', motif='$motif' WHERE id='$reference'";
            $result = $conn->query($sql);
            
                header("Location:liste.php");
            
            
            
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>

