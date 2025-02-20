<?php

// Connexion à la base de données
session_start();
require_once("../connexion.php");

function creerValeurPassif($Libelle, $groupe, $Montant,$date) {
    global $conn;

    $sql = "INSERT INTO passif (libelle, montant, datepassif, iduser,cathegorie ) VALUES (?, ?, ?, ?,?)";

    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $stmt->bind_param('sdsds', $Libelle ,$Montant, $date,$_SESSION['id'], $groupe);
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }
    $stmt->close();
}

// Formulaire d'inscription
if (isset($_POST['enregistrement'])) {

    $Libelle = $_POST['Libelle'];
    $groupe = $_POST['groupe'];
    $Montant = $_POST['Montant'];
    $date = $_POST["date"];
    // Vérifier si tous les champs sont remplis
    if (!empty($Libelle) || !empty($groupe) || !empty($Montant)) {
                // Créer le compte utilisateur
                creerValeurPassif($Libelle, $groupe, $Montant,$date);
                header("Location:listepasif.php");
                exit();

            $stmt->close(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

if (isset($_POST['modifier'])) {

    $Libelle = $_POST['Libelle'];
    $groupe = $_POST['groupe'];
    $Montant = $_POST['Montant'];
    $date = $_POST["date"];
    $id = $_POST["id"];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($Libelle) || !empty($groupe) || !empty($Montant)) {
        
                // Créer le compte utilisateur
            $sql = "UPDATE passif SET libelle='$Libelle',montant ='$Montant',datepassif='$date',cathegorie='$groupe' WHERE id='$id'";
            $result = $conn->query($sql);

            if ($result === true) {
                // echo "dodifier";
                header("Location:listepasif.php"); 
            } else {
                # code...
            }
            
                      
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>

