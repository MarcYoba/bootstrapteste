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
$depense = new Depense(0);
$vente = new Vente(0);
$client = new Client(0);
$achat = new Achat(0);
$formule = 1;
$caisse = new Caise(0);
$dette = new Dette();
$versement = new Versement(1);
$mois = $_POST["mois"];
//var_dump($date);

// Créer une instance de Dompdf
$dompdf = new Dompdf();

// Créer le contenu HTML du PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Rapport Mensuelle</title>
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
        
        $html .='
        </thead>
        <tbody>';
        $html .= '<tr> 
                <td scope="col" colspan="7" align="center">Rapport Mensuel</td>
                </tr>
        ';
        
        $html .= '
            <tr>
            <th scope="col">Date vente</th>
            <th scope="col">Quantite</th>
            <th scope="col">Montant</th>
            <th scope="col">MontantCash</th>
            <th scope="col">Dette </th>
            <th scope="col">OM </th>
            <th scope="col">Reduction </th>
            
        </tr>';
        $facture = $vente->SommeAnnuel($mois);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    $html .= '<td>' .$cell.'</td>';
                }
                $html .= '</tr>';
            }
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
        <thead>';
        
        $html .='
        </thead>
        <tbody>';
        $html .= '<tr> 
        <td scope="col" colspan="8" align="center">Rapport Mensuel Achat</td>
        
        </tr>';
        
        $html .= '
            <tr>
            <th scope="col">date Achat</th>
            <th scope="col">liste prix</th>
            <th scope="col">Som Prix</th>
            <th scope="col">list quantite</th>
            <th scope="col">Som Quantite </th>
            <th scope="col">list Montant </th>
            <th scope="col">Som Montant </th>
            <th scope="col">Produit </th>
            
        </tr>';
        $facture = $achat->Sommemenseule($mois);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    if (strpos($cell,',')) {
                        $chaine = str_replace(',','<br>',$cell);
                        $html .= '<td>' .$chaine.'</td>';
                    } else {
                        $html .= '<td>' .$cell.'</td>';
                    }
                    
                    
                }
                $html .= '</tr>';
            }
        $html .= '
        </tbody>
    </table>';


    $html .='<br><br><br> <table style="width:100%">
        <thead>';
        
        $html .='
        </thead>
        <tbody>';
        $html .= '<tr> 
        <td scope="col" colspan="4" align="center">Rapport Mensuel Caisse</td>
        
        </tr>';
        
        $html .= '
            <tr>
            <th scope="col">date </th>
            <th scope="col">Operation </th>
            <th scope="col">List opration</th>
            <th scope="col">nomtant</th>
        </tr>';
        $facture = $caisse->SommeeMenseurl($mois);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    if (strpos($cell,',')) {
                        $chaine = str_replace(',','<br>',$cell);
                        $html .= '<td>' .$chaine.'</td>';
                    } else {
                        $html .= '<td>' .$cell.'</td>';
                    }
                    
                    
                }
                $html .= '</tr>';
            }
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
        <thead>';
        
        $html .='
        </thead>
        <tbody>';
        $html .= '<tr> 
        <td scope="col" colspan="4" align="center">Rapport Mensuel Depense</td>
        
        </tr>';
        
        $html .= '
            <tr>
            <th scope="col">date </th>
            <th scope="col">Operation </th>
            <th scope="col">List opration</th>
            <th scope="col">nomtant</th>
        </tr>';
        $facture = $depense->DepenseMensuelle($mois);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    if (strpos($cell,',')) {
                        $chaine = str_replace(',','<br>',$cell);
                        $html .= '<td>' .$chaine.'</td>';
                    } else {
                        $html .= '<td>' .$cell.'</td>';
                    }
                    
                    
                }
                $html .= '</tr>';
            }
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
    <thead>';
    
    $html .='
    </thead>
    <tbody>';
    $html .= '<tr> 
    <td scope="col" colspan="4" align="center">Rapport Mensuel Versement</td>
    
    </tr>';
    
    $html .= '
        <tr>
        <th scope="col">date Versement </th>
        <th scope="col">list Montant </th>
        <th scope="col">nomtant</th>
        <th scope="col">motif</th>
    </tr>';
    $facture = $versement->VersementMensuel($mois);
        foreach ($facture as $linefatcture) {
            $html .= '<tr>';
            foreach ($linefatcture as $key => $cell) {
                if (strpos($cell,',')) {
                    $chaine = str_replace(',','<br>',$cell);
                    $html .= '<td>' .$chaine.'</td>';
                } else {
                    $html .= '<td>' .$cell.'</td>';
                }
                
                
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