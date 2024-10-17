<?php

require_once("../connexion.php"); 


class Achat{
    public $dateachat;

    public function __construct($dateachat)
    {
        $this->dateachat = $dateachat;
    }

    public function ToDay(){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM achatphamacie WHERE dateachat= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function DeleteAchat($id){
        global $conn;

        $sql = "DELETE  FROM prixphamacie WHERE idachat= '$id'";
        $result = $conn->query($sql);
        
        $sql = "DELETE  FROM achatphamacie WHERE id= '$id'";
        $result = $conn->query($sql);
        if ($result===true) {
            return  true;
        } else {
            return  false;
        }
         
    }

    public function getByDate($date){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM achatphamacie WHERE dateachat= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }
    public function getByWeek($datedebut,$datefin){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM achatphamacie WHERE dateachat BETWEEN '$datedebut' AND '$datefin'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function UpdateAchat($idachat,$quantite,$nomProdit,$quatproduit,$fournisseur,$prix){

        global $conn;

        $sql = "SELECT id,quantite_produit FROM produitphamacie WHERE nom_produit='$nomProdit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $idproduit= $row["id"]; 
        $somme = $row["quantite_produit"] + $quatproduit;

        $sql = "UPDATE produitphamacie SET quantite_produit = '$somme' WHERE id = '$idproduit'";
        $result = $conn->query($sql);
        if($result === true){
            $somme = $quantite*$prix;
            $sql = "UPDATE achatphamacie SET quantite = '$quantite', prixAcaht = '$prix', idfournisseur  = '$fournisseur',montant='$somme'  WHERE id = '$idachat'";
            $result = $conn->query($sql);
            if ($result === true) {
                return true;
            } else {
                return false;
            }  
        }else{
            return false;
        }  
    }
    public function AllAchat(){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE dateachat= CURRENT_DATE";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function getAllAchat(){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function getAchatById($id){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE id='$id'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function getSommeAchat($idproduit,$date){
        global $conn;
        
        $sql = "SELECT SUM(quantite) AS quantite FROM achatphamacie WHERE idproduit = '$idproduit' AND dateachat = '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
       return $row["quantite"] ;
        
    }

    public function getAllAchatProduit($produit){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE Nomproduit='$produit'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatDate($date){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE dateachat= '$date'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatDateProduit($date,$produit){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE dateachat= '$date' AND Nomproduit='$produit'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatWeek($datedebut,$datefin){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE dateachat BETWEEN '$datedebut' AND '$datefin'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatWeekProduit($datedebut,$datefin,$produit){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE dateachat BETWEEN '$datedebut' AND '$datefin' AND Nomproduit='$produit'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }
}
?>