<?php

require_once("../bdmutilple/getclient.php");

// Récupérer les données envoyées en JSON

$data = json_decode(file_get_contents('php://input'), true);
$client = new Client($data);
$id = $_GET["id"];

if(!empty($id)){
    $client->DeleteClient($id);
    header("location:liste.php");
    exit();
}

if ((!is_array($data))) {
// Traiter les données (par exemple, les enregistrer dans une base de données)
    echo json_encode($client->getAllByIdClient($data));
}elseif (is_array($data)) {
  echo json_encode($client->UpdateClient($data)) ;
}



?>