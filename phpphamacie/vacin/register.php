<?php
session_start();
require_once("../connexion.php");


function creerAnimale($Name, $age, $nomclient, $Type, $premiervacin,$secondvacin,$typevaccin,$montant,$montantpayer,$Reste,$lieux) {
    global $conn;

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO animale (nomSujet, age, typesujet, idclient, datevacin, daterappel, dateenregistrement,typeVacin,montant,netpayer,restemontant,iduser,lieux) VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $date = date("y/m/d");
    $stmt->bind_param('sdsdssssdddds', $Name, $age,$Type,$nomclient,$premiervacin,$secondvacin, $date,$typevaccin,$montant,$montantpayer,$Reste,$_SESSION["id"],$lieux);

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
    $typevaccin = $_POST["typevaccin"];
    $montant = $_POST["montant"];
    $montantpayer = $_POST["montantpayer"];
    $Reste = $_POST["Reste"];
    $lieux = $_POST["lieu"];
    // Vérifier si tous les champs sont remplis
    if (!empty($Name) || !empty($age) || !empty($nomclient) || !empty($Type) || !empty($premiervacin) || !empty($secondvacin)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            

            
                // Créer le compte utilisateur
                creerAnimale($Name, $age, $nomclient, $Type, $premiervacin,$secondvacin,$typevaccin,$montant,$montantpayer,$Reste,$lieux);
                header("Location:liste.php");
                exit(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}else if (isset($_POST['modifier'])) {

    $Name = $_POST['Name'];
    $age = $_POST['age'];
    $nomclient = $_POST['idclient'];
    $Type = $_POST['Type'];
    $premiervacin = $_POST['premiervacin'];
    $secondvacin = $_POST['secondvacin'];
    $typevaccin = $_POST["typevaccin"];
    $montant = $_POST["montant"];
    $montantpayer = $_POST["montantpayer"];
    $Reste = $_POST["Reste"];
    $id = $_POST["id"];
    $lieux = $_POST["lieu"];
    // Vérifier si tous les champs sont remplis
    if (!empty($Name) || !empty($age) || !empty($nomclient) || !empty($Type) || !empty($premiervacin) || !empty($secondvacin)) {
        $iduser = $_SESSION["id"];
        $sql = "UPDATE animale SET nomSujet='$Name',age='$age',typesujet='$Type',idclient='$nomclient', datevacin='$premiervacin', daterappel='$secondvacin',typeVacin='$typevaccin',montant='$montant',netpayer='$montantpayer',restemontant='$Reste',iduser='$iduser',lieux='$lieux' WHERE id ='$id'";
        $result = $conn->query($sql);
        if ($result === true) {
            header("Location:liste.php");
            exit();
        } else {
            header("Location:liste.php");
            exit();
        }    
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>