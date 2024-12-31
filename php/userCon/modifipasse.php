<?php
session_start();
require_once("../connexion.php");
require_once("../bdmutilple/getuser.php");
header('Content-Type: application/json');

$user = new User();

$json = file_get_contents('php://input');
$donnees = json_decode($json,true);
if (empty($donnees)) {
    echo json_encode($donnees);
    exit;
}
if (!is_array($donnees)) {
    echo json_encode($user->getUser($donnees));
}
if (is_array($donnees)) {
    echo json_encode($user->UpdatePassWord($donnees["emai"],$donnees["password"]));
}

?>