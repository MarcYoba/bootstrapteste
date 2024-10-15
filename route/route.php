<?php
session_start();
header('Content-Type: application/json');
$json = file_get_contents('php://input');
$donnees = json_decode($json,true);
echo json_encode($donnees);
$_SESSION["route"] = $donnees;


?>