<?php

require('../../fpdf186/fpdf.php');
require_once("../bdmutilple/getvente.php");
require_once("../bdmutilple/getdepense.php");
require_once("../bdmutilple/getversement.php");
require_once("../bdmutilple/getachat.php");
require_once("../bdmutilple/getfournisseur.php");
require_once("../bdmutilple/getclient.php");
require_once("../bdmutilple/getcaise.php");
require_once("../bdmutilple/getstock.php");
require_once("../bdmutilple/trievalue.php");

require '../../vendor/autoload.php';
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;

$vente = new Vente(0);
$client = new Client(0);
$trie = new TrieValue();
$stok = new Stock(1,$_POST['date'],$_POST['date2']);

$formule = 1;
$date = date("Y/m/d");

if (isset($_POST['date'])) {
    if (empty($_POST['date'])) {
        exit();
    }
} else {
    $date = date("Y-m-d");
}


$nomPtoduit = $_POST["nomProduit"];
//$nomclient = $_POST["client"];

// Récupérer les données POST
if (!empty($_POST['OM']) || !empty($_POST['credit']) || !empty($_POST['cash'])) {

    if (isset($_POST['OM']) && isset($_POST['credit']) && isset($_POST['cash'])) {
        
        if(!empty($_POST['date']) && !empty($_POST['date2'])){
            $value = $vente->getIdVenteByWeek($_POST['date'],$_POST['date2']);
        }else{
            $value = $vente->getIdVenteByDate($_POST['date']); 
        }
    } else if ( isset($_POST['credit']) && isset($_POST['OM'])) {   
        if(!empty($_POST['date']) && !empty($_POST['date2'])){
            $value = $vente->getIdVenteByTypeCreditOMInterval($_POST['date'],$_POST['date2']); 
        }else{
            $value = $vente->getIdVenteByTypeCreditOM($_POST['date']); 
        }
    } else if (isset($_POST['OM'])) {
       
        if(!empty($_POST['date']) && !empty($_POST['date2'])){
            $value = $vente->getIdVenteByTypeOMIterval($_POST['date'],$_POST['date2']); 
        }else{
            $value = $vente->getIdVenteByTypeOM($_POST['date']); 
        }
    } else if (isset($_POST['credit'])) {
        
        if(!empty($_POST['date']) && !empty($_POST['date2'])){
            $value = $vente->getIdVenteByTypeCreditInterval($_POST['date'],$_POST['date2']);
        }else{
            $value = $vente->getIdVenteByTypeCredit($_POST['date']);
        }
    } else if(isset($_POST['cash'])) {
        
        if(!empty($_POST['date']) && !empty($_POST['date2'])){
            $value = $vente->getIdVenteByTypeCashIntervel($_POST['date'],$_POST['date2']); 
        }else{
            $value = $vente->getIdVenteByTypeCash($_POST['date']); 
        }
    }    else{
        if(!empty($_POST['date']) && !empty($_POST['date2'])){
            $value = $vente->getIdVenteByWeek($_POST['date'],$_POST['date2']);
        }else{
            $value = $vente->getIdVenteByDate($_POST['date']); 
        } 
    }
    
} else {
    if(!empty($_POST['date']) && !empty($_POST['date2'])){
        $value = $vente->getIdVenteByWeek($_POST['date'],$_POST['date2']);
    }else{
        $value = $vente->getIdVenteByDate($_POST['date']); 
    }   
}






// Créer une instance de Dompdf
$dompdf = new Dompdf();

// Créer le contenu HTML du PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Raport stock</title>
    <style>
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
        @Page {
                    footer {
                       position: fixed;
                        bottom: 0cm;
                        left: 0cm;
                        right: 0cm;
                        height: 2cm;
                        text-align: center;
                    }
                }
</style>
</head>
<body>';

        
        if(isset($_POST["facture"])){
            $html .= '<table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="6" align="center""> rapport Vente du : '.$_POST['date']." Au ".$_POST['date2'].'</th></tr>
            </thead>
            <tbody>';
            foreach ($value as $line) {
                
                if (($nomPtoduit == "ALL") && ($_POST["client"] == "ALL")) {
                    $facture = $vente->getFactureVenteTrie($line["id"]);     
                } elseif(($nomPtoduit != "ALL") &&($_POST["client"] == "ALL")) {
                    $facture = $vente->getFactureVenteProduit($line["id"],$_POST["nomProduit"]);
                }elseif(($nomPtoduit == "ALL") && ($_POST["client"] != "ALL")){
                    $facture = $vente->getFactureVenteClient($line["id"],$_POST["client"]);
                }elseif(($nomPtoduit != "ALL") && ($_POST["client"] != "ALL")){
                    $facture = $vente->getFactureVenteClientProduit($line["id"],$_POST["client"],$_POST["nomProduit"]);
                }else{
                    $facture = $vente->getFactureVenteTrie($line["id"]); 
                }

                if (!empty($facture)) {
                    # code...
                
                    $inclient=$client->getClientByIdVente($line["id"]);
                    $html .= '<tr>';
                    $html .= '<td colspan="6" align="center"> Formule ' . $formule." Vente N= ".$line["id"]." Client : ".$inclient["firstname"]." Tel: ".$inclient["telephone"].'</td>';
                    $html .= '</tr>
                        <tr>
                        <th scope="col">Nom produit</th>
                        <th scope="col">quantite</th>
                        <th scope="col">prix</th>
                        <th scope="col">montant </th>
                        <th scope="col">Typepaiement</th>
                        <th scope="col">datevente</th>
                    </tr>';
                    //var_dump($facture);
                    foreach ($facture as $linefatcture) {
                        $html .= '<tr>';
                        foreach ($linefatcture as $key => $cell) {
                            $html .= '<td>' .$cell.'</td>';
                        }
                        $html .= '</tr>';
                    }
                } 

                $formule++;
            }

      

            $html .= '
            </tbody>
            </table>';
        }
    
        if(isset($_POST["quantite"])){
                $html .='<br><br><br> <table style="width:100%">
                <thead>';
                $html .=' <tr><th colspan="5" align="center""> Quantite Pour chaque produit : '.$_POST['date']." Au ".$_POST['date2']."Produit : ".$nomPtoduit.'</th></tr>
                </thead>
                <tbody>';
                    $html .= '<tr>';
                    $html .= '<td colspan="5" align="center"> Recapitulatif Quantite Vendue </td>';
                    $html .= '</tr>
                        <tr>
                        <th scope="col">Mon du produit </th>
                        <th scope="col">Stock debut du jour</th>
                        <th scope="col">Quantite vendu</th>
                        <th scope="col">Reste en stock</th>
                        <th scope="col">Date</th>
                    </tr>';
                    if (!empty($_POST['date']) && !empty($_POST['date2'])) {
                        if(($nomPtoduit != "ALL") &&($_POST["client"] == "ALL")){
                            $quantiteproduit = $vente->getSommeProduitWeekProduit($_POST['date'],$_POST['date2'],$nomPtoduit);
                        }elseif(($nomPtoduit == "ALL") &&($_POST["client"] != "ALL")){
                            $quantiteproduit = $vente->getSommeProduitWeekClient($_POST['date'],$_POST['date2'],$_POST["client"]);
                        }elseif(($nomPtoduit != "ALL") &&($_POST["client"] != "ALL")){
                            $quantiteproduit = $vente->getSommeProduitWeekClientProduit($_POST['date'],$_POST['date2'],$_POST["client"],$nomPtoduit);
                        }else{
                            $quantiteproduit = $vente->getSommeProduitWeek($_POST['date'],$_POST['date2']);
                        }
                    } else if(!empty($_POST['date'])) {
                        if(($nomPtoduit != "ALL") &&($_POST["client"] == "ALL")){
                            $quantiteproduit = $vente->getSommeProduitDateProduit($_POST['date'],$nomPtoduit);
                        }elseif(($nomPtoduit == "ALL") &&($_POST["client"] != "ALL")){
                            $quantiteproduit = $vente->getSommeProduitDateClient($_POST['date'],$_POST["client"]);
                        }elseif(($nomPtoduit != "ALL") &&($_POST["client"] != "ALL")){
                            $quantiteproduit = $vente->getSommeProduitDateClientProduit($_POST['date'],$_POST["client"],$nomPtoduit);
                        }else{
                            $quantiteproduit = $vente->getSommeProduitDate($_POST['date']);
                        }
                    }
                    
                    
                    foreach ($quantiteproduit as $key ) {
                        $html .= '<tr>';
                        $html .= '<td>' .$trie->RemoveChaine("provenderie",$key["nomproduit"]).'</td>';
                        $html .= '<td>' .$stok->getLogsDateProduit($trie->RemoveChaine("provenderie",$key["nomproduit"]),$_POST['date']).'</td>';
                        $html .= '<td>' .round( $key["quantite"],2).'</td>';
                        $html .= '<td>' .$stok->getQuantiteProduit($trie->RemoveChaine("provenderie",$key["nomproduit"])).'</td>';
                        $html .= '<td>' .$key["datefacture"].'</td>';
                    $html .= '</tr>';
                    }   
                $html .= '
                </tbody>
            </table>';
        }
        
        if ((!isset($_POST["quantite"])) && (!isset($_POST["facture"]))) {
            $html .= '<h1>Bienvenue Focntion de trie </h1><br>
                    <h2> Vous deviez choisir  au moin une option  pour les detailles : </h2>
                    <h3> 1) Facture </h3>
                     <h3> 1) Qunatite </h3>
                    
                    ';
        }
    $html .= '
        </body>
    </html>';

// Charger le contenu HTML dans Dompdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("mon_fichier.pdf", array("Attachment" => 0));