<?php

// Connexion à la base de données
session_start();
require_once("../connexion.php");

function creerCaisse($montant) {
    global $conn;
    $date = date("y/m/d");
    $sql = "SELECT id FROM versement ORDER BY id DESC";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            $idversement = $row["id"];
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO caisse (operation, montant,idversement, iduser, dateoperation, motif) VALUES (?, ?, ?, ?, ?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $description ="versement";
    
    $stmt->bind_param('sddsss', $description , $montant,$idversement ,$_SESSION['id'], $date,$description);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
}

// Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function creerVersement($iddette, $client, $montant, $montantdette,$dateversement,$om,$matif ) {
    global $conn;

    if (!empty($dateversement )) {
        $date = $dateversement ;
    } else {
        $date = date("y/m/d");
    }
    
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO versement (montant, idclient, iddette, iduser,dateversement,Om,motif) VALUES (?, ?, ?, ?, ?,?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param('ddddsds', $montant , $client ,$iddette, $_SESSION['id'], $date,$om,$matif);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();

    if($montant == $montantdette){
       $sql = "UPDATE dette SET status = 'OK' WHERE id ='$iddette'" ;
       $result = $conn->query($sql);

       $sql ="SELECT SUM(versement) as somme FROM client WHERE id='$client'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $versement = $montant + $row["somme"];

       $sql = "UPDATE client SET versement = '$versement' WHERE id ='$client'" ;
       $result = $conn->query($sql);

       //creerCaisse($montant);
    }else{

        $sql ="SELECT SUM(montant) as somme FROM versement WHERE iddette ='$iddette'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);

        if ($row["somme"]>=$montantdette) {
            $sql = "UPDATE dette SET status = 'OK' WHERE id ='$iddette'" ;
            $result = $conn->query($sql);

            $sql ="SELECT SUM(versement) as somme FROM client WHERE id='$client'";
                $result = $conn->query($sql);
                $row = mysqli_fetch_assoc($result);
                $versement = $montant + $row["somme"];

            $sql = "UPDATE client SET versement = '$versement' WHERE id ='$client'" ;
            $result = $conn->query($sql);
        } else {
            $sql ="SELECT SUM(versement) as somme FROM client WHERE id='$client'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            $versement = $montant + $row["somme"];

            $sql = "UPDATE client SET versement = '$versement' WHERE id ='$client'" ;
            $result = $conn->query($sql);
        }     
       //creerCaisse($montant);
    }
    
}

// Formulaire d'inscription
if (isset($_POST['submit'])) {

    $iddette = $_POST['iddette'];
    $client = $_POST['client'];
    $montant = $_POST['montant'];
    $montantdette = $_POST['montantdette'];
    $dateversement = $_POST['dateversement'];
    $om = $_POST['om'];
    $matif = $_POST['matif'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($iddette) || !empty($client) || !empty($montant) || !empty($montantdette)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            $sql = "SELECT * FROM dette WHERE id = ? AND status = 'en cour'";

            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            
            $stmt->bind_param('d', $iddette);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                creerVersement($iddette, $client, $montant, $montantdette,$dateversement,$om,$matif);
                header("Location:liste.php");
            } else {
                // Créer le compte utilisateur
                header("Location:liste.php");
                exit();
            }

            $stmt->close(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}


if (isset($_POST['modification'])) {

    $iddette = $_POST['iddette'];
    $client = $_POST['client'];
    $montant = $_POST['montant'];
    $montantdette = $_POST['montantdette'];
    $dateversement = $_POST['dateversement'];
    
    if (!empty($dateversement )) {
        $date = $dateversement ;
    } else {
        $date = date("y/m/d");
    }

    // Vérifier si tous les champs sont remplis
    if (!empty($iddette) || !empty($client) || !empty($montant) || !empty($montantdette)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            $sql = "SELECT * FROM versement WHERE id = ? ";

            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            
            $stmt->bind_param('d', $iddette);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                
                header("Location:liste.php");
            } else {
                // Créer le compte utilisateur
                
                header("Location:liste.php");
                exit();
            }

            $stmt->close(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}


?>

