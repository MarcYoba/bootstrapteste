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

$vente = new Vente(0);
$client = new Client(0);
$formule = 1;
$date = $_POST['datedette'];
$dette = new Dette();
$versement = new Versement(1);
$nomclient = $_POST["client"];

$somdette = 0; 
$sommversement = 0;

if (isset($_POST['datedette'])) {
    if ((!empty($_POST['datedett2'])) && (!empty($_POST['datedette'])) && ($nomclient == "ALL")) {
        $tabledette= $dette->getAllDetteIntervall($_POST['datedette'],$_POST['datedett2']);
        $dateDebut = new DateTime($_POST['datedette']);
        $somdette = $dette->getSommeDette($_POST['datedette'],$_POST['datedett2']);

    }else if ((!empty($_POST['datedett2'])) && (!empty($_POST['datedette'])) && ($nomclient != "ALL")) {
        $tabledette= $dette->getAllDetteIntervallClient($_POST['datedette'],$_POST['datedett2'],$nomclient);
        $dateDebut = new DateTime($_POST['datedette']);
        $somdette = $dette->getSommeDetteClient($_POST['datedette'],$_POST['datedett2'], $nomclient);
    }
    else if (empty($_POST['datedette']) && $nomclient == "ALL") {
        $tabledette = $dette->getAllDette();
        $dateDebut = new DateTime($_POST['datedette']);
        $somdette = $dette->getAllSomme();
    }else if($nomclient == "ALL" && (!empty($_POST['datedette']))){
        $tabledette = $dette->getAllDetteDate($_POST['datedette']);
        $somdette = $dette->getAllSommeDate($_POST['datedette']);
    }else if($nomclient != "ALL" && (!empty($_POST['datedette']))){
        $tabledette = $dette->getAllDetteDateClient($_POST['datedette'],$nomclient);
        $dateDebut = new DateTime($_POST['datedette']);
        $somdette = $dette->getAllSommeDateClient($_POST['datedette'],$nomclient);
    }else if($_POST["client"] != "ALL"){
        $tabledette = $dette->getAllDetteId($_POST["client"]);
        $dette = $dette->SommeDateClient($client);
    }
} else {
    $date = date("Y-m-d");
    $tabledette = $dette->getAllDette();
    $somdette = $dette->getAllSomme();
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
        $html .=' <tr><th colspan="5" align="center""> Rapport des dette : '.$date." Au ".$_POST['datedett2'].'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="5" align="center"> Rapport des dette  </td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Date dette</th>
                <th scope="col">Client</th>
                <th scope="col">Credit</th>
                <th scope="col">Versement</th>
                <th scope="col">Date versement</th>
              
            </tr>';
            
            
            if (empty($tabledette)) {
                $tabledette = $versement->getVersementByClientBydate($_POST['datedette'],$nomclient);
                
                foreach ($tabledette as $key=>$value ) {
                    $html .= '<tr>';
                    $html .= '<td>' .$value["dateversement"].'</td>';
                    $html .= '<td>' .$client->getByIdClient($value["idclient"]).'</td>';
                    $html .= '<td>-</td>';
                    
                    $sommversement = $sommversement +  $versement->ByVersementClientdate($value["iddette"]);
                    $html .= '<td>' .$versement->ByVersementClientdate($value["iddette"]).'</td>';
                    $html .= '</tr>';
                }
            } else {
                foreach ($tabledette as $key ) {
                    $tableauDates = $dateDebut->format("Y-m-d");
                    $sommversement = $sommversement + $versement->ByVersementIdClientDate($nomclient,$tableauDates);
                    
                    if ((empty($key["datedette"])) || empty($key["idclient"])) {
                        $html .= '<tr>';
                        $html .= '<td>'.$tableauDates.'</td>';
                        $html .= '<td>'.$client->getByIdClient($nomclient).'</td>';
                        $html .= '<td>-</td>';
                        $html .= '<td>' .$versement->ByVersementIdClientDate($nomclient,$tableauDates).'</td>';
                        $html .= '<td>'.$tableauDates.'</td>';
                        $html .= '</tr>';
                        
                    }else{
                        $html .= '<tr>';
                        $html .= '<td>' .$key["datedette"].'</td>';
                        $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                        $html .= '<td>' .$key["montant"].'</td>';
                        $html .= '<td>' .$versement->ByVersementIdClientDate($nomclient,$tableauDates).'</td>';
                        $html .= '<td>'.$key["datedette"].'</td>';
                        $html .= '</tr>';
                        
                    }
                    $dateDebut->modify('+1 day');
                }
            }
                $html .= '<tr>';
                    $html .= '<td>Total</td>';
                    $html .= '<td>-</td>';
                    $html .= '<td>'.$somdette.'</td>';
                    $html .= '<td>'.$sommversement.'</td>';
                    $html .= '<td>-</td>';
                $html .= '</tr>';

                $html .= '<tr>';
                    $html .= '<td>Reste a payer </td>';
                    $html .= '<td>-</td>';
                    
                    if ($somdette>$sommversement) {
                        $html .= '<td style="color: #FF3300;">client doit comme argent</td>';
                        $html .= '<td style="color: #FF3300;">'.$somdette-$sommversement.'</td>';
                    }else if($somdette == 0){
                        $html .= '<td style="color: #F6CC01;">versement</td>';
                        $html .= '<td style="color: #F6CC01;">'.$sommversement.'</td>';
                    }
                     else {
                        $html .= '<td style="color: #66CC00;">Provenderie doit comme argent</td>';
                        $html .= '<td style="color: #66CC00;">'.$somdette-$sommversement.'</td>';
                    }
                    
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
$dompdf->stream("mon_fichier.pdf", array("Attachment" => 0));