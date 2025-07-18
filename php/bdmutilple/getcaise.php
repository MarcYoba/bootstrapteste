<?php

require_once("../connexion.php"); 


class Caise{
    public $datecaise;

    public function __construct($datecaise)
    {
        $this->datecaise = $datecaise;
    }

    public function ToDay(){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM `caisse` WHERE operation ='sortie en caisse' and dateoperation = CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ToRetourCaisse(){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM `caisse` WHERE operation ='retour en caisse' and dateoperation = CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function getByDateSortie($date){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM `caisse` WHERE operation ='sortie en caisse' and dateoperation = '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function RetourCaisse($date){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM `caisse` WHERE operation ='retour en caisse' and dateoperation = '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function getByWeekSortie($datedebut,$datefin){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM `caisse` WHERE operation ='sortie en caisse' and dateoperation BETWEEN '$datedebut'  AND '$datefin'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function RetourgetByWeek($datedebut,$datefin){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM `caisse` WHERE operation ='retour en caisse' and dateoperation BETWEEN '$datedebut'  AND '$datefin'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function AllSortieCaise(){
        global $conn;
        $data=[];
        $sql = "SELECT * FROM `caisse` WHERE (operation ='sortie en caisse' OR operation ='retour en caisse') and dateoperation = CURRENT_DATE";
        $result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function AllSortieCaiseDate($date){
        global $conn;
        $data=[];
        $sql = "SELECT * FROM `caisse` WHERE (operation LIKE 'sortie%' OR operation ='retour en caisse') and dateoperation = '$date'";
        $result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function AllSortieCaiseWeek($datedebut,$datefin){
        global $conn;
        $data=[];
        $sql = "SELECT * FROM `caisse` WHERE (operation LIKE 'sortie%' OR operation ='retour en caisse') and dateoperation BETWEEN '$datedebut'  AND '$datefin'";
        $result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function SommeeMenseurl($Idmois,$date){
        global $conn;
        $data=[];
        // $sql = "SELECT dateoperation, 
        //         GROUP_CONCAT(operation,',') AS qopration, 
        //         GROUP_CONCAT(montant,',') AS listmont, 
        //         ROUND(SUM(montant)) AS nomtant
        // FROM `caisse` 
        // WHERE (operation LIKE 'sortie%' OR operation ='retour en caisse') AND MONTH(dateoperation) = '$Idmois'
        // GROUP BY dateoperation";
        // $result = $conn->query($sql);

        // while($row = mysqli_fetch_assoc($result)){
        //     array_push($data,$row);
        // }

        $sql = "SELECT dateoperation, 
                GROUP_CONCAT(operation,',') AS qopration, 
                GROUP_CONCAT(montant,',') AS listmont, 
                ROUND(SUM(montant),2) AS nomtant
        FROM `caisse` 
        WHERE (operation LIKE 'sortie%' OR operation ='retour en caisse') AND MONTH(dateoperation) = '$Idmois' AND YEAR(dateoperation) = YEAR('$date')
        ";
        $result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($result)){
            $row["dateoperation"] = "TOTAL";
            $row["listmont"] = $row["nomtant"];
            $row["qopration"] = "-";
            array_push($data,$row);
        }

        return $data; 
    }
}
?>