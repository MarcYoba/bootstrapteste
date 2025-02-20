<?php
require_once("connexion.php");

class Tresorerie{

    public function __construct()
    {
        
    }

    public function GetTresorerie($annee){

        global $conn;
        $data =[];
        $indextable = 2;
        $tmparry = array();
        
        $sql = "SELECT id,besoin ,montant,numOrdre FROM tresorerie WHERE YEAR(datecreat)= '$annee' AND groupe='Investisements_initiaux'";
        $result = $conn->query($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $numordre = $row["numOrdre"];
            $tmparry[0] = $row["besoin"];
            $tmparry[1] = $row["id"];
            for ($i=2; $i <14 ; $i++) { 
                $tmparry[$i] = 0;
            }

            $sql = "SELECT id,montant FROM tresorerie WHERE YEAR(datecreat)= '$annee' AND groupe='Investisements_initiaux' AND  numOrdre='$numordre'";
            $res = $conn->query($sql);
            while ($elementorder = mysqli_fetch_assoc($res)) {
                if($indextable < 14){
                    $tmparry[$indextable] = $elementorder["montant"];
                    $indextable++;
                }
            }
            array_push($data,$tmparry);
        }
        return $data; 
    }

    
   
}

?>