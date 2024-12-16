<?php 
require_once("../connexion.php");
require_once("comptabilite.php");
require_once("getvente.php");
require_once("getfacture.php");
require_once("getachat.php");
header('Content-Type: application/json');

$comptabilite = new Comptabilite();
$vente = new Vente(0);
$facture = new Facture(0);
$achat = new Achat(0);

$json = file_get_contents('php://input');
$donnees = json_decode($json,true);
global $conn;

if (isset($donnees["marge"])) {
    $table = [
        "produitFabriquer" => $facture->sommeVenteProduitFabriquerAnne($donnees["anne"]),
        "vente" => $vente->SommeVenteAnne($donnees["anne"]),
        "achat" => $achat->SommeAchatAnne($donnees["anne"]),
        "reduction" => $vente->SommeReductionAnne($donnees["anne"])
    ];
    echo json_encode($table);
}






?>