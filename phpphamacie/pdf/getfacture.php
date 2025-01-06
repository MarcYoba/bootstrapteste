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

require '../../vendor/autoload.php';
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;

$date = date("Y-m-d");

$vente = new Vente(0);
$client = new Client(0);
$formule = 1;

$dette = new Dette();
$versement = new Versement(1);

//var_dump($date);
$id =  $_GET["id"];

$facture = $vente->getFactureVente($id);

// Créer une instance de Dompdf
$dompdf = new Dompdf();

// Créer le contenu HTML du PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Facture</title>
    <style>
        body {
            font-size: 09pt;
        }
        table, th, td {
        border-collapse: collapse;
        }
        @Page {
                    footer {
                       position: fixed;
                        bottom: 0cm;
                        left: 0cm;
                        right: 0cm;
                        height: 2cm;
                        text-align: left;
                    }
                }
</style>
</head>
<body>';

$html .='<br><br><br> <table style="border-collapse: separate; border-spacing: 0px;">
        <thead>';
        $inclient=$client->getClientByIdVente($id);
        $html .=' <tr><th  align="left"">AFRICA BELIEVE GROUP SARL : '.$date." Client : ".$inclient["firstname"]." Tel: ".$inclient["telephone"]."<br> Formule"." Vente N= ".$id.' Cabinet veterinaire-provenderie
         N cont: M0822175619296A NRCCM:RC/YAE2022/B/2852 YDE-SOA FIN GOUDRON +237 655 271506
        </th></tr>
        </thead>
        <tbody>';
        $html .= '<tr>';
        
        $html .= '</tr>
            <tr>
            <th scope="col">Nom produit</th>
        </tr>';
        $facture = $vente->getFactureVente($id);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    $html .= '<td style="width: 10%;">' ;
                    $html .=$cell;
                    $html .= '</td>' ;
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
$dompdf->setPaper('A6', 'portrait');
$dompdf->render();
$dompdf->stream("mon_fichier.pdf", array("Attachment" => 0));

?>