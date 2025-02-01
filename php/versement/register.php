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

    $sql = "INSERT INTO caisse (operation, montant,idversement, iduser, dateoperation, motif) VALUES (?, ?, ?, ?,?)";

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
function creerVersement( $client, $montant, $montantdette,$dateversement,$om,$matif,$banque) {
    global $conn;

    if (!empty($dateversement )) {
        $date = $dateversement ;
    } else {
        $date = date("y/m/d");
    }
    
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO versement (montant, idclient, iduser,dateversement,Om,motif,banque) VALUES ( ?, ?, ?, ?,?,?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param('dddsdsd', $montant , $client,  $_SESSION['id'], $date,$om,$matif,$banque);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();

    if($montant == $montantdette){

       $sql ="SELECT SUM(versement) as somme FROM client WHERE id='$client'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $versement = $montant + $row["somme"];

       $sql = "UPDATE client SET versement = '$versement' WHERE id ='$client'" ;
       $result = $conn->query($sql);

       //creerCaisse($montant);
    }else{


          
       //creerCaisse($montant);
    }
    
}

// Formulaire d'inscription
if (isset($_POST['submit'])) {

    $iddette = $_POST['iddette'];
    $client = $_POST['client'];
    $montant = $_POST['montant'];
    $banque = $_POST['montantdette'];
    $dateversement = $_POST['dateversement'];
    $om = $_POST['om'];
    $matif = $_POST['matif'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($client) || !empty($montant) || !empty($banque)) {
        
            // Vérifier si l'adresse e-mail existe déjà           
                creerVersement($client, $montant, $banque,$dateversement,$om,$matif,$banque);
                header("Location:liste.php");
            
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
    $om = $_POST['om'];
    $matif = $_POST['matif'];
    $idversement = $_POST["idverse"];
    $banque = $_POST['banque'];
    if (!empty($dateversement )) {
        $date = $dateversement ;
    } else {
        $date = date("y/m/d");
    }

    // Vérifier si tous les champs sont remplis
    if (!empty($iddette) || !empty($client) || !empty($montant) || !empty($montantdette)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            $sql = "UPDATE versement SET montant='$montant',dateversement='$dateversement', Om='$om',idclient ='$client',banque='$banque' WHERE id='$idversement'";
            $result = $conn->query($sql); 
            if ($result === True) {
                if (($montant == 0) || ($montant < $montantdette)) {
                    
                        header("Location:liste.php");
                    
                }  
                
            } else {
                // Créer le compte utilisateur
                
                header("Location:liste.php");
                exit();
            }

            header("Location:liste.php");
                exit();

    }else {
        header("Location: ../../404.html");
        exit();
    }
}


?>

