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
        $sql = "SELECT SUM(montant) as montant FROM achat WHERE dateachat= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function DeleteAchat($id){
        global $conn;

        $sql = "DELETE  FROM prix WHERE idachat= '$id'";
        $result = $conn->query($sql);
        
        $sql = "DELETE  FROM achat WHERE id= '$id'";
        $result = $conn->query($sql);
        if ($result===true) {
            return  true;
        } else {
            return  false;
        }
         
    }

    public function getByDate($date){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM achat WHERE dateachat= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }
    public function getByWeek($datedebut,$datefin){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM achat WHERE dateachat BETWEEN '$datedebut' AND '$datefin'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function UpdateAchat($idachat,$quantite,$nomProdit,$quatproduit,$fournisseur,$prix){

        global $conn;

        $sql = "SELECT id,quantite_produit FROM produit WHERE nom_produit='$nomProdit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $idproduit= $row["id"]; 
        $somme = $row["quantite_produit"] + $quatproduit;

        $sql = "UPDATE produit SET quantite_produit = '$somme' WHERE id = '$idproduit'";
        $result = $conn->query($sql);
        if($result === true){
            $somme = $quantite*$prix;
            $sql = "UPDATE achat SET quantite = '$quantite', prixAcaht = '$prix', idfournisseur  = '$fournisseur',montant='$somme'  WHERE id = '$idachat'";
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
        $sql = "SELECT * FROM achat WHERE dateachat= CURRENT_DATE";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function getAllAchat(){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achat";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function getAchatById($id){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achat WHERE id='$id'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function getSommeAchat($idproduit,$date){
        global $conn;
        
        $sql = "SELECT SUM(quantite) AS quantite FROM achat WHERE idproduit = '$idproduit' AND dateachat = '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
       return $row["quantite"] ;
        
    }

    public function getAllAchatProduit($produit){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achat WHERE Nomproduit='$produit'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatDate($date){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achat WHERE dateachat= '$date'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatDateProduit($date,$produit){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achat WHERE dateachat= '$date' AND Nomproduit='$produit'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatWeek($datedebut,$datefin){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achat WHERE dateachat BETWEEN '$datedebut' AND '$datefin'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatWeekProduit($datedebut,$datefin,$produit){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achat WHERE dateachat BETWEEN '$datedebut' AND '$datefin' AND Nomproduit='$produit'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function Sommemenseule($idmois){
        global $conn;
        $data = [];
        $sql = "SELECT dateachat,
                GROUP_CONCAT(prixAcaht SEPARATOR',') as listeprix,
                ROUND(SUM(prixAcaht),2) AS somPrix,
                GROUP_CONCAT(quantite SEPARATOR',') as listquantite,
                ROUND(SUM(quantite),2) as somQuantite,
                GROUP_CONCAT(montant SEPARATOR',') as listMontant,
                ROUND(SUM(montant),2) AS somMontant,
                GROUP_CONCAT(Nomproduit SEPARATOR ',') AS nom
        FROM `achat` 
        WHERE month(dateachat) = '$idmois'
        GROUP BY dateachat";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT dateachat,
                GROUP_CONCAT(prixAcaht SEPARATOR',') as listeprix,
                ROUND(SUM(prixAcaht),2) AS somPrix,
                GROUP_CONCAT(quantite SEPARATOR',') as listquantite,
                ROUND(SUM(quantite),2) as somQuantite,
                GROUP_CONCAT(montant SEPARATOR',') as listMontant,
                ROUND(SUM(montant),2) AS somMontant,
                GROUP_CONCAT(Nomproduit SEPARATOR ',') AS nom
        FROM `achat` 
        WHERE month(dateachat) = '$idmois'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["dateachat"] = "TOTAL";
            $row["listeprix"] = $row["somPrix"];
            $row["listquantite"] = $row["somQuantite"];
            $row["listMontant"] = $row["somMontant"];
            $row["nom"] = "-";
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function SommeAcgatMensuel($date){
        global $conn;
        $sql = "SELECT SUM(montant) AS montant FROM achat WHERE MONTH(dateachat) = '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
       return $row["montant"];  
    }
}
?>