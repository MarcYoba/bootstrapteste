<?php

require('../../fpdf186/fpdf.php');
require_once("../bdmutilple/getvente.php");
require_once("../bdmutilple/getdepense.php");
require_once("../bdmutilple/getversement.php");
require_once("../bdmutilple/getachat.php");
require_once("../bdmutilple/getfournisseur.php");
require_once("../bdmutilple/getclient.php");
require_once("../bdmutilple/getcaise.php");

require '../../vendor/autoload.php';
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;

$vente = new Vente(0);
$client = new Client(0);
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

// Récupérer les données POST
if (!empty($_POST['OM']) || !empty($_POST['credit']) || !empty($_POST['cash'])) {

    if (isset($_POST['credit']) && isset($_POST['OM'])) {
        $value = $vente->getIdVenteByTypeCreditOM($_POST['date']);
    } else if (isset($_POST['credit'])) {
        $value = $vente->getIdVenteByTypeCredit($_POST['date']);
    } else if (isset($_POST['OM'])) {
        $value = $vente->getIdVenteByTypeOM($_POST['date']);
    } else if (isset($_POST['OM']) && isset($_POST['credit']) && isset($_POST['cash']) && isset($_POST['date'])) {
        $value = $vente->getIdVenteByDate($_POST['date']);
    } else if(isset($_POST['cash'])) {
        $value = $vente->getIdVenteByTypeCash($_POST['date']);
    }    else{
        $value = $vente->getIdVenteByDate($_POST['date']);  
    }
    
} else {
    $value = $vente->getIdVenteByDate($_POST['date']); 
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
<body>
    <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="6" align="center""> rapport Vente du : '.$_POST['date'].'</th></tr>
        </thead>
        <tbody>';
        foreach ($value as $line) {
            

            if ($nomPtoduit == "ALL") {
                $facture = $vente->getFactureVenteTrie($line["id"]);
                
             } else {
                $facture = $vente->getFactureVenteProduit($line["id"],$_POST["nomProduit"]);
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

    $html .= '
        </body>
    </html>';

// Charger le contenu HTML dans Dompdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("mon_fichier.pdf", array("Attachment" => 0));