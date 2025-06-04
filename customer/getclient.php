<?php

require_once("../php/connexion.php"); 


class Client{
    public $idclient;

    public function __construct($idclient)
    {
        $this->idclient = $idclient;
    }

    public function getByIdClient($id){
        global $conn;
        $sql = "SELECT firstname FROM client WHERE id= '$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["firstname"]; 
    }

    public function getClientNoNumber(){
        global $conn;
        $data =[];
        $sql = "SELECT id,`firstname`,`adresse`,`telephone`,`sexe` FROM `client` WHERE `telephone`=0 OR `telephone`=NULL";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function selectFactureProvenderi($idvente){
        global $conn;
        $data =[];
        $sql = "SELECT * FROM facture WHERE idvente = '$idvente'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function selectFactureCabinet($idvente){
        global $conn;
        $data =[];
        $sql = "SELECT * FROM facturephamacie WHERE idvente = '$idvente'";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function SelectAchatProvenderie($id){
        global $conn;
        $data =[];
        $sql = "SELECT id,typevente,quantite,prix,reduction,datevente FROM vente WHERE idclient ='$id' ORDER BY vente.id DESC";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function SelectAchatDetteCabinet($id){
        global $conn;
        $data =[];
        $sql = "SELECT id,typevente,quantite,prix,reduction,datevente 
        FROM ventephamacie 
        WHERE idclient ='$id' AND credit>0
        ORDER BY ventephamacie.id DESC";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function SelectAchatDetteProvenderie($id){
        global $conn;
        $data =[];
        $sql = "SELECT id,typevente,quantite,prix,reduction,datevente 
        FROM vente 
        WHERE idclient ='$id' AND credit>0
        ORDER BY vente.id DESC";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function SelectAchatCabinet($id){
        global $conn;
        $data =[];
        $sql = "SELECT id,typevente,quantite,prix,reduction,datevente FROM ventephamacie WHERE idclient ='$id' ORDER BY ventephamacie.id DESC";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function getVersementProvenderie($id){
        global $conn;
        $data =[];
        $sql = "SELECT id,montant,dateversement FROM versement WHERE idclient ='$id' ORDER BY versement.dateversement DESC";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function getVersementPhamacie($id){
        global $conn;
        $data =[];
        $sql = "SELECT id,montant,dateversement FROM versementphamacie WHERE idclient ='$id' ORDER BY versementphamacie.dateversement DESC";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function getcommandeclient($id){
        global $conn;
        $data =[];
        $sql = "SELECT * FROM commadeclient WHERE idclient ='$id' ORDER BY commadeclient.datecommande DESC";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data; 
    }

    public function getSommeProvenderie($idclient){
        global $conn;
        $sql = "SELECT ROUND(SUM(quantite),2) AS quantite,ROUND(SUM(prix),2) AS montant,ROUND(SUM(cash),2) AS cash,
                ROUND(SUM(credit),2) AS credit,ROUND(SUM(om),2) AS om,ROUND(SUM(banque),2) AS banque, 
                ROUND(SUM(reduction),2) AS reduction 
                FROM vente 
                WHERE idclient = '$idclient'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row; 
    }

    public function getSommeCabinet($idclient){
        global $conn;
        $sql = "SELECT ROUND(SUM(quantite),2) AS quantite,ROUND(SUM(prix),2) AS montant,ROUND(SUM(cash),2) AS cash,
                ROUND(SUM(credit),2) AS credit,ROUND(SUM(om),2) AS om,ROUND(SUM(banque),2) AS banque, 
                ROUND(SUM(reduction),2) AS reduction 
                FROM ventephamacie 
                WHERE idclient = '$idclient'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row; 
    }

    public function getAllByIdClient($id){
        global $conn;
        $sql = "SELECT * FROM client WHERE id= '$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row; 
    }

    public function getByNameClient($Name){
        global $conn;
        $sql = "SELECT id FROM client WHERE firstname= '$Name'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["id"]; 
    }

    public function DeleteClient($id){
        global $conn;

        $sql = "DELETE FROM facture  WHERE idclient = '$id'";
        $result = $conn->query($sql);

        $sql = "DELETE FROM user  WHERE idclient= '$id'";
        $result = $conn->query($sql);

        if ($result === true) {
            $sql = "DELETE FROM client  WHERE id= '$id'";
            $result = $conn->query($sql);

            if ($result === true) {
                $conn->close();
                return "OK";
            } else {
                $conn->close();
                return "ECHEC";
            }
        } else {
            $conn->close();
            return "ECHEC";
        }

        
        
    }

    public function getClientByIdVente($id){
        global $conn;
        $sql = "SELECT idclient  FROM vente WHERE id= '$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $idclient = $row["idclient"];

        $sql = "SELECT firstname,telephone FROM client WHERE id= '$idclient'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row; 
    }

    public function insertToClient($tableau){
        global $conn;
        $nom = $tableau["nom"] ;
        $tel = $tableau["tephone"];
        $sql = "INSERT INTO client (firstname, telephone, datecreation) VALUES (?, ?,?)";

        // Lier les paramètres
        if (!$stmt = $conn->prepare($sql)) {
            return "erreur sql";
        }
        $date = date("y/m/d");
        $stmt->bind_param('sds', $nom,  $tel, $date);

        // Exécuter la requête
        if (!$stmt->execute()) {
            return "Echec";
        }else{
            return "OK";
        }
    }

    public function insertToCommande($idvente,$paiementmode){
        global $conn;
        $sql = "INSERT INTO commadeclient  (idvente , userid , nom ,paiementmethode ,datecommande, statuscommande ) VALUES (?, ?,?,?, ?,?)";

        // Lier les paramètres
        if (!$stmt = $conn->prepare($sql)) {
            return "erreur sql";
        }
        // Obtenir le timestamp actuel
        $timestamp = time();
        $statut = "en coure";
        // Formater la date et l'heure actuelles
        $dateFormatee = date("Y-m-d H:i:s", $timestamp);
        
        $stmt->bind_param('ddssss', $idvente,  $_SESSION['idclient'], $_SESSION['name'],$paiementmode,$dateFormatee,$statut);

        // Exécuter la requête
        if (!$stmt->execute()) {
            return "Echec";
        }else{
            return "OK";
        }
    }

    public function insertToCommandeCabinet($idvente,$paiementmode){
        global $conn;
        $sql = "INSERT INTO commadeclientc  (idvente , userid , nom ,paiementmethode ,datecommande, statuscommande ) VALUES (?, ?,?,?, ?,?)";

        // Lier les paramètres
        if (!$stmt = $conn->prepare($sql)) {
            return "erreur sql";
        }
        // Obtenir le timestamp actuel
        $timestamp = time();
        $statut = "en coure";
        // Formater la date et l'heure actuelles
        $dateFormatee = date("Y-m-d H:i:s", $timestamp);
        
        $stmt->bind_param('ddssss', $idvente,  $_SESSION['idclient'], $_SESSION['name'],$paiementmode,$dateFormatee,$statut);

        // Exécuter la requête
        if (!$stmt->execute()) {
            return "Echec";
        }else{
            return "OK";
        }
    }

    public function insertToClientFile($tableau){
        global $conn;
        $nom = $tableau["NOMS"] ;
        $tel = $tableau["TELEPHONE"];
        $sujet  = $tableau["SUJETS"];
        $sql = "INSERT INTO client (firstname, telephone, datecreation, sujet) VALUES (?,?,?,?)";

        // Lier les paramètres
        if (!$stmt = $conn->prepare($sql)) {
            return "erreur sql";
        }
        $date = date("y/m/d");
        $stmt->bind_param('sdss', $nom,  $tel, $date,$sujet);

        // Exécuter la requête
        if (!$stmt->execute()) {
            return "Echec";
        }else{
            return "OK";
        }
    }

    public function UpdateClient($tableau){
        global $conn;
        
        $id = $tableau["id"] ;
        $nom = $tableau["nom"] ;
        $adress = $tableau["adress"] ; 
        $sexe = $tableau["sexe"] ;
        $tel = $tableau["phone"];
        
        $sql = "UPDATE client SET firstname ='$nom',adresse='$adress',telephone='$tel',sexe='$sexe' WHERE id = '$id'";
        $result = $conn->query($sql); 
        if ($result === True) {
            $conn->close(); 
            return "OK";
        } else{
            $conn->close(); 
            return "ECHEC";
        }
    }

    public function ClientPasAchat(){
        global $conn;
        $data = [];
        $sql = "SELECT DISTINCT id ,firstname,adresse,telephone,telephone
        FROM client
        WHERE id NOT IN (
            SELECT idclient
            FROM vente
            WHERE datevente >= DATE_SUB(CURDATE(), INTERVAL 10 DAY))  ORDER BY firstname ASC";
        
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
        return $data;
    }

    public function DoublonClient(){
        global $conn;

        $sql= "SELECT firstname, `firstname`, COUNT(*) FROM client GROUP BY `firstname`, `firstname` HAVING COUNT(*) > 1 ";
        $result = $conn->query($sql);
        $row = $result->num_rows;
        return $row;
    }
    public function SellectAll(){
        global $conn;
        $sql = "SELECT * FROM client";
        $result = $conn->query($sql);
        $row = $result->num_rows;

        return $row;
    }

    public function VenteClient($type){
        if ($type = "provenderie") {
            
        } else {
            # code...
        }
        
    }
    public function getClient(){
        global $conn;
        $data =[];
        $sql = "SELECT id,firstname,adresse,telephone,sexe FROM client 
        order by firstname ASC";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data;  
    }
}
?>