<?php

require('../../fpdf186/fpdf.php');

require_once("../bdmutilple/getpoussin.php");
require_once("../bdmutilple/getclient.php");

ini_set('memory_limit', '256M');
use Dompdf\Dompdf;
use chillerlan\QRCode\{QRCode, QROptions};

require '../../vendor/autoload.php';

$date = date("Y-m-d");

$poussin = new Poussin();
$client = new Client(1);
//var_dump($date);
$id =  $_GET["id"];
$dompdf = new Dompdf();
$getFacture = 0;
$getFacture = $poussin->getFacture($id);
$idclient = $client->getByNameClient($getFacture["Nomclient"]);
$infoclient = $client->getAllByIdClient($idclient);
if (!is_array($getFacture)) {

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
$data   = 'M0822175619296A +237655271506 '.$getFacture["Nomclient"]." ".$infoclient["telephone"]." ".$getFacture["dateCommande"]." Commande Poussin : ".$id;
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
        
        $html .=' <tr><th  align="center"">AFRICA BELIEVE GROUP SARL <br> '.$date." Client : ".$getFacture["Nomclient"]."<br> Tel: ".$infoclient["telephone"]."<br> Commande Poussin "."<br> N= ".$id.' 
        <br> M0822175619296A
        
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
        $avance = 0;
            if ($getFacture["montantCash"] > 0) {
                $avance+= $getFacture["montantCash"];
            } else if ($getFacture["montantOm"] > 0) {
                $avance+= $getFacture["montantOm"];
            }
            $html .= '<tr>';   
            $html .= '<td> '.
            " Nom :".$getFacture["Nomclient"].
            "<br> Telephone :".$infoclient["telephone"].
            "<br> Quantite :".$getFacture["quantite"].
            "x<br> Prix Unite ".$getFacture["prixUnite"].
            "FCFA <br> Montant : ".$getFacture["montant"].
            "FCFA <br> Avance : ".$avance.
            "FCFA<br> reste : ".$getFacture["reste"].
            "FCFA <br> Souche : ".$getFacture["souche"].
            "<br> date Commande : ".$getFacture["dateCommande"].
            '<br> date Livraison : '.$getFacture["dateLivraison"].
            "<br> Status Commande : ".$getFacture["statusCommande"].
            '</td>';   
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