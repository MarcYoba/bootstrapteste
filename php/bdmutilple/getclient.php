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
}
?>