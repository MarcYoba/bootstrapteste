<?php
require_once("../bdmutilple/getfacture.php");
//header('Content-Type: application/json');


$json = file_get_contents("php://input");
$donnees = json_decode($json,true);

$facture = new Facture(1);

if (is_array($donnees) == false) {
    $facture = new Facture($donnees);
    $result = $facture->getByIdidFacture();
    echo json_encode($result);
} 
elseif (is_array($donnees) == true) {
    // $ligenid = array_pop($donnees);
    //echo json_encode($donnees);
    echo json_encode($facture->EditFacture($donnees));
}

?>