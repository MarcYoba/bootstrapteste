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

    public function DepenseMensuelle($mois){
        global $conn;
        $data = [];
        $sql = "SELECT datedepense, 
            GROUP_CONCAT(montant,',') AS listMontant,
            ROUND(SUM(montant)) AS nomtant,
            GROUP_CONCAT(description,',') AS motif 
            FROM depensephamacie
            WHERE Month(datedepense) = '$mois'
            GROUP BY datedepense";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT datedepense, 
            GROUP_CONCAT(montant,',') AS listMontant,
            ROUND(SUM(montant)) AS nomtant,
            GROUP_CONCAT(description,',') AS motif 
            FROM depensephamacie
            WHERE Month(datedepense) = '$mois'
            ";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["datedepense"] = "TOTAL";
            $row["listMontant"] = $row["nomtant"] ;
            $row["datedepense"] = "-";
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function DepenseTemesttre($anne)
    {
        global $conn;
        $data =[];
        $sql = "SELECT QUARTER(datedepense) AS trimestre, ROUND(SUM(montant),2) AS nombre_enregistrements 
        FROM depensephamacie 
        WHERE YEAR(datedepense) = $anne
        GROUP BY QUARTER(datedepense);";

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function DepenseSemesttre($anne)
    {
        global $conn;
        $data =[];
        $sql = "SELECT 
        CEILING(MONTH(datedepense) / 6) AS semestre,
        ROUND(SUM(montant),2) AS montant
        FROM 
            depensephamacie
        WHERE YEAR(datedepense) = $anne
        GROUP BY 
            semestre";

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }
}
?>