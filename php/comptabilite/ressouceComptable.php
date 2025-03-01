<?php 
require_once("../bdmutilple/comptabilite.php");
require_once("../bdmutilple/etudeEvolutive.php");
require_once("../bdmutilple/getvente.php");
require_once("../bdmutilple/getfacture.php");
require_once("../bdmutilple/getachat.php");
require_once("../bdmutilple/getservice.php");
require_once("../bdmutilple/getproduit.php");
require_once("../bdmutilple/getstock.php");
header('Content-Type: application/json');

$comptabilite = new Comptabilite();
$vente = new Vente(0);
$facture = new Facture(0);
$achat = new Achat(0);
$service = new Service();
$produit = new Produit();
$stok = new Stock(0,0,0,0);

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
}elseif (isset($donnees["chiffre"])) {
    $table = [
        "produitFabriquer" => $facture->sommeVenteProduitFabriquerAnne($donnees["anne"]),
        "vente" => $vente->SommeVenteAnne($donnees["anne"]),
        "service" => $service->sommeServiceAnne($donnees["anne"]),
        "accessoire" => $comptabilite->SommeCorporelles($donnees["anne"]),
        "reduction" => $vente->SommeReductionAnne($donnees["anne"])
    ];
    echo json_encode($table);
}elseif (isset($donnees["stock"])) {
    $table = [
        "prostock" => $produit->SommeProduitStocker($donnees["anne"]),
        "prodim" => $comptabilite->SommeImmobilisationCorporelAnne($donnees["anne"]),
        "varia" => $stok->VariationStokfourniture(),
        "autrevariat" => $comptabilite->SommeAutreAprovision()
        
    ];
    echo json_encode($table);
}






?>