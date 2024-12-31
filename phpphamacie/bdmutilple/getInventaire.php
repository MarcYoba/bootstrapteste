<?php 
session_start();
require_once("../connexion.php");

class Inventaire{
    public $produit ;
    public $periodedate;
    public $datejour;

    private $data = [];

    public function __construct(){
       
    }
  
    public function InsertInventaire($Nomproduit,$quantite){
        global $conn;
        $sql = "SELECT p.quantite_produit AS quantitePro, p.stock_start_produit AS quantitedepart,p.id ,h.quantite AS quantitehisto,h.Nomproduit
        FROM historiquestockphamacie h
        LEFT JOIN produitphamacie p ON p.id = h.idproduit
        WHERE p.nom_produit = '$Nomproduit' AND h.datet = CURRENT_DATE";

        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        
        $sql = "UPDATE produitphamacie SET quantite_produit ='$quantite', stock_start_produit='$quantite' WHERE nom_produit = '$Nomproduit'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            $sql = "INSERT INTO inventairephamacie (Nomproduit, quantite,quantiteHistorique, quantiteReeel, quantiteDepart,idproduit,dateInventaire) VALUES (?, ?, ?, ?, ?, ?, ?)";
            // Lier les paramètres
            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            $date = date("y/m/d");
            $stmt->bind_param('sddddds', $Nomproduit, $quantite,$row["quantitehisto"],$row["quantitePro"] ,$row["quantitedepart"],$row["id"], $date);

            // Exécuter la requête
            if (!$stmt->execute()) {
                die('Erreur d\'exécution de la requête : ' . $stmt->error);
            }

            // Fermer la requête
            $stmt->close();
            return true;
        }else{
            return false;
        }
    }
     
}

?>