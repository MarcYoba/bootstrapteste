<?php

require_once("./php/connexion.php"); 

class Produit{

    public function getByIdProduit(){
        global $conn;
        $tableau = [];
        $sql = "SELECT id, nom_produit AS produit, quantite_produit AS quantite FROM produitphamacie";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($tableau,$row);
        }    
        return $tableau; 
    }

    public function getAllProduit(){
        global $conn;
        $tableau = [];
        $sql = "SELECT id, quantite_produit , nom_produit ,date_ajout_produit FROM produitphamacie";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($tableau,$row);
        }    
        return $tableau; 
    }

    public function getAllProduitName($produit){
        global $conn;
        $tableau = [];
        $sql = "SELECT id, quantite_produit , nom_produit ,date_ajout_produit FROM produitphamacie WHERE nom_produit= '$produit'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($tableau,$row);
        }    
        return $tableau; 
    }

    public function getHistoriqueStockDate($idate){
        global $conn;
        
        $sql = "SELECT id as id FROM historiquestockphamacie WHERE datet ='$idate' ORDER BY id DESC LIMIT 1  ";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row; 
    }

    public function InsertHistoriqueStock($tableau){
        global $conn;

        $timestam = new DateTime();
        $timestam = $timestam->format('H:i:s');

        date_default_timezone_set('Africa/Douala');
        $timestamp = new DateTime();
        $timecameroune= $timestamp->format('H:i:s');
        
       foreach ($tableau as $key => $value) {
            $sql = "INSERT INTO historiquestockphamacie (Nomproduit, quantite,datet, idproduit,heurecamroun,heureserveur) VALUES (?, ?, ?,?,?,?)";

        // Lier les paramètres
            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            $date = date("y/m/d");
            $stmt->bind_param('sdsdss', $value["produit"], $value["quantite"],$date,  $value["id"],$timecameroune,$timestam);

            // Exécuter la requête
            if (!$stmt->execute()) {
                die('Erreur d\'exécution de la requête : ' . $stmt->error);
            }

            // Fermer la requête
            $stmt->close();
       }


    }  


}
?>