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
        FROM historiquestock h
        LEFT JOIN produit p ON p.id = h.idproduit
        WHERE p.nom_produit = '$Nomproduit' AND h.datet = CURRENT_DATE";

        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        
        $sql = "UPDATE produit SET quantite_produit ='$quantite', stock_start_produit='$quantite' WHERE nom_produit = '$Nomproduit'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            $sql = "INSERT INTO inventaire (Nomproduit, quantite,quantiteHistorique, quantiteReeel, quantiteDepart,idproduit,dateInventaire,iduser) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            // Lier les paramètres
            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            $date = date("y/m/d");
            $stmt->bind_param('sdddddsd', $Nomproduit, $quantite,$row["quantitehisto"],$row["quantitePro"] ,$row["quantitedepart"],$row["id"], $date,$_SESSION["id"]);

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