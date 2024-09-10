<?php
require_once("../connexion.php"); 


class Versement{
    public $dateversement;

    public function __construct($dateversement)
    {
        $this->dateversement = $dateversement;
    }

    public function ToDay(){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM versement WHERE dateversement= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ByDateVersement($date){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM versement WHERE dateversement= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function AllVersement(){
        global $conn;
        $data = [];

        $sql = "SELECT * FROM versement WHERE dateversement= CURRENT_DATE";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }

        return $data; 
    }

    public function AllVersementDate(){
        global $conn;
        $data = [];

        $sql = "SELECT * FROM versement WHERE dateversement= '$this->dateversement'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }

        return $data; 
    }
}
?>