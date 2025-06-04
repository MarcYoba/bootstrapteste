<?php  
require_once("connexion.php");

class Comptabilite{
    public function __construct()
    {
        
    }

    public function AcahAnuelle() {
        global $conn;

        $data = [];
        $index = 1;
        
        while ($index <= 12) {
            $sql = "SELECT ROUND(SUM(montant),2) FROM achat WHERE MONTH(dateachat)= '$index' AND YEAR(dateachat) = YEAR(CURRENT_DATE)";
            $resulte = $conn->query($sql);
            $row = mysqli_fetch_assoc($resulte);
            if (empty($row)) {
                $row = 0;
            }
            array_push($data,$row);

            $index++;
        }
        return $data;
    }

    public function VentesAnuelle() {
        global $conn;

        $data = [];
        $index = 1;
        
        while ($index <= 12) {
            $sql = "SELECT ROUND(SUM(prix),2) FROM vente WHERE MONTH(datevente)= '$index' AND YEAR(datevente) = YEAR(CURRENT_DATE)";
            $resulte = $conn->query($sql);
            $row = mysqli_fetch_assoc($resulte);
            if (empty($row)) {
                $row = 0;
            }
            array_push($data,$row);

            $index++;
        }
        return $data;
    }

    public function TrimestreSemestre() {
        global $conn;
        $tab = [
            "trimestre1"=>0,
            "trimestre2"=>0,
            "trimestre3"=>0,
            "trimestre4"=>0,
            "semestre1"=>0,
            "semestre2"=>0,
        ];
        $index=1;
        while ($index <= 4) {
            $sql = "SELECT YEAR(CURRENT_DATE) AS anne, QUARTER(dateachat) AS trimestre, ROUND(SUM(montant),2) as montant
                FROM achat  
                WHERE YEAR(dateachat) = YEAR(CURRENT_DATE) AND QUARTER(dateachat) = '$index'
                GROUP BY anne, trimestre 
                ORDER BY anne,trimestre";
            $resultat = $conn->query($sql);
            $row = mysqli_fetch_assoc($resultat);

            if ($index==1) {
                if (!empty($row["montant"])) {
                    $tab["trimestre1"]= $row["montant"];
                }  
            }elseif ($index==2) {
                if (!empty($row["montant"])) {
                    $tab["trimestre2"]= $row["montant"];
                }  
            }elseif ($index==3) {
                if (!empty($row["montant"])) {
                    $tab["trimestre3"]= $row["montant"];
                }  
            }else{
                if (!empty($row["montant"])) {
                    $tab["trimestre4"]= $row["montant"];
                } 
            }
            $index++;
        }

        
            $sql="SELECT 
                    YEAR(dateachat) AS annee, 
                    CASE WHEN QUARTER(dateachat) IN (1,2) THEN 'Semestre 1'
                        WHEN QUARTER(dateachat) IN (3,4) THEN 'Semestre 2'
                    END AS semestre,
                    ROUND(SUM(montant),2) AS total_achat
                FROM 
                    achat
                WHERE YEAR(dateachat) = YEAR(CURRENT_DATE)
                GROUP BY 
                    annee, semestre
                ORDER BY 
                    annee, semestre";
            $resultat = $conn->query($sql);
            while ($row = mysqli_fetch_assoc($resultat)){
                if ($row["semestre"] == "Semestre 1") {
                    if (!empty($row["total_achat"])) {
                        $tab["semestre1"]= $row["total_achat"];
                    }
                }else{
                    if (!empty($row["total_achat"])) {
                        $tab["semestre2"]= $row["total_achat"];
                    }
                }

            }
            
        return $tab;
    }

    public function TrimestreSemestreVente() {
        global $conn;
        $tab = [
            "trimestre1"=>0,
            "trimestre2"=>0,
            "trimestre3"=>0,
            "trimestre4"=>0,
            "semestre1"=>0,
            "semestre2"=>0,
        ];
        $index=1;
        while ($index <= 4) {
            $sql = "SELECT YEAR(CURRENT_DATE) AS anne, QUARTER(datevente) AS trimestre, ROUND(SUM(prix),2) as montant
                FROM vente  
                WHERE YEAR(datevente) = YEAR(CURRENT_DATE) AND QUARTER(datevente) = '$index'
                GROUP BY anne, trimestre 
                ORDER BY anne,trimestre";
            $resultat = $conn->query($sql);
            $row = mysqli_fetch_assoc($resultat);

            if ($index==1) {
                if (!empty($row["montant"])) {
                    $tab["trimestre1"]= $row["montant"];
                }  
            }elseif ($index==2) {
                if (!empty($row["montant"])) {
                    $tab["trimestre2"]= $row["montant"];
                }  
            }elseif ($index==3) {
                if (!empty($row["montant"])) {
                    $tab["trimestre3"]= $row["montant"];
                }  
            }else{
                if (!empty($row["montant"])) {
                    $tab["trimestre4"]= $row["montant"];
                } 
            }
            $index++;
        }

        
            $sql="SELECT 
                    YEAR(datevente) AS annee, 
                    CASE WHEN QUARTER(datevente) IN (1,2) THEN 'Semestre 1'
                        WHEN QUARTER(datevente) IN (3,4) THEN 'Semestre 2'
                    END AS semestre,
                    ROUND(SUM(prix),2) AS total_achat
                FROM 
                    vente
                WHERE YEAR(datevente) = YEAR(CURRENT_DATE)
                GROUP BY 
                    annee, semestre
                ORDER BY 
                    annee, semestre";
            $resultat = $conn->query($sql);
            while ($row = mysqli_fetch_assoc($resultat)){
                if ($row["semestre"] == "Semestre 1") {
                    if (!empty($row["total_achat"])) {
                        $tab["semestre1"]= $row["total_achat"];
                    }
                }else{
                    if (!empty($row["total_achat"])) {
                        $tab["semestre2"]= $row["total_achat"];
                    }
                }

            }
            
        return $tab;
    }
    public function SommeImmobilisationCorporel(){
       global $conn;
       $sql = "SELECT SUM(brut) AS montant FROM actif WHERE cathegorie ='corporelles' AND ( YEAR(datebilan) =YEAR(CURRENT_DATE))";
       $resulte= $conn->query($sql);
       $row = mysqli_fetch_assoc($resulte);

       return $row["montant"];

    }

    public function SommeImmobilisationCorporelAnne($anne){
        global $conn;
        $sql = "SELECT SUM(brut) AS montant FROM actif WHERE cathegorie ='corporelles' AND ( YEAR(datebilan) ='$anne')";
        $resulte= $conn->query($sql);
        $row = mysqli_fetch_assoc($resulte);
 
        if (empty($row["montant"])) {
            $row["montant"] = 0;
        }
        return $row["montant"]; 
     }
    public function SommeImmobilisationCorporelexercice(){
        global $conn;
        $anne = date("Y");
        $anne = $anne -1;
        $sql = "SELECT SUM(brut) AS montant FROM actif WHERE cathegorie ='corporelles' AND ( YEAR(datebilan) =$anne)";
        $resulte= $conn->query($sql);
        $row = mysqli_fetch_assoc($resulte);
 
        return $row["montant"];
 
     }

    public function SommeSubvention(){
        global $conn;
        $sql = "SELECT SUM(montant) AS montant FROM passif WHERE libelle='Subvention%' AND ( YEAR(datepassif) =YEAR(CURRENT_DATE))";
        $resulte= $conn->query($sql);
        $row = mysqli_fetch_assoc($resulte);
 
        return $row["montant"];
    }

    public function SommeSubventionexercice(){
        global $conn;
        $anne = date("Y");
        $anne = $anne -1;
        $sql = "SELECT SUM(montant) AS montant FROM passif WHERE libelle='Subvention%' AND ( YEAR(datepassif) ='$anne')";
        $resulte= $conn->query($sql);
        $row = mysqli_fetch_assoc($resulte);
 
        return $row["montant"];
    }

    public function SommeAutreAprovision(){
        global $conn;
        $sql = "SELECT SUM(brut) AS montant FROM actif WHERE libelle='Materiel%' AND ( YEAR(datebilan) =YEAR(CURRENT_DATE))";
        $resulte= $conn->query($sql);
        $row = mysqli_fetch_assoc($resulte);
 
        return $row["montant"];
    }

    public function SommeAutreAprovisionExercice(){
        global $conn;
        $anne = date("Y");
        $anne = $anne -1;
        $sql = "SELECT SUM(brut) AS montant FROM actif WHERE libelle='Materiel%' AND ( YEAR(datebilan) ='$anne')";
        $resulte= $conn->query($sql);
        $row = mysqli_fetch_assoc($resulte);
 
        return $row["montant"];
    }

    public function SommeAmortise(){
        global $conn;
        $sql = "SELECT SUM(amortisement) AS montant FROM actif WHERE ( YEAR(datebilan) =YEAR(CURRENT_DATE))";
        $resulte= $conn->query($sql);
        $row = mysqli_fetch_assoc($resulte);
 
        return $row["montant"];
    }

    public function SommeExerciceAmortise(){
        global $conn;
        $anne = date("Y");
        $anne = $anne -1;
        $sql = "SELECT SUM(amortisement) AS montant FROM actif WHERE  ( YEAR(datebilan) ='$anne')";
        $resulte= $conn->query($sql);
        $row = mysqli_fetch_assoc($resulte);
 
        return $row["montant"];
    }

    public function SommeCorporelles($anne){
        global $conn;
        // $anne = date("Y");
        // $anne = $anne -1;
        $sql = "SELECT SUM(net) AS montant FROM actif WHERE  YEAR(datebilan) ='$anne' AND cathegorie='corporelles'";
        $resulte= $conn->query($sql);
        $row = mysqli_fetch_assoc($resulte);
        if (empty($row["montant"])) {
            $row["montant"] = 0;
        }
        return $row["montant"];
    }
}
// selectionner les donnes par trimestre pour chaque client 

// SELECT DISTINCT c.firstname, YEAR(v.datevente) AS year, 
//                 QUARTER(v.prix) AS trimestre, 
//                 ROUND(SUM(v.prix), 2) AS prix_total
// FROM vente v
// INNER JOIN client c ON v.idclient = c.id
// WHERE MONTH(c.datecreation) < '10'
// GROUP BY c.firstname, YEAR(v.datevente), QUARTER(v.prix)
// ORDER BY c.firstname, year, trimestre;
?>