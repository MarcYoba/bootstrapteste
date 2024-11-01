<?php
require_once("../connexion.php");
require_once("../bdmutilple/getclient.php");
require_once("../bdmutilple/getvente.php");

$id = $_POST["idvente"];
$nomclient = $_POST["fournisseur"];

$client = new Client(1);
$vente = new Vente(0);

$idclient = $client->getByNameClient($nomclient);
$vente->UPDATEClient($idclient,$id);


?>