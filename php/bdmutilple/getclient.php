<?php

require_once("../connexion.php"); 


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
}
?>