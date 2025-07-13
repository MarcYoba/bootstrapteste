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

    public function SommeDepenseExercice(){
        global $conn;
        $anne = date("Y");
        $anne = $anne - 1;
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = $anne";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeDepenseAchat($anne){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = '$anne' AND cathegorie='Autres achats'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeDepenseExerciceAchat($anne){
        global $conn;
        if ($anne == null) {
            $anne = date("Y");
        }
        $anne = $anne - 1;
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = $anne AND cathegorie='Autres achats'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }


    public function SommeDepenseVoyages($anne){
        global $conn;
        if ($anne == null) {
            $anne = date("Y");
        }
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = $anne AND cathegorie='Voyages'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeDepenseExerciceVoyages($anne){
        global $conn;
        if ($anne == null) {
            $anne = date("Y");
        }
        $anne = $anne - 1;
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = $anne AND cathegorie='Voyages'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }


    public function DepenseMensuelle($mois,$date){
        global $conn;
        $data = [];
        // $sql = "SELECT datedepense, 
        //     GROUP_CONCAT(montant,',') AS listMontant,
        //     ROUND(SUM(montant)) AS nomtant,
        //     GROUP_CONCAT(description,',') AS motif 
        //     FROM depensesphamacie
        //     WHERE Month(datedepense) = '$mois'
        //     GROUP BY datedepense";
        // $result = $conn->query($sql);
        // while ($row = mysqli_fetch_assoc($result)) {
        //     array_push($data,$row);
        // }

        $sql = "SELECT datedepense, 
            GROUP_CONCAT(montant,',') AS listMontant,
            ROUND(SUM(montant)) AS nomtant,
            GROUP_CONCAT(description,',') AS motif 
            FROM depensesphamacie
            WHERE Month(datedepense) = '$mois' AND YEAR(datedepense) = YEAR('$date')
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
        FROM depensesphamacie 
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
            depensesphamacie
        WHERE YEAR(datedepense) = $anne
        GROUP BY 
            semestre";

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }
    public function SommeDepenseImpot($anne){
        global $conn;
        if ($anne == null) {
            $anne = date("Y");
        }
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = $anne AND cathegorie='impots et taxes'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeDepenseExerciceImpot($anne){
        global $conn;
        if ($anne == null) {
            $anne = date("Y");
        }
        $anne = $anne - 1;
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = $anne AND cathegorie='impots et taxes'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeDepenseAutreCharge($anne){
        global $conn;
        if ($anne == null) {
            $anne = date("Y");
        }
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = $anne AND cathegorie='autre charge'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeDepenseExerciceAutreCharge($anne){
        global $conn;
        if ($anne == null) {
            $anne = date("Y");
        }
        $anne = $anne - 1;
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = $anne AND cathegorie='autre charge'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeDepensePersonnel($anne){
        global $conn;
        if ($anne == null) {
            $anne = date("Y");
        }
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = $anne AND cathegorie='charge personnel'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeDepenseExercicePersonnel($anne){
        global $conn;
        if ($anne == null) {
            $anne = date("Y");
        }
        $anne = $anne - 1;
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = $anne AND cathegorie='charge personnel'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }
    public function SommeServiceExterieux($anne){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = '$anne' AND cathegorie='service exterieur'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeServiceExterieuxAnne($anne){
        global $conn;
        $anne = $anne - 1;
        $sql = "SELECT SUM(montant) as montant FROM depensesphamacie WHERE YEAR(datedepense) = '$anne' AND cathegorie='service exterieur'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }
}
?>