<?php

// Connexion à la base de données
session_start();
require_once("bdmutilple/connexion.php");

function creerValeurActif($Libelle, $groupe, $Montant,$reference,$ordre,$date,$signe) {
    global $conn;

    $sql = "INSERT INTO  compteResultat  (reference , libelle , signe , montant , ordre ,dateexercice ,iduser ,groupe) VALUES (?, ?, ?, ?, ?,?,?,?)";

    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $timestamp = strtotime($date);
    $annee = date('Y', $timestamp);
    $stmt->bind_param('sssddsds',$reference, $Libelle ,$signe ,$Montant,$ordre, $date,$_SESSION['id'], $groupe);


    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    $stmt->close();
}

    $reference = $_POST['reference'];
    $groupe = $_POST['groupe'];
    $Montant = $_POST['Montant'];
    $libelle = $_POST["libelle"];
    $ordre = $_POST["ordre"];
    $signe = $_POST["signe"];
    $date = $_POST["date"];


// Formulaire d'inscription
if (isset($_POST['enregistrement'])) {

    
    // Vérifier si tous les champs sont remplis
    if (!empty($libelle) || !empty($groupe) || !empty($date)) {
                // Créer le compte utilisateur
                creerValeurActif($libelle, $groupe, $Montant,$reference,$ordre,$date,$signe);
                header("Location:listeCompteresultat.php");
                exit();

            $stmt->close(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

if (isset($_POST['modifier'])) {
    
    // Vérifier si tous les champs sont remplis
    if (!empty($libelle) || !empty($groupe) || !empty($brut)) {
        $id = $_POST['id'];
        // var_dump($id);
        // exit();
        $timestamp = strtotime($date);
        $annee = date('Y', $timestamp);
                // Créer le compte utilisateur
                $iduser = $_SESSION['id'];
            $sql = "UPDATE  compteResultat SET reference='$reference', libelle='$libelle', signe='$signe' , montant='$Montant' , ordre='$ordre' ,dateexercice='$date',iduser='$iduser',groupe='$groupe' WHERE id='$id'";
            $result = $conn->query($sql);
            if ($result === true) {
                // echo "dodifier";
                header("Location:listeCompteresultat.php"); 
            } else {
                # code...
            }
            
                      
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>

