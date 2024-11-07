<?php 
require_once("../connexion.php");


class EtudeEvolution{

    public function __construct()
    {
        
    }

    public function EvolutionMoi($mois){
        global $conn;
        $tab = [
            "montantN" => 0,
            "montantN1" => 0,
            "ClientN" => 0,
            "ClientN1" => 0,
        ];

        $sql = "SELECT ROUND(SUM(prix),2) AS montant, COUNT(idclient) AS nom FROM `ventephamacie` WHERE MONTH(datevente) = '$mois'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);

        $tab["montantN"] = $row["montant"];
        $tab["ClientN"] = $row["nom"];

        $mois +=1;

        $sql = "SELECT ROUND(SUM(prix),2) AS montant, COUNT(idclient) AS nom FROM `ventephamacie` WHERE MONTH(datevente) = '$mois'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);

        $tab["montantN1"] = $row["montant"];
        $tab["ClientN1"] = $row["nom"];

        return $tab;

    }

}
?>
