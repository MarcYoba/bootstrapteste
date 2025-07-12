<?php

require('../../fpdf186/fpdf.php');
require_once("../bdmutilple/getvaccin.php");
require_once("../bdmutilple/getclient.php");

require '../../vendor/autoload.php';
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;


$client = new Client(0);
$vaccin = new Vaccin();
$formule = 1;
$date1 = $_POST['datedette'];
$date2 = $_POST['datedett2'];



if (!empty($date1) && empty($date2)) {
    $tabledette = $vaccin->getVaccinationDate($date1);
}elseif (empty($date1) && !empty($date2)) {
    $tabledette = $vaccin->getVaccinationDate($date2);
}elseif (!empty($date1) && !empty($date2)) {
    $tabledette = $vaccin->getVaccinationSemain($date1, $date2);
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
        $html .=' <tr><th colspan="3" align="center""> Rapport des vaccins  : '.$date1." Au ".$date2.'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="3" align="center"> Rapport des vaccins  </td>';
            $html .= '</tr>
                <tr>
                <th>Nom</th>
                <th>Montant</th>
                <th>Date</th>

            </tr>';
            $som = 0; 
            $somQt = 0;

            foreach ($tabledette as $key ) {
                $html .= '<tr>';
                $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                $somQt += 1;
                $som += $key["montant"];
                $html .= '<td>' .$key["montant"].'</td>';
                $html .= '<td>' .$key["datevacin"].'</td>';
                $html .= '</tr>';
            }
                $html .= '<tr>';
                    $html .= '<td>Total</td>';
                    
                    $html .= '<td> Quantite : '.$somQt.'</td>';
                    $html .= '<td> Montant :'.$som.'</td>';
                    
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
$dompdf->stream("list_vaccin.pdf", array("Attachment" => 0));

?>