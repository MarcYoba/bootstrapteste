<?php

require('../../fpdf186/fpdf.php');
require_once("../bdmutilple/getproduit.php");
require_once("../bdmutilple/getfournisseur.php");
require_once("../bdmutilple/getclient.php");
require_once("../bdmutilple/getcaise.php");
require_once("../bdmutilple/getdette.php");
require_once("../bdmutilple/getfacture.php");
require_once("../bdmutilple/getpoussin.php");

require '../../vendor/autoload.php';
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;


$client = new Client(0);
$produit = new Produit();
$poussin = new Poussin();
$formule = 1;

// Créer une instance de Dompdf
$dompdf = new Dompdf();

// Créer le contenu HTML du PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Facture</title>
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

$html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="10" align="center">comende nom livre </th></tr>
        </thead>
        <tbody>';
        $html .= '<tr>';
        
        $html .= '</tr>
            <tr>
            <th scope="col">Nomclient</th>
            <th scope="col">quantite</th>
            <th scope="col">prixUnite</th>
            <th scope="col">montant</th>
            <th scope="col">Om</th>
            <th scope="col">Credit</th>
            <th scope="col">Cash</th>
            <th scope="col">reste</th>
            <th scope="col">status</th>
            <th scope="col">dateLivraison</th>
        </tr>';
            $nbperemption = $poussin->CommandePoussinNonLivrer();
            foreach ($nbperemption as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    $html .= '<td>' .$cell.'</td>';
                }
                $html .= '</tr>';
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
$dompdf->stream("historique.pdf", array("Attachment" => 0));

?>