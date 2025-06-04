<?php

require('../../fpdf186/fpdf.php');

require_once("../bdmutilple/getversement.php");
require_once("../bdmutilple/getclient.php");

ini_set('memory_limit', '256M');
use Dompdf\Dompdf;
use chillerlan\QRCode\{QRCode, QROptions};

require '../../vendor/autoload.php';

$date = date("Y-m-d");

$versement = new Versement(1);
$client = new Client(1);
//var_dump($date);
$id =  $_GET["id"];
$dompdf = new Dompdf();
$facture = 0;
$getFacture = $versement->getFacture($id);

if (is_array($getFacture)) {
    $facture = $client->getCleint($getFacture["idclient"]);
}
if (is_array($facture)) {
    $facture = $client->getCleint($getFacture["idclient"]);
} else{
    $html = '
    <!DOCTYPE html>
    <html>
    <body>
    </body>
    </html>';
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A6', 'portrait');
    $dompdf->render();
    $dompdf->stream("mon_fichier.pdf", array("Attachment" => 0));
}
$data   = 'M0822175619296A +237655271506 '.$facture["firstname"]." ".$facture["telephone"]." ".$facture["datecreation"]."Versement : ".$id;
$qrcode = (new QRCode)->render($data);

// Créer le contenu HTML du PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title> Vetsement </title>
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
                        height: 0cm;
                        text-align: left;
                    }
                }
        img {
            width: 100px;
            height: 100px;
        }
</style>
</head>
<body>';

$html .='<table style="border-collapse: separate; border-spacing: 0px;" >
        <thead>';
        
        $html .=' <tr><th  align="center"">CABINET VETERINAIRE DE SOA <br> '.$date." Client : ".$facture["firstname"]."<br> Tel: ".$facture["telephone"]."<br> Versement "."<br> N= ".$id.' 
        <br>  NRCCM:RC/YAE2022/B/2852
        
        <tr>
            <th colspan="1"><img src="'.$qrcode.'" alt="QR Code" />  </th>
        </tr>
        </thead>
        <tbody>';
        $html .= '<tr>';
        
        $html .= '</tr>
            <tr>
            <th colspan="1"> Versement </th>
        </tr>';
            $html .= '<tr>';  
            $montant =  $getFacture["montant"] + $getFacture["Om"] + $getFacture["banque"];
            $html .= '<td> '." Objet :".$getFacture["motif"]."<br> Nom :".$facture["firstname"]."<br> Montant ".$montant.'FCFA</td>';   
            $html .= '</tr>';
        $html .= '
        </tbody>
    </table>';

$html .= '<br>TELEPHONE : YDE-SOA FIN GOUDRON <br> 655271506-673925507-676359056
</body>
</html>';

// Charger le contenu HTML dans Dompdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A6', 'portrait');
$dompdf->render();
$dompdf->stream("mon_fichier.pdf", array("Attachment" => 0));

?>