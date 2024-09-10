<?php
session_start();
require_once("../connexion.php"); 

//header('Content-Type: application/json');

$json = file_get_contents('php://input');
$donnees = json_decode($json,true);


class Vente{
   public $value = "";
   public $idfacutre;
   private $data = [];

    public function __construct($value){
        $this->value = $value;
        $this->idfacutre;
        $this->data;
    }

    public function getIdVente() {
        global $conn;
        $sql = "SELECT id FROM vente WHERE datevente= CURRENT_DATE";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function getIdVenteByDate($date) {
        global $conn;
        $this->data = [];
        $sql = "SELECT id FROM vente WHERE datevente= '$date'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function getSommeVente() {
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM facture WHERE datefacture= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function getSommeVentedate($date) {
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM facture WHERE datefacture= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function getSommeCash() {
        global $conn;
        $sql = "SELECT SUM(cash) as cash FROM vente WHERE datevente= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["cash"]; 
    }

    public function getSommeCashDate($date) {
        global $conn;
        $sql = "SELECT SUM(cash) as cash FROM vente WHERE datevente= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["cash"]; 
    }

    public function getSommeCredit() {
        global $conn;
        $sql = "SELECT SUM(credit) as credit FROM vente WHERE datevente= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["credit"]; 
    }

    public function getSommeCreditDate($date) {
        global $conn;
        $sql = "SELECT SUM(credit) as credit FROM vente WHERE datevente= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["credit"]; 
    }

    public function getSommeOm() {
        global $conn;
        $sql = "SELECT SUM(Om) as Om FROM vente WHERE datevente= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["Om"]; 
    }

    public function getSommeOmDate($date) {
        global $conn;
        $sql = "SELECT SUM(Om) as Om FROM vente WHERE datevente= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["Om"]; 
    }

    public function getSommeReduction() {
        global $conn;
        $sql = "SELECT SUM(reduction) as reduction FROM vente WHERE datevente= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["reduction"]; 
    }

    public function getSommeReductionDate($date) {
        global $conn;
        $sql = "SELECT SUM(reduction) as reduction FROM vente WHERE datevente= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["reduction"]; 
    }

    public function getSommeProduit() {
        global $conn;
        $this->data =[];
        $sql = "SELECT  nomproduit,SUM(quantite) as quantite,datefacture FROM facture WHERE `datefacture`= CURRENT_DATE GROUP BY nomproduit";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }

    public function getSommeProduitDate($date) {
        global $conn;
        $this->data =[];
        $sql = "SELECT  nomproduit,SUM(quantite) as quantite,datefacture FROM facture WHERE `datefacture`= '$date' GROUP BY nomproduit";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }

    public function getAllVente(){
        global $conn;

        $sql = "SELECT id,typevente,numfacture,quantite,prix,datevente FROM vente ";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data;
    }

    public function getFactureVente($idfacutre){
        global $conn;
            $valdata = [];
            $montant = 0;
            $quantite = 0;
            $prix = 0;

            $sqlfacture = "SELECT nomproduit,quantite,prix,montant,Typepaiement,datefacture FROM facture WHERE  idvente = '$idfacutre'";
            $resultfa = $conn->query($sqlfacture); 
            while ($rowfacture = mysqli_fetch_assoc($resultfa)) {
                array_push($valdata,$rowfacture);
                $montant+=$rowfacture["montant"];
                $quantite+=$rowfacture["quantite"];
                $prix+=$rowfacture["prix"];
            }
            $tab = ["Total",$quantite,$prix,$montant,"-","-"];
            array_push($valdata,$tab);
        return $valdata;
    }
}





?>