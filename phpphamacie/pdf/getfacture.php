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


ini_set('memory_limit', '256M');
use Dompdf\Dompdf;
use chillerlan\QRCode\{QRCode, QROptions};

require '../../vendor/autoload.php';

$date = date("Y-m-d");

$vente = new Vente(0);
$client = new Client(0);
$formule = 1;

$dette = new Dette();
$versement = new Versement(1);

//var_dump($date);
$id =  $_GET["id"];

$facture = $vente->getFactureVente($id);
$inclient=$client->getClientByIdVente($id);
$donnees_vente = $vente->getVenteDyId($id);
$tabqrcod  =$facture;
if (is_array($facture)) {
    $tabqrcod = array_pop($tabqrcod);
}

$data   = 'M0822175619296A +237655271506 '.$inclient["firstname"]." ".$inclient["telephone"].$tabqrcod[0].$tabqrcod[1].$tabqrcod[3].$tabqrcod[2]."vente:".$id;
$qrcode = (new QRCode)->render($data);

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
            img {
            width: 100px;
            height: 100px;
        }
</style>
</head>
<body>';

$html .='<br><br><br> <table style="border-collapse: separate; border-spacing: 0px;">
        <thead>';
        
        $html .=' <tr><th  align="left"">CABINET VETERINAIRE DE SOA <br> '.$donnees_vente["datevente"]."<br> Client : ".$inclient["firstname"]."<br> Tel: ".$inclient["telephone"]."<br> Formule"." Vente N= ".$id.' 
        <br>  NRCCM:RC/YAE2022/B/2852 
        </th>
        </tr>
        <tr>
            <th>
            <img src="'.$qrcode.'" alt="QR Code" />    
        </th>
        </tr>
        </thead>
        <tbody>';
        $html .= '<tr>';
        
        $html .= '</tr>
            <tr>
            <th scope="col">Nom produit</th>
        </tr>';
        $facture = $vente->getFactureVentePrint($id);
            foreach ($facture as $linefatcture) {
                $html .= '<tr><td >';
                $i = 0;
                foreach ($linefatcture as $key => $cell) {
                    if ($i==0) {
                        $html .= $cell ." : ";
                    }
                    elseif ($i==1) {
                        $html .= " ".$cell ."x";
                    }elseif ($i==2) {
                        $html .= " ".$cell." =";
                    }else{
                        $html .= " ".$cell;
                    }
                    $i++;
                   
                }
                $html .= '</td></tr>';
            }
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