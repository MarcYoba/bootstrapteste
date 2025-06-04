<?php

// Connexion à la base de données
session_start();
require_once("../connexion.php");

function creerCaisse($montant) {
    global $conn;
    $date = date("y/m/d");
    $sql = "SELECT id FROM versementphamacie ORDER BY id DESC";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            $idversement = $row["id"];
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO caissePhamacie (operation, montant,idversement, iduser, dateoperation, motif) VALUES (?, ?, ?, ?, ?,?)";

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
function creerVersement($client, $montant,$dateversement,$om,$matif,$banque ) {
    global $conn;

    if (!empty($dateversement )) {
        $date = $dateversement ;
    } else {
        $date = date("y/m/d");
    }
    
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO versementphamacie (montant, idclient, iduser,dateversement,Om,motif,banque) VALUES (?, ?, ?, ?,?,?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param('dddsdsd', $montant , $client, $_SESSION['id'], $date,$om,$matif,$banque);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();

    if($montant){

       $sql ="SELECT SUM(versement) as somme FROM client WHERE id='$client'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $versement = $montant + $row["somme"];

       $sql = "UPDATE client SET versement = '$versement' WHERE id ='$client'" ;
       $result = $conn->query($sql);

       //creerCaisse($montant);
    }else{

        // $sql ="SELECT SUM(montant) as somme FROM versementphamacie WHERE iddette ='$cli'";
        // $result = $conn->query($sql);
        // $row = mysqli_fetch_assoc($result);

        // if ($row["somme"]>=$montantdette) {

        //     $sql ="SELECT SUM(versement) as somme FROM client WHERE id='$client'";
        //         $result = $conn->query($sql);
        //         $row = mysqli_fetch_assoc($result);
        //         $versement = $montant + $row["somme"];

        //     $sql = "UPDATE client SET versement = '$versement' WHERE id ='$client'" ;
        //     $result = $conn->query($sql);
        // } else {
        //     $sql ="SELECT SUM(versement) as somme FROM client WHERE id='$client'";
        //     $result = $conn->query($sql);
        //     $row = mysqli_fetch_assoc($result);
        //     $versement = $montant + $row["somme"];

        //     $sql = "UPDATE client SET versement = '$versement' WHERE id ='$client'" ;
        //     $result = $conn->query($sql);
        // }     
       //creerCaisse($montant);
    }
    
}

// Formulaire d'inscription
if (isset($_POST['submit'])) {

   // $iddette = $_POST['iddette'];
    $client = $_POST['client'];
    $montant = $_POST['montant'];
    
    $dateversement = $_POST['dateversement'];
    $om = $_POST['om'];
    $banque = $_POST['banque'];
    $matif = $_POST['matif'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($client) || !empty($montant) ) {
        
            // Vérifier si l'adresse e-mail existe déjà

                creerVersement($client, $montant,$dateversement,$om,$matif,$banque);
                header("Location:liste.php");
           
                exit();
           
    }else {
        header("Location: ../../404.html");
        exit();
    }
}


if (isset($_POST['modification'])) {

    $iddette = $_POST['iddette'];
    $client = $_POST['client'];
    $montant = $_POST['montant'];
    $banque = $_POST['banque'];
    $dateversement = $_POST['dateversement'];
    $om = $_POST['om'];
    $om = $_POST['montant'];
    $idversement = $_POST["iddette"];
    
    if (!empty($dateversement )) {
        $date = $dateversement ;
    } else {
        $date = date("y/m/d");
    }

    // Vérifier si tous les champs sont remplis
    if (!empty($iddvette) || !empty($client) || !empty($montant) || !empty($banque)) {
        
            
            $sql = "UPDATE versementphamacie SET montant='$montant',dateversement='$dateversement', Om='$om',idclient ='$client',banque='$banque' WHERE id='$idversement'";
            $result = $conn->query($sql); 
            if ($result === True) {
                if (($montant == 0) || ($montant < $banque)) {
                    
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

