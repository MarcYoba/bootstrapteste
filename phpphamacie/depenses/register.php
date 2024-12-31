<?php

// Connexion à la base de données
session_start();
require_once("../connexion.php");

// Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function creerDepense($description, $montant,$datedepense,$type) {
    global $conn;

    if (!empty($datedepense)) {
        $date = $datedepense;
    } else {
        $date = date("y/m/d");
    }
    
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO depensesphamacie  (description, montant, iduser, datedepense,cathegorie) VALUES (?, ?, ?, ?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param('sdsss', $description , $montant ,$_SESSION['id'], $date,$type);

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
    $type = $_POST['type'];
    $montant = $_POST['montant'];
    $datedepense = $_POST['datedepense'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($description) || !empty($montant)) {
        
                // Créer le compte utilisateur
                creerDepense($description, $montant,$datedepense,$type);
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
    $type = $_POST['type'];
    $montant = $_POST['montant'];
    $reference = $_POST['reference'];
    $datedepense = $_POST['datedepense'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($description) || !empty($motif) || !empty($montant)) {
        
                // Créer le compte utilisateur
            $sql = "UPDATE depensesphamacie SET description='$description', montant ='$montant',cathegorie='$type' WHERE id='$reference'";
            $result = $conn->query($sql);
            
                header("Location:liste.php");
            
            
            
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>

