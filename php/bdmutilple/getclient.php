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

    public function getByNameClient($Name){
        global $conn;
        $sql = "SELECT id FROM client WHERE firstname= '$Name'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["id"]; 
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
}
?>