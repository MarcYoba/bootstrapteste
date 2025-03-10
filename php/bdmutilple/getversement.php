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
        $sql = "SELECT SUM(montant + Om) as montant FROM versement WHERE dateversement= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function TotalVersement(){
        global $conn;
        $sql = "SELECT SUM(montant + Om) as montant FROM versement WHERE dateversement BETWEEN '2025-12-01' AND CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ByDateVersement($date){
        global $conn;
        $sql = "SELECT SUM(montant + Om) as montant FROM versement WHERE dateversement= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ByVersementClient($dette){
        global $conn;
        $sql = "SELECT SUM(montant + Om) as montant FROM versement WHERE iddette = '$dette'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ByVersementIdClient($idclient){
        global $conn;
        $sql = "SELECT SUM(montant + Om) as montant FROM versement WHERE idclient = '$idclient' AND YEAR(dateversement) = YEAR(CURRENT_DATE)";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ByVersementIdClientDate($idclient,$date){
        global $conn;
        $sql = "SELECT SUM(montant + Om + banque) as montant FROM versement WHERE idclient = '$idclient' AND dateversement= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ByVersementClientdate($date){
        global $conn;
        $sql = "SELECT SUM(montant + Om + banque) as montant FROM versement WHERE  dateversement= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function getVersementByClientBydate($date,$client){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM versement WHERE dateversement = '$date' AND idclient ='$client'";
        $result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function ByWeekVersement($datebedut,$datafin){
        global $conn;
        $sql = "SELECT SUM(montant + Om + banque) as montant FROM versement WHERE dateversement BETWEEN '$datebedut'  AND '$datafin'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ByDateVersementOm($date){
        global $conn;
        $sql = "SELECT SUM(Om) as Om FROM versement WHERE dateversement= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["Om"]; 
    }

    public function ByWeekVersementOm($datedebut,$datefin){
        global $conn;
        $sql = "SELECT SUM(Om) as Om FROM versement WHERE dateversement BETWEEN '$datedebut'  AND '$datefin'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["Om"]; 
    }

    public function ByDateVersementCash($date){
        
        return ($this->ByDateVersement($date) - $this->ByDateVersementOm($date));
    }

    public function ByWeekVersementCash($datedebut,$datefin){
        
        return ($this->ByWeekVersement($datedebut,$datefin) - $this->ByWeekVersementOm($datedebut,$datefin));
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

    public function AllVersementWeek($datebedut,$detefin){
        global $conn;
        $data = [];

        $sql = "SELECT * FROM versement WHERE dateversement BETWEEN '$datebedut'  AND '$detefin'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }

        return $data; 
    }

    public function VersementMensuel($idmois){
        global $conn;
        $data = [];

        $sql = "SELECT dateversement, 
            GROUP_CONCAT((montant + Om + banque),',') AS listMontant,
            ROUND(SUM(montant + Om + banque)) AS nomtant,
            GROUP_CONCAT(motif,',') AS motif 
            FROM versement
            WHERE Month(dateversement) = '$idmois'
            GROUP BY dateversement";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }

        $sql = "SELECT dateversement, 
            GROUP_CONCAT((montant + Om + banque),',') AS listMontant,
            ROUND(SUM(montant + Om + banque)) AS nomtant,
            GROUP_CONCAT(motif,',') AS motif 
            FROM versement
            WHERE Month(dateversement) = '$idmois'
            ";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            $row["dateversement"] = "TOTAL";
            $row["listMontant"] = $row["nomtant"];
            $row["motif"] = "-";
            array_push($data,$row);
        }

        return $data; 
    }
}
?>