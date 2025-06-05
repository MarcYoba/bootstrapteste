<?php

require_once("../connexion.php"); 


class Achat{
    public $dateachat;

    public function __construct($dateachat)
    {
        $this->dateachat = $dateachat;
    }

    public function ToDay(){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM achatphamacie WHERE dateachat= CURRENT_DATE";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function DeleteAchat($id){
        global $conn;

        $sql = "DELETE  FROM prixphamacie WHERE idachat= '$id'";
        $result = $conn->query($sql);
        
        $sql = "DELETE  FROM achatphamacie WHERE id= '$id'";
        $result = $conn->query($sql);
        if ($result===true) {
            return  true;
        } else {
            return  false;
        }
         
    }

    public function SommeAchat(){
        global $conn;
        $sql = "SELECT ROUND(SUM(montant),2) as montant FROM achatphamacie WHERE YEAR(dateachat)= YEAR(CURRENT_DATE)";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeAchatAnne($anne){
        global $conn;
        $sql = "SELECT ROUND(SUM(montant),2) as montant FROM achatphamacie WHERE YEAR(dateachat)= '$anne'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function SommeAchatAnnePasse(){
        global $conn;
        $anne = date("Y");
        $anne = $anne-1;
        $sql = "SELECT ROUND(SUM(montant),2) as montant FROM achatphamacie WHERE YEAR(dateachat)= '$anne'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function getByDate($date){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM achatphamacie WHERE dateachat= '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }
    public function getByWeek($datedebut,$datefin){
        global $conn;
        $sql = "SELECT SUM(montant) as montant FROM achatphamacie WHERE dateachat BETWEEN '$datedebut' AND '$datefin'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function UpdateAchat($idachat,$quantite,$nomProdit,$quatproduit,$fournisseur,$prix){

        global $conn;

        $sql = "SELECT id,quantite_produit FROM produitphamacie WHERE nom_produit='$nomProdit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $idproduit= $row["id"]; 
        $somme = $row["quantite_produit"] + $quatproduit;

        $sql = "UPDATE produitphamacie SET quantite_produit = '$somme' WHERE id = '$idproduit'";
        $result = $conn->query($sql);
        if($result === true){
            $somme = $quantite*$prix;
            $sql = "UPDATE achatphamacie SET quantite = '$quantite', prixAcaht = '$prix', idfournisseur  = '$fournisseur',montant='$somme'  WHERE id = '$idachat'";
            $result = $conn->query($sql);
            if ($result === true) {
                return true;
            } else {
                return false;
            }  
        }else{
            return false;
        }  
    }
    public function AllAchat(){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE dateachat= CURRENT_DATE";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function getAllAchat(){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function getAchatById($id){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE id='$id'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function getSommeAchat($idproduit,$date){
        global $conn;
        
        $sql = "SELECT SUM(quantite) AS quantite FROM achatphamacie WHERE idproduit = '$idproduit' AND dateachat = '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
       return $row["quantite"] ;
        
    }

    public function getAllAchatProduit($produit){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE Nomproduit='$produit'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatDate($date){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE dateachat= '$date'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatDateProduit($date,$produit){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE dateachat= '$date' AND Nomproduit='$produit'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatWeek($datedebut,$datefin){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE dateachat BETWEEN '$datedebut' AND '$datefin'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function AllAchatWeekProduit($datedebut,$datefin,$produit){
        global $conn;
        $data = [];
        $sql = "SELECT * FROM achatphamacie WHERE dateachat BETWEEN '$datedebut' AND '$datefin' AND Nomproduit='$produit'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function Sommemenseule($idmois,$date){
        global $conn;
        $data = [];
        // $sql = "SELECT dateachat,
        //         GROUP_CONCAT(prixAcaht SEPARATOR',') as listeprix,
        //         ROUND(SUM(prixAcaht),2) AS somPrix,
        //         GROUP_CONCAT(quantite SEPARATOR',') as listquantite,
        //         ROUND(SUM(quantite),2) as somQuantite,
        //         GROUP_CONCAT(montant SEPARATOR',') as listMontant,
        //         ROUND(SUM(montant),2) AS somMontant,
        //         GROUP_CONCAT(Nomproduit SEPARATOR ',') AS nom
        // FROM `achatphamacie` 
        // WHERE month(dateachat) = '$idmois'
        // GROUP BY dateachat";
        // $result = $conn->query($sql);
        // while ($row = mysqli_fetch_assoc($result)) {
        //     array_push($data,$row);
        // }

        $sql = "SELECT dateachat,
                GROUP_CONCAT(prixAcaht SEPARATOR',') as listeprix,
                ROUND(SUM(prixAcaht),2) AS somPrix,
                GROUP_CONCAT(quantite SEPARATOR',') as listquantite,
                ROUND(SUM(quantite),2) as somQuantite,
                GROUP_CONCAT(montant SEPARATOR',') as listMontant,
                ROUND(SUM(montant),2) AS somMontant,
                GROUP_CONCAT(Nomproduit SEPARATOR ',') AS nom
        FROM `achatphamacie` 
        WHERE month(dateachat) = '$idmois' AND YEAR(dateachat) = YEAR('$date')";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["dateachat"] = "TOTAL";
            $row["listeprix"] = $row["somPrix"];
            $row["listquantite"] = $row["somQuantite"];
            $row["listMontant"] = $row["somMontant"];
            $row["nom"] = "-";
            array_push($data,$row);
        }
       return $data ;
        
    }

    public function SommeAcgatMensuel($date){
        global $conn;
        $sql = "SELECT SUM(montant) AS montant FROM achatphamacie WHERE MONTH(dateachat) = '$date'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
       return $row["montant"];  
    }

    public function AchatTemesttre($anne)
    {
        global $conn;
        $data =[];
        $sql = "SELECT QUARTER(dateachat) AS trimestre, ROUND(SUM(montant),2) AS nombre_enregistrements 
        FROM achatphamacie 
        WHERE YEAR(dateachat) = $anne
        GROUP BY QUARTER(dateachat)";

        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function AchatSemesttre($anne)
    {
        global $conn;
        $data =[];
        $sql = "SELECT 
        CEILING(MONTH(dateachat) / 6) AS semestre,
        ROUND(SUM(montant),2) AS montant
        FROM 
            achatphamacie
        WHERE YEAR(dateachat) = $anne
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