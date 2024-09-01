<?php

session_start();
require_once("../connexion.php");
header('Content-Type: application/json');

 $json = file_get_contents('php://input');
    $donnees = json_decode($json,true);
    /*
    $reponse = [
        'success' => true,
        'message' => "enregistrement avec success"
     ];
    echo json_encode($reponse);
     */

 // Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function insertAchat($idfournissuer,$produit,$quantite, $prix,$Totale,$datevalue) {
    global $conn;

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "SELECT * FROM produit WHERE nom_produit = '$produit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $idproduit = $row["id"];
        $stock = $row["quantite_produit"];
        $prixvente = $row["prix_produit_vente"];
    /*
    $sql = "SELECT id FROM fournisseur WHERE nom = '$idfournissuer'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $idfournisseur = $row["id"];
    */
    $sql = "INSERT INTO achat (Nomproduit,prixAcaht,quantite,montant,idproduit,idfournisseur,dateachat,iduser) VALUES (?, ?, ?, ?, ?, ?, ?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    if (!empty($datevalue)) {
       $date = $datevalue;
    } else {
        $date = date("y/m/d");
    }
    
    
    $stmt->bind_param('sdddddsd', $produit, $prix, $quantite,$Totale, $idproduit, $idfournissuer, $date, $_SESSION["id"]);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
    $stock = $stock + $quantite;
    $gain = $prixvente - $prix;
    // selection la id dans la table d'achat
    $sql = "UPDATE produit SET quantite_produit = '$stock',prix_achat_produit='$prix',gain_produit='$gain' WHERE nom_produit = '$produit' ";
    $result = $conn->query($sql);
    
    $sql = "SELECT id FROM achat WHERE dateachat = '$date' ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];

        insertPrix($produit, $prix,$id);
    
}

// insertion dans la table de prix du produit
function insertPrix($nom,$prix,$id) {
    global $conn;
    $prixvente = $prix + 120;
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du prix (insertion de donne) 

    $sql = "INSERT INTO prix (produit,prixAcaht,prixVente,idachat,iduser,dateprix) VALUES (?, ?, ?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $date = date("y/m/d");

    $stmt->bind_param('sdddds', $nom , $prix, $prixvente,$id,$_SESSION["id"], $date);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();

}

try {
    foreach ($donnees as $key => $value) {
        insertAchat($value["fournisseur"],$value["produit"],$value["quantite"],$value["prix"],$value["total"],$value['datevalue']);  
    }
   
} catch (\Throwable $th) {
    //throw $th;
    echo json_encode($th);
}

$reponse = [
    'success' => true,
    'message' => "enregistrement avec success base donnee"
 ];
echo json_encode($reponse);

?>
