<?php
session_start();
// Connexion à la base de données
require_once("../connexion.php");

// Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function creerClient($nom, $type, $prixvente, $prixachat,$quantite,$cathegorie,$dateperam) {
    global $conn;

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO produitphamacie  (nom_produit, prix_produit_vente,quantite_produit, prix_achat_produit, stock_start_produit,type_produit,date_ajout_produit,cathegorie,datePeramtion,iduser) VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $date = date("y/m/d");
    $stmt->bind_param('sddddssssd', $nom, $prixvente,$quantite,  $prixachat,$quantite,$type, $date,$cathegorie,$dateperam,$_SERVER["id"]);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
    $conn->close();
}

// Formulaire d'enregistrement produit
if (isset($_POST['enregistrement'])) {

    $nom = $_POST['Nomproduit'];
    $type = $_POST['typeProduit'];
    $prixvente = $_POST['prixvente'];
    $prixachat = $_POST['prixachat'];
    $quantite = $_POST['InputQuantite'];
    $cathegorie = $_POST['cathegorie'];
    $dateperam = $_POST['dateperam'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($nom) || !empty($type) || !empty($prixvente) || !empty($prixachat) || !empty($quantite) || !empty($cathegorie)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            $sql = "SELECT * FROM produitphamacie WHERE nom_produit = ?";

            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            
            $stmt->bind_param('s', $nom);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo 'Cette produit est déjà utilisée.';
                //exit();
            } else {
                // Créer le compte utilisateur
                creerClient($nom, $type, $prixvente, $prixachat, $quantite,$cathegorie,$dateperam);
                header("Location:liste.php");
                exit();
            }

            $stmt->close(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

// Formulaire d'modification produit
if (isset($_POST['modifier'])) {

    $id = $_POST['reference'];
    $nom = $_POST['Nomproduit'];
    $type = $_POST['typeProduit'];
    $prixvente = $_POST['prixvente'];
    $prixachat = $_POST['prixachat'];
    $quantite = $_POST['InputQuantite'];
    $cathegorie = $_POST['cathegorie'];
    $dateperam = $_POST['dateperam'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($nom) || !empty($type) || !empty($prixvente) || !empty($prixachat) || !empty($quantite) || !empty($cathegorie)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            $sql = "SELECT * FROM produitphamacie  WHERE id = ?";

            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            
            $stmt->bind_param('d', $id);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $sesion = $_SESSION["id"];
                $sql = "UPDATE produitphamacie  set nom_produit ='$nom',type_produit ='$type', prix_produit_vente ='$prixvente',
                	prix_achat_produit ='$prixachat', quantite_produit ='$quantite',cathegorie ='$cathegorie',datePeramtion ='$dateperam',iduser ='$sesion' WHERE id = '$id'";
                $result = $conn->query($sql);
                $sql = "UPDATE historiquestockphamacie set Nomproduit ='$nom' WHERE idproduit  = '$id'";
                $result = $conn->query($sql);
                header("Location: liste.php");

            } else {
                echo 'Ce produit viens d de quel stock.';
            } 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}else{
    echo 'non';
}

?>

