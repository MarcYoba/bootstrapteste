<?php

// Connexion à la base de données
session_start();
require_once("../connexion.php");

function creerValeurActif($Libelle, $groupe, $brut,$amortisement,$net,$date) {
    global $conn;

    $sql = "INSERT INTO actif (libelle, brut, amortisement, net, datebilan,iduser,cathegorie) VALUES (?, ?, ?, ?, ?,?,?)";

    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param('sdddsds', $Libelle ,$brut,$amortisement,$net, $date,$_SESSION['id'], $groupe);


    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    $stmt->close();
}

// Formulaire d'inscription
if (isset($_POST['enregistrement'])) {

    $Libelle = $_POST['Libelle'];
    $groupe = $_POST['groupe'];
    $brut = $_POST['brut'];
    $amortisement = $_POST["amortisement"];
    $net = $_POST["net"];
    $date = $_POST["date"];
    // Vérifier si tous les champs sont remplis
    if (!empty($Libelle) || !empty($groupe) || !empty($brut)) {
                // Créer le compte utilisateur
                creerValeurActif($Libelle, $groupe, $brut,$amortisement,$net,$date);
                header("Location:liste.php");
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
    $brut = $_POST['brut'];
    $amortisement = $_POST["amortisement"];
    $net = $_POST["net"];
    $date = $_POST["date"];
    $id = $_POST["id"];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($Libelle) || !empty($groupe) || !empty($brut)) {
        
                // Créer le compte utilisateur
            $sql = "UPDATE actif SET libelle='$Libelle',brut ='$brut',amortisement='$amortisement',net='$net',datebilan='$date',cathegorie='$groupe' WHERE id='$id'";
            $result = $conn->query($sql);

            if ($result === true) {
                // echo "dodifier";
                header("Location:liste.php"); 
            } else {
                # code...
            }
            
                      
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>

