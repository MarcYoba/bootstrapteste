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
require_once("../bdmutilple/getpoussin.php");
require_once("../bdmutilple/getvaccin.php");

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
$poussin = new Poussin();
$vaccin = new Vaccin();

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
                <td scope="col" colspan="8" align="center">Rapport Mensuel</td>
                </tr>
        ';
        
        $html .= '
            <tr>
            <th scope="col">Date vente</th>
            <th scope="col">Q.Total</th>
            <th scope="col">M.Total</th>
            <th scope="col">M.Cash</th>
            <th scope="col">M.Dette</th>
            <th scope="col">M.OM</th>
            <th scope="col">Reduction</th>
            <th scope="col">M.Banque</th>

        </tr>';
        $facture = $vente->SommeAnnuel($mois,$date);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    if (!empty($cell)) {
                        $html .= '<td>' .$cell.'</td>';
                    } else {
                        $html .= '<td></td>';
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
        <td scope="col" colspan="8" align="center">Rapport Mensuel Achat</td>
        
        </tr>';
        
        $html .= '
            <tr>
            <th scope="col">Date Achat</th>
            <th scope="col">Liste prix</th>
            <th scope="col">P.Total</th>
            <th scope="col">Liste quantite</th>
            <th scope="col">Q.Total </th>
            <th scope="col">Liste Montant </th>
            <th scope="col">M.Total </th>
            <th scope="col">Produit </th>
            
        </tr>';
        $facture = $achat->Sommemenseule($mois,$date);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    if (!empty($cell)) {
                        // if (strpos($cell,',')) {
                        //     $chaine = str_replace(',','<br>',$cell);
                        //     $html .= '<td>' .$chaine.'</td>';
                        // } else {
                            $html .= '<td>' .$cell.'</td>';
                        // }
                    }else{
                        $html .= '<td></td>';
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
            <th scope="col">Date </th>
            <th scope="col">Operation </th>
            <th scope="col">Liste opration</th>
            <th scope="col">M.Total</th>
        </tr>';
    $facture = $caisse->SommeeMenseurl($mois,$date);
    
        foreach ($facture as $linefatcture) {
        $html .= '<tr>';
        foreach ($linefatcture as $key => $cell) {
            if (!empty($cell)) {
            // if (strpos($cell, ',')) {
            //     $chaine = str_replace(',', '<br>', $cell);
            //     $html .= '<td>' . $chaine . '</td>';
            // } else {
                $html .= '<td>' . $cell . '</td>';
            // }
            } else {
            $html .= '<td></td>';
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
            <th scope="col">Date </th>
            <th scope="col">Operation </th>
            <th scope="col">M.Total</th>
            <th scope="col">Liste opration</th>
        </tr>';
        $facture = $depense->DepenseMensuelle($mois,$date);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    if(!empty( $cell)){
                        // if (strpos($cell,',')) {
                        //     $chaine = str_replace(',','<br>',$cell);
                        //     $html .= '<td>' .$chaine.'</td>';
                        // } else {
                            $html .= '<td>' .$cell.'</td>';
                        // }
                    }else{
                        $html .= '<td></td>';
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
        <th scope="col">Date Versement </th>
        <th scope="col">liste Montant </th>
        <th scope="col">M.Total</th>
        <th scope="col">Motif</th>
    </tr>';
    $facture = $versement->VersementMensuel($mois,$date);
        foreach ($facture as $linefatcture) {
            $html .= '<tr>';
            foreach ($linefatcture as $key => $cell) {
                if (!empty($cell)) {
                    // if (strpos($cell,',')) {
                    //     $chaine = str_replace(',','<br>',$cell);
                    //     $html .= '<td>' .$chaine.'</td>';
                    // } else {
                        $html .= '<td>' .$cell.'</td>';
                    // }
                }else{
                    $html .= '<td></td>';
                }    
            }
            $html .= '</tr>';
        }
    $html .= '
    </tbody>
</table>';


$html .='<br><br><br> <table style="width:100%">
<thead>';
$html .=' <tr><th colspan="8" align="center""> Poussin : '.date("d-m-Y").'</th></tr>
</thead>
<tbody>';
    $html .= '<tr>';
    $html .= '<td colspan="7" align="center"> Commade Poussin </td>';
    $html .= '</tr>
        <tr>
        <th scope="col">Date</th>
        <th scope="col">prix Unit</th>
        <th scope="col">M.Total</th>
        <th scope="col">Q.Total</th>
        <th scope="col">M.Cash</th>
        <th scope="col">M.Om</th>
        <th scope="col">M.Reste</th>
    </tr>';
    $tabpoussin =$poussin->getPoussinMonth($mois,$date);
    foreach ($tabpoussin as $linefatcture) {
        $html .= '<tr>';
        foreach ($linefatcture as $key => $cell) {
            if(!empty( $cell)){
                        // if (strpos($cell,',')) {
                        //     $chaine = str_replace(',','<br>',$cell);
                        //     $html .= '<td>' .$chaine.'</td>';
                        // } else {
                            $html .= '<td>' .$cell.'</td>';
                        // }
            }else{
                $html .= '<td></td>';
            }

            }
        $html .= '</tr>';
    }

$html .= '
</tbody>
</table>';

$html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="2" align="center""> Suivie : </th></tr>
            </thead>
            <tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="2" align="center"> Suivie Anmale </td>';
                $html .= '</tr>
                    <tr>
                    
                    <th scope="col">Total</th>
                    <th scope="col">M.Total</th>
                    
                </tr>';
                $tabconsultation =$vaccin->getsuivianimaleMonth($mois,$date);
                foreach ($tabconsultation as $linefatcture) {
                    $html .= '<tr>';
                    foreach ($linefatcture as $key => $cell) {
                        if(!empty( $cell)){
                                    // if (strpos($cell,',')) {
                                    //     $chaine = str_replace(',','<br>',$cell);
                                    //     $html .= '<td>' .$chaine.'</td>';
                                    // } else {
                                        $html .= '<td>' .$cell.'</td>';
                                    // }
                        }else{
                            $html .= '<td></td>';
                        }

                        }
                    $html .= '</tr>';
                }   
            $html .= '
            </tbody>
        </table>';

        $html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="3" align="center""> Vaccination : </th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="3" align="center"> Vaccination  </td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Total</th>
                <th scope="col">M.Total</th>
                <th scope="col">Net Payer</th>
            </tr>';
            $tabconsultation =$vaccin->getVaccinationMonth($mois,$date);
            foreach ($tabconsultation as $linefatcture) {
                    $html .= '<tr>';
                    foreach ($linefatcture as $key => $cell) {
                        if(!empty( $cell)){
                                    // if (strpos($cell,',')) {
                                    //     $chaine = str_replace(',','<br>',$cell);
                                    //     $html .= '<td>' .$chaine.'</td>';
                                    // } else {
                                        $html .= '<td>' .$cell.'</td>';
                                    // }
                        }else{
                            $html .= '<td></td>';
                        }

                        }
                    $html .= '</tr>';
                } 
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="2" align="center""> Terrain : </th></tr>
            </thead>
            <tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="2" align="center"> Terrain  </td>';
                $html .= '</tr>
                    <tr>
                    <th scope="col">Total</th>
                    <th scope="col">M.Total</th>
                </tr>';
                $tabconsultation =$vaccin->getTerrainMonth($mois,$date);
                foreach ($tabconsultation as $linefatcture) {
                    $html .= '<tr>';
                    foreach ($linefatcture as $key => $cell) {
                        if(!empty( $cell)){
                                    // if (strpos($cell,',')) {
                                    //     $chaine = str_replace(',','<br>',$cell);
                                    //     $html .= '<td>' .$chaine.'</td>';
                                    // } else {
                                        $html .= '<td>' .$cell.'</td>';
                                    // }
                        }else{
                            $html .= '<td></td>';
                        }

                        }
                    $html .= '</tr>';
                }
            $html .= '
            </tbody>
        </table>';

        $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="2" align="center""> Consultation : </th></tr>
            </thead>
            <tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="2" align="center"> Consultation  </td>';
                $html .= '</tr>
                    <tr>
                    <th scope="col">M.Total</th>
                    <th scope="col">Q.Total</th>
                </tr>';
                $tabconsultation =$vaccin->getConsultationMonth($mois,$date);
                foreach ($tabconsultation as $linefatcture) {
                    $html .= '<tr>';
                    foreach ($linefatcture as $key => $cell) {
                        if(!empty( $cell)){
                                    // if (strpos($cell,',')) {
                                    //     $chaine = str_replace(',','<br>',$cell);
                                    //     $html .= '<td>' .$chaine.'</td>';
                                    // } else {
                                        $html .= '<td>' .$cell.'</td>';
                                    // }
                        }else{
                            $html .= '<td></td>';
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