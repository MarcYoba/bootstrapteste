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
            "Nbuclient" => 0,
            "Nbaclient" => 0,
            "Moclient" => 0,
            "MoAclient" => 0
        ];

        $sql = "SELECT ROUND(SUM(prix),2) AS montant, COUNT(idclient) AS nom FROM `vente` WHERE MONTH(datevente) = '$mois'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);

        $tab["montantN"] = $row["montant"];
        $tab["ClientN"] = $row["nom"];

        $mois +=1;

        $sql = "SELECT ROUND(SUM(prix),2) AS montant, COUNT(idclient) AS nom FROM `vente` WHERE MONTH(datevente) = '$mois'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);

        $tab["montantN1"] = $row["montant"];
        $tab["ClientN1"] = $row["nom"];
        $mois -=1;

        $sql ="SELECT DISTINCT c.firstname, v.datevente, ROUND(SUM(v.prix),2) as prix
                FROM vente v
                INNER JOIN client c ON v.idclient = c.id
                WHERE MONTH(c.datecreation) = '$mois' AND MONTH(v.datevente) = '$mois'
                GROUP BY c.firstname
                ORDER BY c.firstname";
        $result = $conn->query($sql);
        $tab["Nbuclient"] = $result->num_rows;
        

        $sql ="SELECT DISTINCT c.firstname, v.datevente, ROUND(SUM(v.prix),2) as prix
                FROM vente v
                INNER JOIN client c ON v.idclient = c.id
                WHERE MONTH(c.datecreation) = '$mois' AND MONTH(v.datevente) = '$mois'
                ";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $tab["Moclient"] = $row["prix"];




        $sql ="SELECT DISTINCT c.firstname, v.datevente, ROUND(SUM(v.prix),2) as prix
                FROM vente v
                INNER JOIN client c ON v.idclient = c.id
                WHERE MONTH(c.datecreation) != '$mois' AND MONTH(v.datevente) = '$mois'
                GROUP BY c.firstname
                ORDER BY c.firstname";
        $result = $conn->query($sql);
        $tab["Nbaclient"] = $result->num_rows;
        

        $sql ="SELECT DISTINCT c.firstname, v.datevente, ROUND(SUM(v.prix),2) as prix
        FROM vente v
        INNER JOIN client c ON v.idclient = c.id
        WHERE MONTH(c.datecreation) != '$mois' AND MONTH(v.datevente) = '$mois'
        ";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $tab["MoAclient"] = $row["prix"];

        return $tab;

    }

    public function VenteAncienClient($mois){
        global $conn;

        $tab =[
            "nbclient"=> 0,
            "montant"=> 0
        ];
        $avantmois = $mois;
        $sql ="SELECT DISTINCT c.firstname, v.datevente, ROUND(SUM(v.prix),2) as prix
        FROM vente v
        INNER JOIN client c ON v.idclient = c.id
        WHERE MONTH(c.datecreation) < '$avantmois' AND MONTH(v.datevente) = '$mois'
        GROUP BY c.firstname
        ORDER BY c.firstname";
        $result = $conn->query($sql);
        $tab["nbclient"] = $result->num_rows;


        $sql ="SELECT DISTINCT c.firstname, v.datevente, ROUND(SUM(v.prix),2) as prix
                FROM vente v
                INNER JOIN client c ON v.idclient = c.id
                WHERE MONTH(c.datecreation) < '$avantmois' AND MONTH(v.datevente) = '$mois'
                ";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $tab["montant"] = $row["prix"];

        return $tab;
    }

}
?>
