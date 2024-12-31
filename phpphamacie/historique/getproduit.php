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

    public function ProduitSansDatePremption(){
        global $conn;
        $data = [];
        $sql = " SELECT p.nom_produit,p.quantite_produit,p.type_produit,p.datePeramtion as lot01,l.date_expiration AS lot02
                FROM produitphamacie p
                INNER JOIN lots l on l.idproduit = p.id
                WHERE p.datePeramtion 
                is NULL AND p.quantite_produit>0";
        $result =$conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data;
    }

    public function DoublonProduit(){
        global $conn;
        $data = [];
        $sql = " SELECT nom_produit, COUNT(*) AS nombre
                FROM produitphamacie
                GROUP BY nom_produit
                HAVING COUNT(*) > 1;";
        $result =$conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data;
    }

    public function ProduitEnCourPeremtionPrelote(){
        global $conn;
        $data = [];
        $sql = " SELECT p.nom_produit,p.quantite_produit,p.datePeramtion 
            FROM produitphamacie p 
            WHERE p.datePeramtion <= DATE_ADD(CURDATE(), INTERVAL 6 MONTH)
            AND p.datePeramtion <> '0001-01-01' AND p.datePeramtion <> '0000-00-00'
            AND p.quantite_produit > 0";
        $result =$conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data;
    }

    public function ProduitEnCourPeremtionSecdlote(){
        global $conn;
        $data = [];
        $sql = "SELECT p.nom_produit,p.quantite_produit,l.date_expiration
        FROM lots l
        INNER JOIN produitphamacie p ON l.idproduit = p.id
        WHERE l.date_expiration <= DATE_ADD(CURDATE(), INTERVAL 6 MONTH)
        AND l.date_expiration <> '0001-01-01' AND l.date_expiration <> '0000-00-00'";
        $result =$conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data;
    }

    public function CommandePoussinNonLivrer(){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM `poussin` WHERE statusCommande ='EN COUR'";
        $result =$conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data;
    }

}
?>