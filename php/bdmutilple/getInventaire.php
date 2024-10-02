<?php 
session_start();
require_once("../connexion.php");

class Stock{
    public $produit ;
    public $periodedate;
    public $datejour;

    private $data = [];

    public function __construct(){
       
    }
  
    public function ToDay(){
        global $conn;
        $sql = "SELECT * FROM quantiteproduit WHERE Qtdate = CURRENT_DATE()";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
               array_push($this->data,$row);  
        }

        return $this->data;
    }

    public function DayofMonth($produit){
        global $conn;
        $sql = "SELECT id ,quantite, Nomproduit, datet FROM quantiteproduit WHERE Qtdate = '$this->datejour' AND Nomproduit ='$produit'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
               array_push($this->data,$row);  
        }
        return $this->data;
    }

    public function DayofMonthHitorique($produit){
        global $conn;
        $sql = "SELECT id ,quantite, Nomproduit, datet FROM historiquestock WHERE datet = '$this->datejour' AND Nomproduit ='$produit'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
               array_push($this->data,$row);  
        }
        return $this->data;
    }

    public function getHitoriqueIntervale($produit,$date){
        global $conn;
        $sql = "SELECT id ,quantite, Nomproduit, datet FROM historiquestock WHERE datet BETWEEN  '$this->datejour' AND '$date' AND Nomproduit ='$produit'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
               array_push($this->data,$row);  
        }
        return $this->data;
    }

    public function HitoriqueIntervale($date){
        global $conn;
        $sql = "SELECT id ,quantite, Nomproduit, datet FROM historiquestock WHERE datet BETWEEN  '$this->datejour' AND '$date'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
               array_push($this->data,$row);  
        }
        return $this->data;
    }


    public function ToWeek(){
        global $conn;
        $jour = date('Y-m-d');
        $debur_semain = "" ;
        $dateval = new DateTime($this->datejour);
        if ($jour != $this->datejour) {
            $debur_semain = $dateval->modify('monday')->format("Y-m-d");
        }else{
            $debur_semain = $jour; 
        }
        $fin_semain = $dateval->modify('sunday')->format("Y-m-d");

        $sql = "SELECT * FROM quantiteproduit WHERE Qtdate BETWEEN '$debur_semain' AND '$fin_semain'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
               array_push($this->data,$row);  
        }

        return $this->data;
    }

    public function ToDayWeek(){
        global $conn;
        $dateval = new DateTime();
        
        $debur_semain = $dateval->modify('monday')->format("Y-m-d");
        $fin_semain = $dateval->modify('sunday')->format("Y-m-d");

        $sql = "SELECT * FROM quantiteproduit WHERE Qtdate BETWEEN '$debur_semain' AND '$fin_semain'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
               array_push($this->data,$row);  
        }

        return $this->data;
    }

    public function ToMonth(){
        global $conn;
        $dateval = new DateTime($this->datejour);
        
        //$debur_semain = $dateval->modify('monday')->format("Y-m-d");
        $fin_moi = $dateval->modify('last day of this month')->format("Y-m-d");

        $sql = "SELECT * FROM quantiteproduit WHERE Qtdate BETWEEN '$this->datejour' AND '$fin_moi'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
               array_push($this->data,$row);  
        }

        return $this->data;
    }


    public function AllMonth() {
        global $conn;
        $mois_actuel = date('m');
        $anne_actuel = date('Y');
        $date_debut = new DateTime("$anne_actuel-$mois_actuel-01");
        $fin_moi = clone $date_debut;
        $date_debut = $date_debut->format("Y-m-d");
        $fin_moi =$fin_moi->modify('last day of this month')->format("Y-m-d");

        $sql = "SELECT * FROM quantiteproduit WHERE Qtdate BETWEEN '$date_debut' AND '$fin_moi'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
               array_push($this->data,$row);  
        }

        return $this->data;
    }

    public function GetProduitToDay() {
        global $conn;

        $sql = "SELECT * FROM quantiteproduit WHERE Qtdate = CURRENT_DATE AND produit = '$this->produit' ";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
               array_push($this->data,$row);  
        }

        return $this->data;
    }

    public function GetProduitTodate() {
        global $conn;

        $sql = "SELECT * FROM quantiteproduit WHERE Qtdate = '$this->datejour' AND produit = '$this->produit'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
               array_push($this->data,$row);  
        }

        return $this->data;
    }

}

?>