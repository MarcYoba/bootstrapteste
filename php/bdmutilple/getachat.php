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
}
?>