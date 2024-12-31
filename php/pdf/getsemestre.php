<?php

require('../../fpdf186/fpdf.php');
require_once("../bdmutilple/getvente.php");
require_once("../bdmutilple/getdepense.php");
require_once("../bdmutilple/getversement.php");
require_once("../bdmutilple/getachat.php");
require_once("../bdmutilple/getfournisseur.php");
require_once("../bdmutilple/getclient.php");
require_once("../bdmutilple/getcaise.php");
require_once("../bdmutilple/getdette.php");
require_once("../bdmutilple/getfacture.php");
require_once("../bdmutilple/getdepense.php");

require '../../vendor/autoload.php';
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;

$vente = new Vente(0);
$client = new Client(0);
$depense = new Depense(0);
$formule = 1;
$achat = new Achat(0);
$dette = new Dette();
$versement = new Versement(1);

//var_dump($date);
$anne = $_POST["anne"];
// $datefin = $_POST["datefin"];

$facture = new Facture(0);

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

$html .='<br><br><br> 
<table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="2" align="center">Vente Trimestre : '.$anne.'</th></tr>
        </thead>
        <tbody>';
        $html .= '<tr>
            <th>Numero de semestre</th>
            <th>Montant</th>
        </tr>';
        $historique = $vente->VenteTemesttre($anne);
            foreach ($historique as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    $html .= '<th>' .$cell.'</th>';
                }
                $html .= '</tr>';
            }
        $html .= '
        </tbody>
    </table>';

$html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="2" align="center">Vente Semesttre : '.$anne.'</th></tr>
        </thead>
        <tbody>';
        $html .= '<tr>
            <th>Numero de semestre</th>
            <th>Montant</th>
        </tr>';
        $historique = $vente->VenteSemesttre($anne);
            foreach ($historique as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    $html .= '<th>' .$cell.'</th>';
                }
                $html .= '</tr>';
            }
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
    <thead>';
    $html .=' <tr><th colspan="2" align="center">Depense Trimestre : '.$anne.'</th></tr>
    </thead>
    <tbody>';
    $html .= '<tr>
        <th>Numero de semestre</th>
        <th>Montant</th>
    </tr>';
    $historique = $depense->DepenseTemesttre($anne);
        foreach ($historique as $linefatcture) {
            $html .= '<tr>';
            foreach ($linefatcture as $key => $cell) {
                $html .= '<th>' .$cell.'</th>';
            }
            $html .= '</tr>';
        }
    $html .= '
    </tbody>
</table>';

$html .='<br><br><br> <table style="width:100%">
    <thead>';
    $html .=' <tr><th colspan="2" align="center">Depense Semestre : '.$anne.'</th></tr>
    </thead>
    <tbody>';
    $html .= '<tr>
        <th>Numero de semestre</th>
        <th>Montant</th>
    </tr>';
    $historique = $depense->DepenseSemesttre($anne);
        foreach ($historique as $linefatcture) {
            $html .= '<tr>';
            foreach ($linefatcture as $key => $cell) {
                $html .= '<th>' .$cell.'</th>';
            }
            $html .= '</tr>';
        }
    $html .= '
    </tbody>
</table>';

$html .='<br><br><br> <table style="width:100%">
    <thead>';
    $html .=' <tr><th colspan="2" align="center">Achat Trimestre : '.$anne.'</th></tr>
    </thead>
    <tbody>';
    $html .= '<tr>
        <th>Numero de semestre</th>
        <th>Montant</th>
    </tr>';
    $historique = $achat->AchatTemesttre($anne);
        foreach ($historique as $linefatcture) {
            $html .= '<tr>';
            foreach ($linefatcture as $key => $cell) {
                $html .= '<th>' .$cell.'</th>';
            }
            $html .= '</tr>';
        }
    $html .= '
    </tbody>
</table>';

$html .='<br><br><br> <table style="width:100%">
    <thead>';
    $html .=' <tr><th colspan="2" align="center">Achat Semesttre : '.$anne.'</th></tr>
    </thead>
    <tbody>';
    $html .= '<tr>
        <th>Numero de semestre</th>
        <th>Montant</th>
    </tr>';
    $historique = $achat->AchatSemesttre($anne);
        foreach ($historique as $linefatcture) {
            $html .= '<tr>';
            foreach ($linefatcture as $key => $cell) {
                $html .= '<th>' .$cell.'</th>';
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
$dompdf->stream("mon_fichier.pdf", array("Attachment" => 0));

?>