<?php

require('../../fpdf186/fpdf.php');
require_once("../bdmutilple/getvente.php");
require_once("../bdmutilple/getdepense.php");
require_once("../bdmutilple/getversement.php");
require_once("../bdmutilple/getachat.php");
require_once("../bdmutilple/getcaise.php");
require_once("../bdmutilple/getdette.php");

require '../../vendor/autoload.php';
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;

    $date = 0;
$depense = new Depense(0);
$vente = new Vente(0);
$achat = new Achat(0);
$formule = 1;
$caisse = new Caise(0);
$dette = new Dette();
$versement = new Versement(1);
$mois = 0;

if (isset($_POST["mois"])) {
    if (empty($_POST["date"])) {
        $date = date("Y-m-d");
    }else{
        $date = $_POST["date"];
    }
    $mois = $_POST["mois"];
    header('Location:getannuel.php?mois='.$mois.".".$date);
}else{
    $mois = $_GET["mois"];
    $mois = explode('.',$mois);
    $date = $mois[1];
    $mois = $mois[0];
    
}



$dompdf = new Dompdf();


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
<body>
<h1 style="text-align: center;">Rapport Mensuelle</h1>
<h2 style="text-align: center;">Mois: '.$mois.'</h2>
<img src="php/pdf/image.jpg" alt="Logo" />
<p style="text-align: center;">Date: '.$date.'</p>
';

$html .='<br><br><br> <table style="width:100%">
        <thead>';

        $html .='
        </thead>
        <tbody>';
        $html .= '<tr> 
                <td scope="col" colspan="8" align="center">Rapport vente Mensuel</td>
                </tr>
        ';
        
        $html .= '
            <tr>
            <th scope="col">Date vente</th>
            <th scope="col">Q.Total</th>
            <th scope="col">M.Total</th>
            <th scope="col">M.Cash</th>
            <th scope="col">M.Dette </th>
            <th scope="col">M.OM</th>
            <th scope="col">Reduction</th>
            <th scope="col">M.Banque</th>
            
        </tr>';
        $facture = $vente->SommeAnnuel($mois,$date);
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
            <th scope="col">P.Total</th>
            <th scope="col">list quantite</th>
            <th scope="col">Q.Total </th>
            <th scope="col">list Montant </th>
            <th scope="col">M.Total </th>
            <th scope="col">Produit </th>
            
        </tr>';
        $facture = $achat->Sommemenseule($mois,$date);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    // if ($cell) {
                    //     //strpos($cell,',')
                    //     $chaine = str_replace(',','<br>',$cell);
                    //     $html .= '<td>' .$chaine.'</td>';
                    // } else {
                        $html .= '<td>' .$cell.'</td>';
                    // }
                    
                    
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
            <th scope="col">M.Total</th>
        </tr>';
        $facture = $caisse->SommeeMenseurl($mois,$date);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    // if ($cell) {
                    //     //strpos($cell,',')
                    //     $chaine = str_replace(',','<br>',$cell);
                    //     $html .= '<td>' .$chaine.'</td>';
                    // } else {
                        $html .= '<td>' .$cell.'</td>';
                    // }
                    
                    
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
            <th scope="col">M.total</th>
            <th scope="col">List opration</th>
        </tr>';
        $facture = $depense->DepenseMensuelle($mois,$date);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    // if ($cell) {
                    //     //strpos($cell,',')
                    //     $chaine = str_replace(',','<br>',$cell);
                    //     $html .= '<td>' .$chaine.'</td>';
                    // } else {
                        $html .= '<td>' .$cell.'</td>';
                    // }
                    
                    
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
    $facture = $versement->VersementMensuel($mois,$date);
        foreach ($facture as $linefatcture) {
            $html .= '<tr>';
            foreach ($linefatcture as $key => $cell) {
                // if (strpos($cell,',')) {
                //     $chaine = str_replace(',','<br>',$cell);
                //     $html .= '<td>' .$chaine.'</td>';
                // } else {
                    $html .= '<td>' .$cell.'</td>';
                // }
                
                
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
$dompdf->stream("mon_fichier_annuel.pdf", array("Attachment" => 0));

?>