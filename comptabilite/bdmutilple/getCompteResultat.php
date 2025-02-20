<?php
require_once("connexion.php");

class CompteResultat{

    public function __construct()
    {
        
    }

    public function GetCompteREsultat($annee){

        global $conn;
        $data =[];
        $indextable = 2;
        $tmparry = array();
        
        $sql = "SELECT id,reference,libelle ,montant,ordre FROM compteResultat WHERE YEAR(dateexercice)= '$annee' AND groupe='marge'";
        $result = $conn->query($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
        return $data; 
    }

    public function getElement($id) {
        global $conn;

        $sql = "SELECT * FROM compteResultat WHERE id='$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    
   
}

?>