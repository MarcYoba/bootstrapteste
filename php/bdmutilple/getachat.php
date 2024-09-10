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
}
?>