<?php

require_once("../connexion.php"); 

class Dette{
    

    public function __construct()
    {
        
    }

    public function getDetteByIdClient($id){
        global $conn;
        $data = [];
        $sql = "SELECT montant FROM dette WHERE idclient = '$id'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($data,$row);    
        }
        return $data;
    }

    public function getSommeDette($date1,$date2){
        global $conn;
        $sql = "SELECT SUM(montant) AS montant FROM dette WHERE datedette BETWEEN '$date1' AND '$date2'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
            //$id = $row["id"];
        return $row["montant"];
    }

    public function getAllSomme(){
        global $conn;
        $sql = "SELECT SUM(montant) AS montant FROM dette ";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
            //$id = $row["id"];
        return $row["montant"];
    }

    public function getAllSommeDate($data){
        global $conn;
        $sql = "SELECT SUM(montant) AS montant FROM dette WHERE datedette ='$data'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
            //$id = $row["id"];
        return $row["montant"];
    }
    public function getAllSommeDateClient($data,$idclient){
        global $conn;
        $sql = "SELECT SUM(montant) AS montant FROM dette WHERE datedette ='$data' AND idclient='$idclient'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
            //$id = $row["id"];
        return $row["montant"];
    }

    public function SommeDateClient($idclient){
        global $conn;
        $sql = "SELECT SUM(montant) AS montant FROM dette WHERE idclient='$idclient'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
            //$id = $row["id"];
        return $row["montant"];
    }

    public function getSommeDetteClient($date1,$date2,$idclient){
        global $conn;
        $sql = "SELECT SUM(montant) AS montant FROM dette WHERE datedette BETWEEN '$date1' AND '$date2' AND idclient='$idclient'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
            //$id = $row["id"];
        return $row["montant"];
    }

    public function getAllDette(){
        global $conn;
        $data = [];
        $sql = "SELECT* FROM dette";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);    
        }
        return $data;
    }

    public function getAllDetteIntervall($date1,$date2){
        global $conn;
        $data = [];
        $sql = "SELECT* FROM dette WHERE datedette BETWEEN '$date1' AND '$date2'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);    
        }
        return $data;
    }
    public function getAllDetteIntervallClient($date1,$date2,$client){
        global $conn;
        $data = [];
        $dateDebut = new DateTime($date1);
        $dateFin = new DateTime($date2);

        while ($dateDebut <= $dateFin) {
            $tableauDates = $dateDebut->format("y/m/d");
            $sql = "SELECT* FROM dette WHERE datedette ='$tableauDates' AND idclient ='$client'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            array_push($data,$row); 
            $dateDebut->modify('+1 day');
        }
           
        
        return $data;
    }

    public function getAllDetteId($id){
        global $conn;
        $data = [];
        $sql = "SELECT* FROM dette WHERE idclient ='$id'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);    
        }
        return $data;
    }

    public function getAllDetteDate($date){
        global $conn;
        $data = [];
        $sql = "SELECT* FROM dette WHERE datedette ='$date'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);    
        }
        return $data;
    }

    public function getAllDetteDateClient($date,$id){
        global $conn;
        $data = [];
        $sql = "SELECT* FROM dette WHERE datedette ='$date' AND idclient ='$id'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);    
        }
        return $data;
    }
}
?>