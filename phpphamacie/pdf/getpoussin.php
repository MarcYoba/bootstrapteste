<?php

require('../../fpdf186/fpdf.php');
require_once("../bdmutilple/getpoussin.php");
require_once("../bdmutilple/getclient.php");

require '../../vendor/autoload.php';
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;


$client = new Client(0);
$poussin = new Poussin();
$formule = 1;
$date1 = $_POST['datedette'];
$date2 = $_POST['datedett2'];



if (!empty($date1) && empty($date2)) {
    $tabledette = $poussin->getPoussinDate($date1);
}elseif (empty($date1) && !empty($date2)) {
    $tabledette = $poussin->getPoussinDate($date2);
}elseif (!empty($date1) && !empty($date2)) {
    $tabledette = $poussin->getPoussinSemaine($date1, $date2);
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

$html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="4" align="center""> Rapport des Poussins  : '.$date1." Au ".$date2.'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="4" align="center"> Rapport des Poussins  </td>';
            $html .= '</tr>
                <tr>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Montant</th>
                <th>Date</th>

            </tr>';
            $som = 0; 
            $somQt = 0;

            foreach ($tabledette as $key ) {
                $html .= '<tr>';
                $html .= '<td>' .$key["Nomclient"].'</td>';
                $somQt += $key["quantite"];
                $som += $key["montant"];
                $html .= '<td>' .$key["quantite"].'</td>';
                $html .= '<td>' .$key["montant"].'</td>';
                $html .= '<td>' .$key["dateLivraison"].'</td>';
                $html .= '</tr>';
            }
                $html .= '<tr>';
                    $html .= '<td>Total</td>';
                    
                    $html .= '<td>'.$somQt.'</td>';
                    $html .= '<td>'.$som.'</td>';
                    $html .= '<td>-</td>';
                    
                $html .= '</tr>';

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
$dompdf->stream("list_poussin.pdf", array("Attachment" => 0));

?>