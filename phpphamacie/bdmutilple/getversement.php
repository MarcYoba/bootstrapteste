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
        $sql = "SELECT SUM(montant) as montant FROM versementphamacie WHERE dateversement= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function TotalVersement(){
        global $conn;
        // $anne = date("Y");
        // $jour = date("d");
        // $mois = date("m");
        // $anne_jour = new DateTime($anne."-".$mois."-".$jour);
        // $anne_jour = $anne_jour->format('Y-m-d');
        $sql = "SELECT SUM(montant + Om + banque) as montant FROM versementphamacie WHERE YEAR(dateversement) = YEAR(CURRENT_DATE)";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function AllVersementYear(){
        global $conn;
        $data = [];
        $anne = date("Y");
        $sql = "SELECT * FROM versementphamacie WHERE YEAR(dateversement)= '$anne'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }

        return $data; 
    }

    public function ByVersementdate($date){
        global $conn;
        $data = [];
        $sql = "SELECT  SUM(montant + Om + banque) as montant, dateversement, idclient FROM versementphamacie WHERE  dateversement= '$date'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
        return $data; 
    }

    public function ByWeekVersementClient($datebedut,$datafin,$idclient){
        global $conn;
        $data = [];
        $sql = "SELECT dateversement, idclient, SUM(montant + Om + banque) as montant FROM versementphamacie WHERE dateversement BETWEEN '$datebedut'  AND '$datafin' AND idclient='$idclient' GROUP BY dateversement ORDER BY dateversement ";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
        return $data; 
    }

    public function SommeWeekVersementClient($datebedut,$datafin,$idclient){
        global $conn;
        $data = [];
        $sql = "SELECT SUM(montant + Om + banque) as montant FROM versementphamacie WHERE dateversement BETWEEN '$datebedut'  AND '$datafin' AND idclient='$idclient'";
        $result = $conn->query($sql);
       $row = mysqli_fetch_assoc($result);
        
        return $row["montant"]; 
    }

    public function ByDateVersement($date){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM versementphamacie WHERE dateversement= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ByVersementClient($dette){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM versementphamacie ";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function ByWeekVersement($datebedut,$datafin){
        global $conn;
        $sql = "SELECT SUM(montant + Om + banque) as prix FROM versementphamacie WHERE dateversement BETWEEN '$datebedut'  AND '$datafin'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["prix"]; 
    }

    public function ByDateVersementOm($date){
        global $conn;
        $sql = "SELECT SUM(Om) as Om FROM versementphamacie WHERE dateversement= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["Om"]; 
    }

    public function ByWeekVersementOm($datedebut,$datefin){
        global $conn;
        $sql = "SELECT SUM(Om) as Om FROM versementphamacie WHERE dateversement BETWEEN '$datedebut'  AND '$datefin'";
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

        $sql = "SELECT * FROM versementphamacie WHERE dateversement= CURRENT_DATE";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }

        return $data; 
    }

    public function AllVersementDate(){
        global $conn;
        $data = [];

        $sql = "SELECT * FROM versementphamacie WHERE dateversement= '$this->dateversement'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }

        return $data; 
    }

    public function AllVersementWeek($datebedut,$detefin){
        global $conn;
        $data = [];

        $sql = "SELECT * FROM versementphamacie WHERE dateversement BETWEEN '$datebedut'  AND '$detefin'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }

        return $data; 
    }

    public function VersementMensuel($idmois,$date){
        global $conn;
        $data = [];

        // $sql = "SELECT dateversement, 
        //     GROUP_CONCAT(montant,',') AS listMontant,
        //     ROUND(SUM(montant)) AS nomtant,
        //     GROUP_CONCAT(motif,',') AS motif 
        //     FROM versementphamacie
        //     WHERE Month(dateversement) = '$idmois'
        //     GROUP BY dateversement";
        // $result = $conn->query($sql);
        // while($row = mysqli_fetch_assoc($result)){
        //     array_push($data,$row);
        // }

        $sql = "SELECT dateversement, 
            GROUP_CONCAT(montant,',') AS listMontant,
            ROUND(SUM(montant)) AS nomtant,
            GROUP_CONCAT(motif,',') AS motif 
            FROM versementphamacie
            WHERE Month(dateversement) = '$idmois' AND YEAR(dateversement) = YEAR('$date')
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

    public function ByVersementIdClientDate($idclient,$date){
        global $conn;
        $sql = "SELECT SUM(montant + Om + banque) as montant FROM versementphamacie WHERE idclient = '$idclient' AND dateversement= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function getVersementByClientBydate($date,$client){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM versementphamacie WHERE dateversement = '$date' AND idclient ='$client'";
        $result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function ByVersementClientdate($date){
        global $conn;
        $sql = "SELECT SUM(montant + Om + banque) as montant FROM versementphamacie WHERE  dateversement= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function getFacture($idfacture){
        global $conn;
        $sql = "SELECT * FROM versementphamacie WHERE id ='$idfacture'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row; 
    }

    public function VersementTrimesttre($anne)
    {
        global $conn;
        $data =[];
        $sql = "SELECT QUARTER(dateversement) AS trimestre, ROUND(SUM(montant),2) AS nombre_enregistrements 
        FROM versementphamacie 
        WHERE YEAR(dateversement) = $anne
        GROUP BY QUARTER(dateversement)";

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function VersementSemesttre($anne)
    {
        global $conn;
        $data =[];
        $sql = "SELECT 
        CEILING(MONTH(dateversement) / 6) AS semestre,
        ROUND(SUM(montant),2) AS montant
        FROM 
            versementphamacie
        WHERE YEAR(dateversement) = $anne
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