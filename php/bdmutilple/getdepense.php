<?php

require_once("../connexion.php"); 


class Depense{
    public $datedepense;

    public function __construct($datedepense)
    {
        $this->datedepense = $datedepense;
    }

    public function ToDay(){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM depenses WHERE datedepense= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ByDateDepense($date){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM depenses WHERE datedepense= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function AllDepense(){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM depenses WHERE datedepense= CURRENT_DATE";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllDepenseDate($date){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM depenses WHERE datedepense= '$date'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }
}
?>