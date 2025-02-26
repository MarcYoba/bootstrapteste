<?php

// Connexion à la base de données
session_start();
require_once("../connexion.php");

    
    

// Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function creerSalaire($utilisateur, $montant,$date) {
    global $conn;
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 
    $sql = "INSERT INTO salaire  (inuser , montant,usersave,datepaiement ) VALUES (?, ?,?,?)";
    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    
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
    $date = $_POST["date"];
    // Vérifier si tous les champs sont remplis
    if (!empty($utilisateur) && !empty($montant)) {
        
                // Créer le compte utilisateur
                creerSalaire($utilisateur, $montant,$date);
                header("Location:liste.php");
                exit();

            $stmt->close(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}else if (isset($_POST['editsalaire'])) {

    $utilisateur = $_POST['utilisateur'];
    $montant = $_POST['montant'];
    $date = $_POST['date'];
    $id = $_POST['iduser'];
    
    
    // Vérifier si tous les champs sont remplis
    if (!empty($utilisateur) && !empty($montant) && !empty($date)) {
            $iduser = $_SESSION['id'];
                // Créer le compte utilisateur
            $sql = "UPDATE salaire SET inuser='$utilisateur', montant ='$montant', usersave='$iduser',datepaiement='$date' WHERE id='$id'";
            $result = $conn->query($sql);
            
                header("Location:liste.php");     
    }else {
        header("Location: ../../404.html");
        exit();
    }
}else if (isset($_POST['personnel'])) {
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $banque = $_POST['banque'];
    $date = $_POST["date"];

    global $conn;
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 
    $sql = "INSERT INTO personnel   (nom  , telephone ,compteBanque ,datecreation  ) VALUES (?, ?,?,?)";
    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    
    $stmt->bind_param('sdss', $nom , $telephone ,$banque, $date);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
    header("Location:personnel.php");

}else if (isset($_POST['editpersonnel'])) {

    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $banque = $_POST['banque'];
    $date = $_POST["date"];
    $id = $_POST['iduser'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($nom) && !empty($id) && !empty($telephone)) {
            $iduser = $_SESSION['id'];
                // Créer le compte utilisateur
            $sql = "UPDATE personnel SET nom='$nom', telephone ='$telephone', compteBanque='$banque',datecreation='$date' WHERE id='$id'";
            $result = $conn->query($sql);
            
                header("Location:personnel.php");     
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>

