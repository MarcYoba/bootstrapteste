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
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE datedepense= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ByDateDepense($date){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE datedepense= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }
    public function ByWeekDepense($datedebut,$datefin){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE datedepense BETWEEN '$datedebut'  AND'$datefin'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function AllDepense(){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM depensesphamacie WHERE datedepense= CURRENT_DATE";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllDepenseDate($date){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM depensesphamacie WHERE datedepense= '$date'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllDepenseWeek($datedebut,$datefin){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM depensesphamacie WHERE datedepense BETWEEN '$datedebut' AND '$datefin'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }
}
?>