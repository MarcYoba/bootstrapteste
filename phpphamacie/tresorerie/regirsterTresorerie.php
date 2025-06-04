<?php

// Connexion à la base de données
session_start();
require_once("bdmutilple/connexion.php");

function creerValeurActif($Libelle, $groupe, $Montant,$mois,$ordre,$date) {
    global $conn;

    $sql = "INSERT INTO  tresorerie (besoin, mois, anne, numOrdre, datecreat,montant,iduser,groupe) VALUES (?, ?, ?, ?, ?,?,?,?)";

    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $timestamp = strtotime($date);
    $annee = date('Y', $timestamp);
    $stmt->bind_param('sssdsdds', $Libelle ,$mois,$annee ,$ordre,$date, $Montant,$_SESSION['id'], $groupe);


    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    $stmt->close();
}

    $Libelle = $_POST['besoin'];
    $groupe = $_POST['groupe'];
    $Montant = $_POST['Montant'];
    $mois = $_POST["mois"];
    $ordre = $_POST["ordre"];
    $date = $_POST["date"];


// Formulaire d'inscription
if (isset($_POST['enregistrement'])) {

    
    // Vérifier si tous les champs sont remplis
    if (!empty($Libelle) || !empty($groupe) || !empty($date)) {
                // Créer le compte utilisateur
                creerValeurActif($Libelle, $groupe, $Montant,$mois,$ordre,$date);
                header("Location:listeTresorerie.php");
                exit();

            $stmt->close(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

if (isset($_POST['modifier'])) {
    
    // Vérifier si tous les champs sont remplis
    if (!empty($Libelle) || !empty($groupe) || !empty($brut)) {
        $timestamp = strtotime($date);
        $annee = date('Y', $timestamp);
                // Créer le compte utilisateur
                $iduser = $_SESSION['id'];
            $sql = "UPDATE  tresorerie SET besoin='$Libelle', mois='$mois', anne='$annee', numOrdre='$ordre', datecreat='$date',montant='$Montant',iduser='$iduser',groupe='$groupe' WHERE id='$id'";
            $result = $conn->query($sql);

            if ($result === true) {
                // echo "dodifier";
                header("Location:listeTresorerie.php"); 
            } else {
                # code...
            }
            
                      
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>

