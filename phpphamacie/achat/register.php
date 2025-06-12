<?php

session_start();
require_once("../connexion.php");
header('Content-Type: application/json');

 $json = file_get_contents('php://input');
    $donnees = json_decode($json,true);

function calculer_date_rappel($date_expiration, $marge_en_mois) {
        // Convertit la date d'expiration en objet DateTime
        $date_exp = new DateTime($date_expiration);
      
        // Calcule la date de rappel en soustrayant le nombre de mois de marge
        $date_rappel = $date_exp->modify('-' . $marge_en_mois . ' months');
      
        // Retourne la date de rappel formatée
        return $date_rappel->format('Y/m/d');
}

function insertLots($datperantion, $idachat,$idproduit){

    global $conn;
    
    $sql = "INSERT INTO lots(idproduit,date_expiration,dateRapelle,idachat) VALUES (?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $date = calculer_date_rappel($datperantion,1);

    $stmt->bind_param('dssd', $idproduit , $datperantion, $date,$idachat);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
}

 // Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function insertAchat($idfournissuer,$produit,$quantite, $prix,$Totale,$datevalue,$dateperantion) {
    global $conn;

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "SELECT * FROM produitphamacie WHERE nom_produit = '$produit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $idproduit = $row["id"];
        $stock = $row["quantite_produit"];
        $prixvente = $row["prix_produit_vente"];
        $perantiondate = $row["datePeramtion"];

    /*
    $sql = "SELECT id FROM fournisseur WHERE nom = '$idfournissuer'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $idfournisseur = $row["id"];
    */
    $sql = "INSERT INTO achatphamacie (Nomproduit,prixAcaht,quantite,montant,idproduit,idfournisseur,dateachat,iduser) VALUES (?, ?, ?, ?, ?, ?, ?,?)";

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
    $stock = $stock + 0;
    $gain = $prixvente - $prix;

    if (($perantiondate == "0000-00-00") || (empty($perantiondate)) || ($perantiondate == "0001-01-01")) {
        $sql = "UPDATE produitphamacie SET quantite_produit = '$stock',prix_achat_produit='$prix',gain_produit='$gain',datePeramtion='$dateperantion' WHERE nom_produit = '$produit' ";
        $result = $conn->query($sql);
        $date = date("y/m/d");

        $sql = "SELECT id,idproduit FROM achatphamacie WHERE dateachat = '$date' ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        $idproduit = $row["idproduit"];

        insertPrix($produit, $prix,$id);
    }else{
        $sql = "UPDATE produitphamacie SET quantite_produit = '$stock',prix_achat_produit='$prix',gain_produit='$gain' WHERE nom_produit = '$produit' ";
        $result = $conn->query($sql);
        $date = date("y/m/d");

        $sql = "SELECT id,idproduit FROM achatphamacie WHERE dateachat = '$date' ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        $idproduit = $row["idproduit"];

        insertPrix($produit, $prix,$id);
        insertLots($dateperantion,$id,$idproduit);
    }
    // selection la id dans la table d'achat
    
    
    
}

// insertion dans la table de prix du produit
function insertPrix($nom,$prix,$id) {
    global $conn;
    $prixvente = $prix + 120;
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du prix (insertion de donne) 

    $sql = "INSERT INTO prixphamacie  (produit,prixAcaht,prixVente,idachat,iduser,dateprix) VALUES (?, ?, ?, ?, ?, ?)";

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
        insertAchat($value["fournisseur"],$value["produit"],$value["quantite"],$value["prix"],$value["total"],$value['datevalue'],$value['datepera']);  
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
