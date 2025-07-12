<?php 
require_once("../connexion.php");

class Poussin{

    public function InsertPoussin($tableau){
        global $conn;
        $dateDuJour = $tableau["datelivraison"];
        $nb_jours = 30;
        $timestamp_depart = strtotime($dateDuJour);
        $timestamp_arrivee = $timestamp_depart + ($nb_jours * 86400);
        $Daterap = date('Y-m-d', $timestamp_arrivee);

        if ($tableau["daterapel"] != '0001-01-01') {
            $Daterap = $tableau["daterapel"];
        } 
        

        $sql = "INSERT INTO poussin (Nomclient, quantite, prixUnite, montant,souche,montantOm,montantCredit,montantCash,reste,statusCommande,dateCommande,dateLivraison,daterappelle) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

        // Lier les paramètres
        if (!$stmt = $conn->prepare($sql)) {
            return "erreur sql";
        }
        $datedebut = $tableau["dateCommande"];
        $status = "EN COUR";
        $tableau["quantitetotale"] = $tableau["quantite"] * $tableau["prixunite"];

        $stmt->bind_param('sdddsddddssss',$tableau["fournisseur"],$tableau["quantite"],$tableau["prixunite"],$tableau["quantitetotale"],$tableau["souche"],$tableau["OM"],$tableau["CREDIT"],$tableau["CASH"],$tableau["RESTE"],$status, $datedebut ,$tableau["datelivraison"],$Daterap);

        // Exécuter la requête
        if (!$stmt->execute()) {
            return "Echec";
        }else{
            return "OK";
        }
    }

    public function InsertLivraison($tableau){
        global $conn;
        $id = $tableau["reference"];
        $status = $tableau["status"];
        $qt = $tableau["quantite"];
        $prix = $tableau["prixunite"];
        $montant = $tableau["quantitetotale"];
        $om = $tableau["OM"];
        $cred = $tableau["CREDIT"];
        $cash = $tableau["CASH"];
        $rest = $tableau["RESTE"];
        $sql = "UPDATE poussin SET quantite='$qt',prixUnite='$prix',montant='$montant',montantOm='$om',montantCredit='$cred',montantCash='$cash',reste='$rest',statusCommande='$status' WHERE id='$id'";
        $result = $conn->query($sql);
        // Exécuter la requête
        if ($result == true) {
            return "OK";
        }else{
            return "echec";
        }
    }

    public function getPoussin(){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM poussin WHERE dateCommande= CURRENT_DATE";
        $result = $conn->query($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        return $data;
    }

    public function getPoussinDate($date){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM poussin WHERE dateCommande= '$date'";
        $result = $conn->query($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        return $data;
    }

    public function getPoussinSemaine($datebebut,$datefin){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM poussin WHERE dateCommande BETWEEN '$datebebut' AND '$datefin'";
        $result = $conn->query($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        return $data;
    }

    public function getPoussinMonth($mois,$date){
        global $conn;
        $data = [];
        $sql = "SELECT dateCommande, 
            ROUND(SUM(prixUnite)) AS listMontant,
            ROUND(SUM(montant)) AS nomtant,
            ROUND(SUM(quantite)) AS quantite,
            ROUND(SUM(montantCash)) AS montantCash,
            ROUND(SUM(montantOm)) AS montantOm,
            ROUND(SUM(reste)) AS reste
            FROM poussin
            WHERE Month(dateCommande) = '$mois' AND YEAR(dateCommande) = YEAR('$date')
            ";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["dateCommande"] = "TOTAL";
            $row["dateCommande"] = "-";
            array_push($data,$row);
        }
       return $data ;
    }

    public function CommandePoussinNonLivrer(){
        global $conn;
        $data = [];
        $sql = "SELECT Nomclient,quantite,prixUnite,montant,montantOm,montantCredit,montantCash,reste,statusCommande,dateLivraison 
        FROM poussin WHERE statusCommande ='EN COUR'";
        $result =$conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data;
    }
    public function getFacture($idfacture){
        global $conn;
        $sql = "SELECT * FROM poussin WHERE id ='$idfacture'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row; 
    }
    public function PoussinSemesttre($anne)
    {
        global $conn;
        $data =[];
        $sql = "SELECT 
        CEILING(MONTH(dateCommande) / 6) AS semestre,
        ROUND(SUM(montant),2) AS montant
        FROM 
            poussin
        WHERE YEAR(dateCommande) = $anne
        GROUP BY 
            semestre";

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }
    public function QuantiteSemesttre($anne)
    {
        global $conn;
        $data =[];
        $sql = "SELECT 
        CEILING(MONTH(dateCommande) / 6) AS semestre,
        ROUND(SUM(quantite),2) AS quantite
        FROM 
            poussin
        WHERE YEAR(dateCommande) = $anne
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