<?php

require_once("../connexion.php"); 


class Fournisseur{
    public $idfournissuer;

    public function __construct($idfournissuer)
    {
        $this->idfournissuer = $idfournissuer;
    }

    public function getByIdFournisseur($id){
        global $conn;
        $sql = "SELECT nom FROM fournisseur WHERE id= '$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["nom"]; 
    }
}
?>