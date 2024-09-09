<?php
session_start();
require_once("../connexion.php"); 

header('Content-Type: application/json');

$json = file_get_contents('php://input');
$donnees = json_decode($json,true);


class Vente{
   public $value = "";

    public function __construct($value){
        $this->value = $value;
    }

    public function getAllVente(){
        global $conn;
        $data = [];

        $sql = "SELECT id,typevente,numfacture,quantite,prix,datevente FROM vente ";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            array_push($data,$row);
        }
        return $data;
    }
}

if (empty($donnees)) {
    $vente = new Vente("vente");
   echo json_encode($vente->getAllVente());
    
} else {
   echo json_encode(" no set issete");
}





?>