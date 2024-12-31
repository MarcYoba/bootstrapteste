<?php
 require_once("../connexion.php");
 require_once("../bdmutilple/etudeEvolutive.php");
 header('Content-Type: application/json');


$json = file_get_contents('php://input');
$donnees = json_decode($json,true);
global $conn;
$evoulution = new EtudeEvolution();

$tab = [
    "montantN" => 0,
    "montantN1" => 0,
    "ClientN" => 0,
    "ClientN1" => 0,
    "Nbuclient" => 0,
    "Nbaclient" => 0,
    "Moclient" => 0,
    "MoAclient" => 0
];

if (!is_array($donnees)) {
    $reponse = $evoulution->EvolutionMoi($donnees);
    echo json_encode($reponse);
} else {
    if ($donnees["datatrie"] == "semain") {
        $reponse = $evoulution->Evolutionsemaine($donnees);
    echo json_encode($reponse);
    } else {
        echo json_encode($tab);
    }
}


?>