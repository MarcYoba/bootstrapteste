<?php

require_once("../connexion.php"); 

class Produit{

    public function getByIdProduit(){
        global $conn;
        $tableau = [];
        $sql = "SELECT id, nom_produit AS produit, quantite_produit AS quantite FROM produit";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($tableau,$row);
        }    
        return $tableau; 
    }

    public function getQuantiteProduit($produit){
        global $conn;
        $sql = "SELECT quantite_produit AS quantites FROM produit WHERE  nom_produit='$produit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
                 
        return $row["quantites"];
    }

    public function SommeProduitStocker($produit){
        global $conn;
        $sql = "SELECT ROUND(SUM(prix_produit_vente*quantite_produit),2) as montant FROM produit;";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
                 
        return $row["montant"];
    }

    public function UpdateProduit($idproduit,$quantite){
        global $conn;
        $sql = "UPDATE produit SET quantite_produit = '$quantite' WHERE id = '$idproduit'";
        $result = $conn->query($sql);
        if($result === true){
            //return "Edite OK";
        }else{
            return "Edite false";
        }  
    }

    public function UgradeProduit($idproduit,$quantite){
        global $conn;

        $sql = "SELECT quantite_produit AS quantite FROM produit WHERE  id='$idproduit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result); 
        $quantite = $row["quantite"] + $quantite;

        $sql = "UPDATE produit SET quantite_produit = '$quantite' WHERE id = '$idproduit'";
        $result = $conn->query($sql);
        if($result === true){
            //return "Edite OK";
        }else{
            return "Edite false";
        }  
    }

    public function getIdProduit($produit){
        global $conn;
        $sql = "SELECT id AS id FROM produit WHERE  nom_produit='$produit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);              
        return $row["id"];
    }


    public function getAllProduit(){
        global $conn;
        $tableau = [];
        $sql = "SELECT id, quantite_produit , nom_produit ,date_ajout_produit FROM produit";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($tableau,$row);
        }    
        return $tableau; 
    }

    public function getHistoriqueProduit($date){
        global $conn;
        $tableau = [];
        $sql = "SELECT id, quantite , Nomproduit ,datet FROM historiquestock WHERE datet='$date'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($tableau,$row);
        }    
        return $tableau; 
    }

    public function getAllProduitName($produit){
        global $conn;
        $tableau = [];
        $sql = "SELECT id, quantite_produit , nom_produit ,date_ajout_produit FROM produit WHERE nom_produit= '$produit'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($tableau,$row);
        }    
        return $tableau; 
    }

    public function getHistoriqueStockDate($idate){
        global $conn;
        
        $sql = "SELECT id as id FROM historiquestock WHERE datet ='$idate' ORDER BY id DESC LIMIT 1  ";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row; 
    }

    public function InsertHistoriqueStock($tableau){
        global $conn;
        
       foreach ($tableau as $key => $value) {
            $sql = "INSERT INTO historiquestock (Nomproduit, quantite,datet, idproduit) VALUES (?, ?, ?,?)";

        // Lier les paramètres
            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            $date = date("y/m/d");
            $stmt->bind_param('sdsd', $value["produit"], $value["quantite"],$date,  $value["id"]);

            // Exécuter la requête
            if (!$stmt->execute()) {
                die('Erreur d\'exécution de la requête : ' . $stmt->error);
            }
            // Fermer la requête
            $stmt->close();
       }


    } 
    
    public function getRecaptulatif(){
        global $conn;
        $tableau = [];
        $sql = "SELECT nom_produit,round(quantite_produit,2),prix_produit_vente FROM `produit` ORDER BY nom_produit ASC";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($tableau,$row);
        }    
        return $tableau; 
    }

    public function InserProduit($tab,$user){
        global $conn;
        $nom = $tab["PRODUITS"];
        $sql = "SELECT * FROM produit WHERE nom_produit = ?";

            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            
            $stmt->bind_param('s', $nom);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                return 'Cette produit est déjà utilisée.';
                //exit();
            } 
        // Préparer la requête SQL
        // --------------------------------------------------------------------------------
        // Creation du client (insertion de donne) 
        $sql = "INSERT INTO produit (nom_produit, prix_produit_vente,quantite_produit, prix_achat_produit, stock_start_produit,type_produit,date_ajout_produit,cathegorie,iduser) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)";

        // Lier les paramètres
        if (!$stmt = $conn->prepare($sql)) {
            die('Erreur de préparation de la requête : ' . $conn->error);
        }
        $date = date("Y-m-d H:i:s");
        $stmt->bind_param('sddddsssd', $tab["PRODUITS"], $tab["PRIX_VENTE"],$tab["QUANTITES"],  $tab["PRIX_ACHAT"],$tab["QUANTITES"],$tab["TYPE"], $date,$tab["CATHEGORIE"],$user);

        // Exécuter la requête
        if (!$stmt->execute()) {
            die('Erreur d\'exécution de la requête : ' . $stmt->error);
        }

        // Fermer la requête
        $stmt->close();
    }
}