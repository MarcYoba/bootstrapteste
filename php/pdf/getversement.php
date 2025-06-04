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
$date = $_POST["date1"];
$dette = new Dette();
$versement = new Versement(2025);
$nomclient = $_POST["client"];

$somdette = 0; 
$sommversement = 0;

$date1 = $_POST["date1"];
$date2 = $_POST["date2"];
$dateDebut = new DateTime($date1);
if (isset($date1)) {
    if ((!empty($date1)) && (!empty($date2)) && ($nomclient == "ALL")) {
        $tabledette= $versement->AllVersementWeek($date1,$date2);
        $dateDebut = new DateTime($date1);
        $somdette = $dette->getSommeDette($date1,$date2);
        $sommversement = $versement->ByWeekVersement($date1,$date2);

    }else if ((!empty($date2)) && (!empty($date1)) && ($nomclient != "ALL")) {
        $tabledette= $versement->ByWeekVersementClient($date1,$date2,$nomclient);
        $dateDebut = new DateTime($date1);
        $somdette = $dette->getSommeDetteClient($date1,$date2, $nomclient);
        $sommversement = $versement->SommeWeekVersementClient($date1,$date2, $nomclient);
    }else if($nomclient == "ALL" && (!empty($date1))){
        $tabledette = $versement->ByVersementdate($date1);
        $somdette = $dette->getAllSommeDate($date1);
        $sommversement = $versement->ByDateVersement($date1);
    }else if($nomclient != "ALL" && (!empty($date1))){
        $tabledette = $versement->getVersementByClientBydate($date1,$nomclient);
        $dateDebut = new DateTime($date1);
        $somdette = $dette->getAllSommeDateClient($date1,$nomclient);
    }else if($_POST["client"] != "ALL"){
        $tabledette = $versement->ByVersemenClient($_POST["client"]);
        $dette = $dette->SommeDateClient($client);
        $sommversement = $versement->ByVersementIdClient($_POST["client"]);
    }else{
        $tabledette = $versement->AllVersementYear();
        $somdette = $dette->getAllSomme();
        $sommversement = $versement->TotalVersement(); 
    }
} else {
    // $date = date("Y-m-d");
    $tabledette = $versement->AllVersementYear();
    $somdette = $dette->getAllSomme();
    $sommversement = $versement->TotalVersement();
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
        $html .=' <tr><th colspan="3" align="center""> Rapport des Versement : '.$date." Au ".$date2.'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="3" align="center"> Rapport des Versement  </td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Date Versement</th>
                <th scope="col">Client</th>
                <th scope="col">versement</th>
            </tr>';
            
            
            if (count($tabledette)==1) {
                foreach ($tabledette as $key ) {
                    if (empty($key["dateversement"]) || empty($key["montant"])) {
                        # code...
                    } else {
                        $html .= '<tr>';
                        $html .= '<td>' .$key["dateversement"].'</td>';
                        $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                        $html .= '<td>' .$key["montant"].'</td>';
                    }
                }
            } else {
                foreach ($tabledette as $key ) {
                    $tableauDates = $dateDebut->format("Y-m-d");
                    
                    
                    if ((empty($key["dateversement"])) || empty($key["idclient"])) {
                        $html .= '<tr>';
                        $html .= '<td>'.$tableauDates.'</td>';
                        $html .= '<td>'.$client->getByIdClient($nomclient).'</td>';
                        $html .= '<td>-</td>';
                        // $html .= '<td>' .$versement->ByVersementIdClientDate($key["idclient"],$tableauDates).'</td>';
                        // $html .= '<td>'.$tableauDates.'</td>';
                        // $html .= '</tr>';
                        
                    }
                    else{
                         $html .= '<tr>';
                        $html .= '<td>' .$key["dateversement"].'</td>';
                        $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                        $html .= '<td>' .$key["montant"].'</td>';
                        // $html .= '<td>' .$versement->ByVersementIdClientDate($key["idclient"],$tableauDates).'</td>';
                        // $html .= '<td>'.$key["dateversement"]." " .$key["idclient"].'</td>';
                         $html .= '</tr>';
                        
                    }
                    $dateDebut->modify('+1 day');
                }
            }
                $html .= '<tr>';
                    $html .= '<td>Total</td>';
                    $html .= '<td> dette : '.$somdette.'</td>';
                    $html .= '<td>'.$sommversement.'</td>';
                    // $html .= '<td>'.$sommversement.'</td>';
                    // $html .= '<td>-</td>';
                $html .= '</tr>';

                $html .= '<tr>';
                    $html .= '<td>Reste a payer </td>';
                    // $html .= '<td>-</td>';
                    
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
                    
                    // $html .= '<td>-</td>';
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