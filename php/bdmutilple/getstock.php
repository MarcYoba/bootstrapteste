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

    public function getLogsDate($date){
        global $conn;
        // $jour = date("d");
        // $mois = date("m");
        // $jour_moi_anne = new DateTime("$date-$mois-$jour");
        // $datejour = $jour_moi_anne->format("Y-m-d");
        $data = [];
        $sql = "SELECT
            hs.Nomproduit,
            hs.quantite AS quantite_stock,
            p.quantite_produit,p.stock_start_produit,
            (SELECT SUM(a2.quantite) FROM achat a2 WHERE a2.idproduit = hs.idproduit AND YEAR(a2.dateachat) = YEAR(CURDATE()) AND 					MONTH(a2.dateachat) = MONTH(CURDATE())) AS quantite_achetee,
            (SELECT SUM(f2.quantite) FROM facture f2 WHERE f2.idproduit = hs.idproduit AND YEAR(f2.datefacture) = YEAR(CURDATE()) AND 				MONTH(f2.datefacture) = MONTH(CURDATE())) AS somme_facture,
            (SELECT SUM(f.quantite) FROM facture f WHERE f.idproduit = hs.idproduit AND  f.datefacture = CURRENT_DATE) AS quantite_facturee
            FROM
                historiquestock hs
            LEFT JOIN produit p ON p.id = hs.idproduit
            WHERE YEAR(hs.datet) = '$date'
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

    public function VariationStok(){
        global $conn;
        // Créer une date pour le 1er janvier de l'année en cours :
        $date = new DateTime('first day of january this year');
        $janvier =  $date->format('Y-m-d');

        // Créer une date pour le 1er janvier de l'année précédente :
        // $date = new DateTime('first day of january last year');
        // echo $date->format('Y-m-d');

        $sql = "SELECT (p.prix_produit_vente * hs.quantite) AS Produibultiple
                FROM historiquestock hs 
                INNER JOIN produit p ON p.id = hs.idproduit
                WHERE hs.datet = '$janvier'";
            $result = $conn->query($sql);
            $Stockdebut = mysqli_fetch_assoc($result);

            $sql = "SELECT (p.prix_produit_vente * p.quantite_produit) AS Produibultiple FROM produit p";
            $result = $conn->query($sql);
            $Stockfin = mysqli_fetch_assoc($result); 
            $retVal = (!is_array($Stockdebut)) ? 0 : array_sum($Stockdebut);
            $total = array_sum($Stockfin) - $retVal;
            return $total;
    }

    public function VariationStokfourniture(){
        global $conn;
        // Créer une date pour le 1er janvier de l'année en cours :
        $date = new DateTime('first day of january this year');
        $janvier =  $date->format('Y-m-d');

        // Créer une date pour le 1er janvier de l'année précédente :
        // $date = new DateTime('first day of january last year');
        // echo $date->format('Y-m-d');

        $sql = "SELECT SUM(hs.quantite) AS Produibultiple
                FROM historiquestock hs 
                WHERE hs.datet = '$janvier'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            $Stockdebut = $row["Produibultiple"];

            if (empty($Stockdebut)) {
                $Stockdebut=0;
            }

            $sql = "SELECT SUM(quantite_produit) AS Produibultiple FROM produit";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result); 
            $Stockfin = $row["Produibultiple"];

            if (empty($Stockfin)) {
                $Stockfin = 0;
            }
            $Stockfin -= $Stockdebut;
            return  $Stockfin;
    }

    public function VariationStokfournitureExercice(){
        global $conn;
        // Créer une date pour le 1er janvier de l'année en cours :
        $date = new DateTime('first day of january this year');
        $janvier =  $date->format('Y-m-d');

        // Créer une date pour le 1er janvier de l'année précédente :
         $date = new DateTime('first day of january last year');
         $janvierdernier =  $date->format('Y-m-d');

        $sql = "SELECT SUM(hs.quantite) AS Produibultiple
                FROM historiquestock hs 
                WHERE hs.datet = '$janvierdernier'";
            $result = $conn->query($sql);
            $Stockdebut = mysqli_fetch_assoc($result);
        
        $date = new DateTime('last day of december last year');
            $janvierdernier =  $date->format('Y-m-d');

            $sql = "SELECT SUM(hs.quantite) AS Produibultiple
                FROM historiquestock hs 
                WHERE hs.datet = '$janvierdernier'";
            $result = $conn->query($sql);
            $Stockfin = mysqli_fetch_assoc($result); 
            return $Stockfin["Produibultiple"]-$Stockdebut["Produibultiple"];
    }

    public function getQuantiteEnStock($annee) {
        global $conn;
        $total = 0;
        $date_debut = $annee . "-01-02";
        $sql = "SELECT nom_produit,id  FROM produit ";
        $result = $conn->query($sql);

        while ($row = mysqli_fetch_assoc($result)){
            $id = $row["id"];
            $sql2 = "SELECT quantite FROM historiquestock WHERE datet = '$date_debut' AND idproduit = '$id'";
            $result2 = $conn->query($sql2);
            $historique = mysqli_fetch_assoc($result2);
                if (empty($historique)) {
                    $historique = 0;
                } else {
                    $historique = $historique["quantite"];
                }
            $sql3 = "SELECT ROUND(SUM(quantite), 2) as total FROM achat WHERE  idproduit  = '$id' AND YEAR(dateachat) = '$annee'";
            $result3 = $conn->query($sql3);
            $achat = mysqli_fetch_assoc($result3);
                if (empty($achat)) {
                    $achat = 0;
                } else {
                    $achat = $achat["total"];
                }
            $sql3 = "SELECT ROUND(SUM(quantite), 2) as total FROM facture WHERE  idproduit  = '$id' AND YEAR(datefacture) = '$annee'";
            $result3 = $conn->query($sql3);
            $facture = mysqli_fetch_assoc($result3);

                if (empty($facture)) {
                    $facture = 0;
                } else {
                    $facture = $facture["total"];
                }
                $total += $historique + $achat - $facture;
        }

        return $total;
    } 

    public function getQuantiteEnStockAnnePasse($annee) {
        global $conn;
        $total = 0;
        $annee -=1;
        $date_debut = $annee . "-01-02";
        $sql = "SELECT nom_produit,id  FROM produit ";
        $result = $conn->query($sql);

        while ($row = mysqli_fetch_assoc($result)){
            $id = $row["id"];
            $sql2 = "SELECT quantite FROM historiquestock WHERE datet = '$date_debut' AND idproduit = '$id'";
            $result2 = $conn->query($sql2);
            $historique = mysqli_fetch_assoc($result2);
                if (empty($historique)) {
                    $historique = 0;
                } else {
                    $historique = $historique["quantite"];
                }
            $sql3 = "SELECT ROUND(SUM(quantite), 2) as total FROM achat WHERE  idproduit  = '$id' AND YEAR(dateachat) = '$annee'";
            $result3 = $conn->query($sql3);
            $achat = mysqli_fetch_assoc($result3);
                if (empty($achat)) {
                    $achat = 0;
                } else {
                    $achat = $achat["total"];
                }
            $sql3 = "SELECT ROUND(SUM(quantite), 2) as total FROM facture WHERE  idproduit  = '$id' AND YEAR(datefacture) = '$annee'";
            $result3 = $conn->query($sql3);
            $facture = mysqli_fetch_assoc($result3);

                if (empty($facture)) {
                    $facture = 0;
                } else {
                    $facture = $facture["total"];
                }
                $total += $historique + $achat - $facture;
        }

        return $total;
    }

    public function getValeurStock($annee) {
        global $conn;
        $total = 0;
        $date_debut = $annee . "-01-02";
        $sql = "SELECT nom_produit,id  FROM produit ";
        $result = $conn->query($sql);
                                        
            while ($row = mysqli_fetch_assoc($result)){
                $id = $row["id"];
                $sql2 = "SELECT quantite FROM historiquestock WHERE datet = '$date_debut' AND idproduit = '$id'";
                $result2 = $conn->query($sql2);
                $historique = mysqli_fetch_assoc($result2);

                    if (empty($historique)) {
                        $historique = 0;
                    } else {
                        $historique = $historique["quantite"];
                    }

                    $sql3 = "SELECT ROUND(SUM(quantite), 2) as total FROM achat WHERE  idproduit  = '$id' AND YEAR(dateachat) = '$annee'";
                    $result3 = $conn->query($sql3);
                    $achat = mysqli_fetch_assoc($result3);

                    if (empty($achat)) {
                        $achat = 0;
                    } else {
                        $achat = $achat["total"];
                    }

                    $sql3 = "SELECT ROUND(SUM(quantite), 2) as total FROM facture WHERE  idproduit  = '$id' AND YEAR(datefacture) = '$annee'";
                    $result3 = $conn->query($sql3);
                    $facture = mysqli_fetch_assoc($result3);

                    if (empty($facture)) {
                        $facture = 0;
                    } else {
                        $facture = $facture["total"];
                    }
                    $sql4 = "SELECT ROUND(SUM(quantite),2) as quantite,ROUND(SUM(montant),2) as montant,Nomproduit  FROM achat WHERE YEAR(dateachat) = '$annee' AND idproduit = '$id'";
                    $result4 = $conn->query($sql4);
                    $prix_achat = mysqli_fetch_assoc($result4);

                    if (empty($prix_achat)) {
                        $prix_achat = 0;
                    } else {
                        if ($prix_achat["quantite"] == 0) {
                            $prix_achat["quantite"]  = 1;
                        } 
                        if ($prix_achat["montant"] == 0) {
                            $prix_achat["montant"] = 0;
                        } 
                    $prix_achat = $prix_achat["montant"]/ $prix_achat["quantite"];
                    }
                $total += (($historique + $achat - $facture) * $prix_achat);
            }
        return $total;
    }

    public function getValeurStockAnnePasse($annee) {
        global $conn;
        $total = 0;
        $annee -=1;
        $date_debut = $annee . "-01-02";
        $sql = "SELECT nom_produit,id  FROM produit ";
        $result = $conn->query($sql);
                                        
            while ($row = mysqli_fetch_assoc($result)){
                $id = $row["id"];
                $sql2 = "SELECT quantite FROM historiquestock WHERE datet = '$date_debut' AND idproduit = '$id'";
                $result2 = $conn->query($sql2);
                $historique = mysqli_fetch_assoc($result2);

                    if (empty($historique)) {
                        $historique = 0;
                    } else {
                        $historique = $historique["quantite"];
                    }

                    $sql3 = "SELECT ROUND(SUM(quantite), 2) as total FROM achat WHERE  idproduit  = '$id' AND YEAR(dateachat) = '$annee'";
                    $result3 = $conn->query($sql3);
                    $achat = mysqli_fetch_assoc($result3);

                    if (empty($achat)) {
                        $achat = 0;
                    } else {
                        $achat = $achat["total"];
                    }

                    $sql3 = "SELECT ROUND(SUM(quantite), 2) as total FROM facture WHERE  idproduit  = '$id' AND YEAR(datefacture) = '$annee'";
                    $result3 = $conn->query($sql3);
                    $facture = mysqli_fetch_assoc($result3);

                    if (empty($facture)) {
                        $facture = 0;
                    } else {
                        $facture = $facture["total"];
                    }
                    $sql4 = "SELECT ROUND(SUM(quantite),2) as quantite,ROUND(SUM(montant),2) as montant,Nomproduit  FROM achat WHERE YEAR(dateachat) = '$annee' AND idproduit = '$id'";
                    $result4 = $conn->query($sql4);
                    $prix_achat = mysqli_fetch_assoc($result4);

                    if (empty($prix_achat)) {
                        $prix_achat = 0;
                    } else {
                        if ($prix_achat["quantite"] == 0) {
                            $prix_achat["quantite"]  = 1;
                        } 
                        if ($prix_achat["montant"] == 0) {
                            $prix_achat["montant"] = 0;
                        } 
                    $prix_achat = $prix_achat["montant"]/ $prix_achat["quantite"];
                    }
                $total += (($historique + $achat - $facture) * $prix_achat);
            }
        return $total;
    }

}




?>