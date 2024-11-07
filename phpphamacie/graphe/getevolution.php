<?php
 require_once("../connexion.php");
 require_once("../bdmutilple/etudeEvolutive.php");
 header('Content-Type: application/json');


$json = file_get_contents('php://input');
$donnees = json_decode($json,true);
global $conn;
$evoulution = new EtudeEvolution();
$reponse = $evoulution->EvolutionMoi($donnees);
echo json_encode($reponse);
?>