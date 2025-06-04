<?php

require_once("../bdmutilple/getclient.php");
require_once("../bdmutilple/getCoammandclient.php");

$commandClient = new CommandClient();

// Récupérer les données envoyées en JSON

$data = json_decode(file_get_contents('php://input'), true);
$client = new Client($data);
//$id = $_GET["id"];
if (is_array($data)) {
    if ($data["operation"] == "valider") {
        echo json_encode($commandClient->ValiderCommande($data["id"]));
     }elseif ($data["operation"] == "annuler") {
         
     }
}else{
    echo json_encode($commandClient->VerifieCommande());
}


?>