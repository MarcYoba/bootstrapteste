<?php 

require_once("../connexion.php");

class Stock{
    public $produit ;
    public $periodedate;
    public $datejour;

    private $data = [];

    public function __construct($produit,$periodedate,$datejour){
        $this->produit = $produit;
        $this->periodedate = $periodedate;
        $this->datejour = $datejour;
        $this->data;
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

    public function getLogsProduit($produit){
        global $conn;
        $sql = "SELECT quantite AS quantites FROM historiquestock WHERE datet = CURRENT_DATE() AND Nomproduit='$produit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
                 
        return $row["quantites"];
    }

    public function getLogsDateProduit($produit,$date){
        global $conn;
        $sql = "SELECT quantite AS quantites FROM historiquestock WHERE datet = '$date' AND Nomproduit='$produit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
                 
        return $row["quantites"];
    }

    public function getHistorique($id){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM historiquestock WHERE idproduit='$id'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }       
        return $data;
    }


    public function getQuantiteProduit($produit){
        global $conn;
        $sql = "SELECT quantite_produit AS quantites FROM produit WHERE nom_produit='$produit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
                 
        return $row["quantites"];
    }

    public function getLogsDate(){
        global $conn;
        $data = [];
        $sql = "SELECT
            hs.Nomproduit,
            hs.quantite AS quantite_stock,
            p.quantite_produit,
            (SELECT SUM(a2.quantite) FROM achat a2 WHERE a2.idproduit = hs.idproduit AND YEAR(a2.dateachat) = YEAR(CURDATE()) AND 					MONTH(a2.dateachat) = MONTH(CURDATE())) AS quantite_achetee,
            (SELECT SUM(f2.quantite) FROM facture f2 WHERE f2.idproduit = hs.idproduit AND YEAR(f2.datefacture) = YEAR(CURDATE()) AND 				MONTH(f2.datefacture) = MONTH(CURDATE())) AS somme_facture,
            (SELECT SUM(f.quantite) FROM facture f WHERE f.idproduit = hs.idproduit AND  f.datefacture = CURRENT_DATE) AS quantite_facturee
            FROM
                historiquestock hs
            LEFT JOIN produit p ON p.id = hs.idproduit
            GROUP BY
                hs.Nomproduit
            ORDER BY
                hs.Nomproduit DESC";

        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }          
        return $data;
    }

    public function getLogsProduitDate($produit,$date){
        global $conn;
        $sql = "SELECT quantite AS quantites FROM historiquestock WHERE datet = '$date' AND Nomproduit='$produit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
                 
        return $row["quantites"];
    }

    public function UpdateHistorique($idproduit,$date,$quantite){
        global $conn;
        $sql = "UPDATE historiquestock SET quantite = '$quantite' WHERE idproduit = '$idproduit' AND datet='$date'";
        $result = $conn->query($sql);
        if($result === true){
            //return "Edite OK";
        }else{
            return "Edite false";
        }  
    }

    public function getLogsSuivant($produit,$date){
        global $conn;

        $sql = "SELECT DATE_ADD('$date', INTERVAL 1 DAY) as datete FROM historiquestock;";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        
        // $datefour = date('Y-m-d');
        // if ($datefour == $date) {
        //     $datesuivate = $date;
        // } else {
            
        // }
        
        $datesuivate = $row["datete"];

        $sql = "SELECT quantite AS quantites FROM historiquestock WHERE Nomproduit='$produit' AND datet ='$datesuivate' ";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        
        if (empty($row["quantites"])) {
            return 0;
        }
        return $row["quantites"];
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