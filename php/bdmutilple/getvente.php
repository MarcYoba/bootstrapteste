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
        $sql = "SELECT id,iduser,heure,aliment FROM vente WHERE datevente= CURRENT_DATE";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function SommeVente(){
        global $conn;
        $sql = "SELECT ROUND(SUM(prix),2) as montant FROM vente WHERE YEAR(datevente)= YEAR(CURRENT_DATE)";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeVenteAnne($anne){
        global $conn;
        $sql = "SELECT ROUND(SUM(prix),2) as montant FROM vente WHERE YEAR(datevente)= '$anne'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeVenteAnnePasse(){
        global $conn;
        $anne = date("Y");
        $anne = $anne-1;
        $sql = "SELECT ROUND(SUM(prix),2) as montant FROM vente WHERE YEAR(datevente)= '$anne'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function getIdVenteByDate($date) {
        global $conn;
        $this->data = [];
        $sql = "SELECT id,iduser,heure,aliment FROM vente WHERE datevente= '$date'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function getIdVenteByTypeCash($date) {
        global $conn;
        $this->data = [];
        $sql = "SELECT id FROM vente WHERE datevente= '$date' AND cash <> '0'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function getIdVenteByTypeCashIntervel($date,$date2) {
        global $conn;
        $this->data = [];
        $sql = "SELECT id FROM vente WHERE datevente BETWEEN '$date' AND '$date2' AND cash <> '0'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function getIdVenteByTypeOM($date) {
        global $conn;
        $this->data = [];
        $sql = "SELECT id FROM vente WHERE datevente= '$date' AND Om <> '0'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function getIdVenteByTypeOMIterval($date,$datesecond) {
        global $conn;
        $this->data = [];
        $sql = "SELECT id FROM vente WHERE datevente BETWEEN '$date' AND '$datesecond' AND Om <> '0'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function getIdVenteByTypeCredit($date) {
        global $conn;
        $this->data = [];
        $sql = "SELECT id FROM vente WHERE datevente= '$date' AND credit <> '0'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function getIdVenteByTypeCreditInterval($date,$datesecond) {
        global $conn;
        $this->data = [];
        $sql = "SELECT id FROM vente WHERE datevente BETWEEN  '$date' AND '$datesecond' AND credit <> '0'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function getIdVenteByTypeCreditOM($date) {
        global $conn;
        $this->data = [];
        $sql = "SELECT id FROM vente WHERE datevente= '$date' AND cash = '0'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function getIdVenteByTypeCreditOMInterval($date,$date2) {
        global $conn;
        $this->data = [];
        $sql = "SELECT id FROM vente WHERE  cash = '0' AND datevente BETWEEN  '$date' AND '$date2'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            //$id = $row["id"];
            array_push($this->data,$row);    
        }
        return $this->data; 
    }

    public function getIdVenteByWeek($datedebut ,$datefin) {
        global $conn;
        $this->data = [];
        $sql = "SELECT id,iduser,heure,aliment FROM vente WHERE datevente BETWEEN '$datedebut' AND '$datefin'";
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
        $sql = "SELECT SUM(prix) as montant FROM vente WHERE datevente= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function getSommeVenteWeek($datedebut, $datefin) {
        global $conn;
        $sql = "SELECT SUM(prix) as montant FROM vente WHERE datevente BETWEEN '$datedebut' AND  '$datefin' ";
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

    public function getSommeTotalCaisse() {
        global $conn;
        $sql = "SELECT SUM(cash) as cash FROM vente WHERE datevente BETWEEN '2024-12-01' AND CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);

        $totalCash = $row["cash"];

        $sql = "SELECT SUM(montant) as montant FROM caisse WHERE operation ='sortie en caisse' and dateoperation BETWEEN '2024-12-01' AND CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $totalSorti =  $row["montant"];
        
        $sql = "SELECT SUM(montant) as montant FROM `caisse` WHERE operation ='retour en caisse' and dateoperation BETWEEN '2024-12-01' AND CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $totalRetou=  $row["montant"]; 

        $sql = "SELECT SUM(banque) as montnat FROM vente WHERE datevente BETWEEN '2024-12-01' AND CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $totalBanque= $row["montnat"]; 

        return ($totalCash+$totalBanque+$totalRetou)+$totalSorti; 
    }

    public function getSommeCashDate($date) {
        global $conn;
        $sql = "SELECT SUM(cash) as cash FROM vente WHERE datevente= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["cash"]; 
    }

    public function getSommeCashWeek($datedebut,$datefin) {
        global $conn;
        $sql = "SELECT SUM(cash) as cash FROM vente WHERE datevente BETWEEN '$datedebut'  AND '$datefin'";
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

    public function getSommeCreditCaisse() {
        global $conn;
        $sql = "SELECT SUM(credit) as credit FROM vente WHERE datevente BETWEEN '2024-12-01' AND CURRENT_DATE";
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

    public function getSommeCreditWeek($datedebut,$datefin) {
        global $conn;
        $sql = "SELECT SUM(credit) as credit FROM vente WHERE datevente BETWEEN '$datedebut' AND '$datefin'";
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

    public function SommeOmMensuel($date) {
        global $conn;
        $sql = "SELECT SUM(Om) as Om FROM vente WHERE MONTH(datevente)= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["Om"]; 
    }

    public function getSommeOmWeek($datedebut,$datefin) {
        global $conn;
        $sql = "SELECT SUM(Om) as Om FROM vente WHERE datevente BETWEEN '$datedebut' AND '$datefin'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["Om"]; 
    }

    public function getSommeBanque() {
        global $conn;
        $sql = "SELECT SUM(banque) as montnat FROM vente WHERE datevente= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montnat"]; 
    }
    public function getSommeBanqueDate($date) {
        global $conn;
        $sql = "SELECT SUM(banque) as banque FROM vente WHERE datevente= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["banque"]; 
    }
    public function getSommeBanqueWeek($datedebut,$datefin) {
        global $conn;
        $sql = "SELECT SUM(banque) as banque FROM vente WHERE datevente BETWEEN '$datedebut' AND '$datefin'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["banque"]; 
    }
    public function SommeBanqueMensuel($date) {
        global $conn;
        $sql = "SELECT SUM(banque) as banque FROM vente WHERE MONTH(datevente)= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["banque"]; 
    }

    public function SommeReduction() {
        global $conn;
        $sql = "SELECT SUM(reduction) as reduction FROM vente WHERE YEAR(datevente)= YEAR(CURRENT_DATE)";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["reduction"]; 
    }

    public function SommeReductionAnne($date) {
        global $conn;
        $sql = "SELECT SUM(reduction) as reduction FROM vente WHERE YEAR(datevente)= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["reduction"]; 
    }


    public function getSommeReduction() {
        global $conn;
        $sql = "SELECT SUM(reduction) as reduction FROM vente WHERE datevente= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["reduction"]; 
    }
    public function getReductionForVente($idvente) {
        global $conn;
        $sql = "SELECT reduction as reduction FROM vente WHERE id= '$idvente'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["reduction"]; 
    }

    public function getTypePaiement($idvente) {
        global $conn;
        $sql = "SELECT typevente FROM vente WHERE id= '$idvente'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["typevente"]; 
    }

    public function getSommeReductionDate($date) {
        global $conn;
        $sql = "SELECT SUM(reduction) as reduction FROM vente WHERE datevente= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["reduction"]; 
    }

    public function getSommeReductionWeek($datedebut,$datefin) {
        global $conn;
        $sql = "SELECT SUM(reduction) as reduction FROM vente WHERE datevente BETWEEN '$datedebut' AND '$datefin'";
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

    public function getSommeProduitDateProduit($date,$produit) {
        global $conn;
        $this->data =[];
        $sql = "SELECT  nomproduit,SUM(quantite) as quantite,datefacture FROM facture WHERE nomproduit='$produit' AND `datefacture`= '$date' GROUP BY nomproduit";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }

    public function getSommeProduitDateClient($date,$client) {
        global $conn;
        $this->data =[];
        $sql = "SELECT  nomproduit,SUM(quantite) as quantite,datefacture FROM facture WHERE idclient='$client' AND `datefacture`= '$date' GROUP BY nomproduit";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }

    public function getSommeProduitDateClientProduit($date,$client,$produit) {
        global $conn;
        $this->data =[];
        $sql = "SELECT  nomproduit,SUM(quantite) as quantite,datefacture FROM facture WHERE nomproduit='$produit' AND idclient='$client' AND `datefacture`= '$date' GROUP BY nomproduit";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }

    public function getSommeProduitWeek($datedebut,$datefin) {
        global $conn;
        $this->data =[];
        $sql = "SELECT  nomproduit,SUM(quantite) as quantite,datefacture FROM facture WHERE `datefacture` BETWEEN '$datedebut' AND '$datefin' GROUP BY nomproduit";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }

    public function getSommeProduitWeekProduit($datedebut,$datefin,$produit) {
        global $conn;
        $this->data =[];
        $sql = "SELECT  nomproduit,SUM(quantite) as quantite,datefacture FROM facture WHERE nomproduit='$produit' AND  `datefacture` BETWEEN '$datedebut' AND '$datefin' GROUP BY nomproduit";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }

    public function getSommeProduitWeekClient($datedebut,$datefin,$client) {
        global $conn;
        $this->data =[];
        $sql = "SELECT  nomproduit,SUM(quantite) as quantite,datefacture FROM facture WHERE idclient='$client' AND  `datefacture` BETWEEN '$datedebut' AND '$datefin' GROUP BY nomproduit";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }

    public function getSommeProduitWeekClientProduit($datedebut,$datefin,$client,$produit) {
        global $conn;
        $this->data =[];
        $sql = "SELECT  nomproduit,SUM(quantite) as quantite,datefacture FROM facture WHERE idclient='$client' AND  nomproduit='$produit' AND `datefacture` BETWEEN '$datedebut' AND '$datefin' GROUP BY nomproduit";
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

    public function getFactureVentePrint($idfacutre){
        global $conn;
            $valdata = [];
            $montant = 0;
            $quantite = 0;
            $prix = 0;

            $sqlfacture = "SELECT nomproduit,quantite,prix,montant FROM facture WHERE  idvente = '$idfacutre'";
            $resultfa = $conn->query($sqlfacture); 
            while ($rowfacture = mysqli_fetch_assoc($resultfa)) {
                array_push($valdata,$rowfacture);
                $montant+=$rowfacture["montant"];
                $quantite+=$rowfacture["quantite"];
                $prix+=$rowfacture["prix"];
            }
            $tab = ["Total",$quantite,"KG"];
            $tabr = ["Reduction",$this->getReductionForVente($idfacutre)];
            $tabn = ["Net a payer",(($montant)-($this->getReductionForVente($idfacutre))),"FCFA",$this->getTypePaiement($idfacutre)];
            array_push($valdata,$tab);
            array_push($valdata,$tabr);
            array_push($valdata,$tabn);
        return $valdata;
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
            $tabr = ["Reduction","-","-",$this->getReductionForVente($idfacutre),"-","-"];
            $tabn = ["Net a payer","-","-",(($montant)-($this->getReductionForVente($idfacutre))),"FCFA",$this->getTypePaiement($idfacutre)];
            array_push($valdata,$tab);
            array_push($valdata,$tabr);
            array_push($valdata,$tabn);
        return $valdata;
    }

    public function getFactureVenteTrie($idfacutre){
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
            $tabr = ["Reduction","-","-",$this->getReductionForVente($idfacutre),"-","-"];
            $tabn = ["Net a payer","-","-",$montant-$this->getReductionForVente($idfacutre),"-","-"];
            array_push($valdata,$tab);
            array_push($valdata,$tabr);
            array_push($valdata,$tabn);
        return $valdata;
    }

    public function getFactureVenteProduit($idfacutre,$nom){
        global $conn;
            $valdata = [];
            $montant = 0;
            $quantite = 0;
            $prix = 0;

            $sqlfacture = "SELECT nomproduit,quantite,prix,montant,Typepaiement,datefacture FROM facture WHERE  idvente = '$idfacutre' AND nomproduit='$nom'";
            $resultfa = $conn->query($sqlfacture); 
            while ($rowfacture = mysqli_fetch_assoc($resultfa)) {
                
                    array_push($valdata,$rowfacture);
                    $montant+=$rowfacture["montant"];
                    $quantite+=$rowfacture["quantite"];
                    $prix+=$rowfacture["prix"];
                
                
            }
            $tab = ["Total",$quantite,$prix,$montant,"-","-"];
            $tabr = ["Reduction","-","-",$this->getReductionForVente($idfacutre),"-","-"];
            $tabn = ["Net a payer","-","-",$montant-$this->getReductionForVente($idfacutre),"-","-"];
            array_push($valdata,$tab);
            array_push($valdata,$tabr);
            array_push($valdata,$tabn);
            if ($montant ==0) {
                $valdata = [];
                array_push($valdata);
                return $valdata ;
            } else {
                return $valdata;
            }    
    }

    public function getFactureVenteClient($idfacutre,$idclient){
        global $conn;
            $valdata = [];
            $montant = 0;
            $quantite = 0;
            $prix = 0;

            $sqlfacture = "SELECT nomproduit,quantite,prix,montant,Typepaiement,datefacture FROM facture WHERE  idvente = '$idfacutre' AND idclient ='$idclient'";
            $resultfa = $conn->query($sqlfacture); 
            while ($rowfacture = mysqli_fetch_assoc($resultfa)) {
                
                    array_push($valdata,$rowfacture);
                    $montant+=$rowfacture["montant"];
                    $quantite+=$rowfacture["quantite"];
                    $prix+=$rowfacture["prix"];
                
                
            }
            $tab = ["Total",$quantite,$prix,$montant,"-","-"];
            $tabr = ["Reduction","-","-",$this->getReductionForVente($idfacutre),"-","-"];
            $tabn = ["Net a payer","-","-",$montant-$this->getReductionForVente($idfacutre),"-","-"];
            array_push($valdata,$tab);
            array_push($valdata,$tabr);
            array_push($valdata,$tabn);
            if ($montant ==0) {
                $valdata = [];
                array_push($valdata);
                return $valdata ;
            } else {
                return $valdata;
            }    
    }

    public function getFactureVenteClientProduit($idfacutre,$idclient,$produit){
        global $conn;
            $valdata = [];
            $montant = 0;
            $quantite = 0;
            $prix = 0;

            $sqlfacture = "SELECT nomproduit,quantite,prix,montant,Typepaiement,datefacture FROM facture WHERE  idvente = '$idfacutre' AND idclient ='$idclient' AND nomproduit='$produit'";
            $resultfa = $conn->query($sqlfacture); 
            while ($rowfacture = mysqli_fetch_assoc($resultfa)) {
                
                    array_push($valdata,$rowfacture);
                    $montant+=$rowfacture["montant"];
                    $quantite+=$rowfacture["quantite"];
                    $prix+=$rowfacture["prix"];
                
                
            }
            $tab = ["Total",$quantite,$prix,$montant,"-","-"];
            $tabr = ["Reduction","-","-",$this->getReductionForVente($idfacutre),"-","-"];
            $tabn = ["Net a payer","-","-",$montant-$this->getReductionForVente($idfacutre),"-","-"];
            array_push($valdata,$tab);
            array_push($valdata,$tabr);
            array_push($valdata,$tabn);
            if ($montant ==0) {
                $valdata = [];
                array_push($valdata);
                return $valdata ;
            } else {
                return $valdata;
            }    
    }


    public function UPDATEClient($idclient,$idvente){
        global $conn;

        $sql = "UPDATE vente SET idclient ='$idclient' WHERE id = '$idvente'";
        $result = $conn->query($sql);
        if ($result==true) {
            $sql = "UPDATE facture SET idclient ='$idclient' WHERE idvente = '$idvente'";
            $result = $conn->query($sql);

            if ($result==true) {
                $sql = "SELECT * FROM dette WHERE idvente = '$idvente'";
                $result = $conn->query($sql);
                if ($result->num_rows>0) {
                    $sql = "UPDATE dette SET idclient ='$idclient' WHERE idvente = '$idvente'";
                    $result = $conn->query($sql);
                    if ($result == true) {
                        header("Location:liste.php");
                    }
                }else{
                    header("Location:liste.php");
                }  
            }
        }
    }

    public function SommeAnnuel($idmois,$date) {
        global $conn;
        $don=[];
        // $sql = "SELECT datevente,
        //             ROUND(SUM(quantite),2) AS quantite , 
        //             ROUND(SUM(prix),2) AS montant, 
        //             ROUND(SUM(cash),2) AS MontantCash, 
        //             ROUND(SUM(credit),2) AS dette, 
        //             ROUND(SUM(Om),2) AS OM, 
        //             ROUND(SUM(reduction),2) AS reduction  
        //         FROM vente 
        //         WHERE month(datevente) = '$idmois' AND YEAR(datevente) = YEAR(CURRENT_DATE)
        //         GROUP BY datevente";
        // $result = $conn->query($sql);
        // while ($row = mysqli_fetch_assoc($result)){
        //     //$id = $row["id"];
        //     array_push($don,$row);    
        // }
        $sql = "SELECT datevente as TOTAL,
                    ROUND(SUM(quantite),2) AS quantite , 
                    ROUND(SUM(prix),2) AS montant, 
                    ROUND(SUM(cash),2) AS MontantCash, 
                    ROUND(SUM(credit),2) AS dette, 
                    ROUND(SUM(Om),2) AS OM, 
                    ROUND(SUM(reduction),2) AS reduction,
                    ROUND(SUM(banque),2) AS banque  
                FROM vente 
                WHERE month(datevente) = '$idmois' AND YEAR(datevente) = YEAR('$date')
                ";
                
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            $row["TOTAL"] = "TOTAL";
            array_push($don,$row);    
        }
        return $don; 
    }

    public function VenteTemesttre($anne)
    {
        global $conn;
        $this->data =[];
        $sql = "SELECT QUARTER(datevente) AS trimestre, ROUND(SUM(prix),2) AS nombre_enregistrements 
        FROM vente
        WHERE YEAR(datevente) = $anne 
        GROUP BY QUARTER(datevente);";

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }

    public function VenteSemesttre($anne)
    {
        global $conn;
        $this->data =[];
        $sql = "SELECT 
        CEILING(MONTH(datevente) / 6) AS semestre,
        ROUND(SUM(prix),2) AS montant
        FROM 
            vente
        WHERE YEAR(datevente) = $anne 
        GROUP BY 
            semestre";

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }
    public function VenteAnnuelle($anne)
    {
        global $conn;
        $this->data =[];
        $sql = "SELECT 
        MONTH(datevente) AS Mois,
        YEAR(datevente) AS Annee,
        ROUND(SUM(prix), 2) AS Total_Ventes
            FROM 
                vente
            WHERE YEAR(datevente) = '$anne'
            GROUP BY 
                YEAR(datevente), MONTH(datevente)
            ORDER BY 
        YEAR(datevente), MONTH(datevente)";

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }

    public function VenteAnnuelleSemain($anne)
    {
        global $conn;
        $this->data =[];
        $sql = "SELECT 
            YEAR(datevente) AS Annee,
            WEEK(datevente) AS Semaine,
            ROUND(SUM(prix), 2) AS Total_Ventes
        FROM 
            vente
        WHERE YEAR(datevente) = '2024'
        GROUP BY 
            YEAR(datevente), WEEK(datevente)
        ORDER BY 
            YEAR(datevente), WEEK(datevente)";

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($this->data,$row);
        }
        return $this->data; 
    }
}




?>