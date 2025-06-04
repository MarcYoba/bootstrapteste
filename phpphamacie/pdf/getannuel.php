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
                    if (!empty($cell)) {
                        if (strpos($cell,',')) {
                            $chaine = str_replace(',','<br>',$cell);
                            $html .= '<td>' .$chaine.'</td>';
                        } else {
                            $html .= '<td>' .$cell.'</td>';
                        }
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
            <th scope="col">date </th>
            <th scope="col">Operation </th>
            <th scope="col">List opration</th>
            <th scope="col">nomtant</th>
        </tr>';
    $facture = $caisse->SommeeMenseurl($mois);
    
        foreach ($facture as $linefatcture) {
        $html .= '<tr>';
        foreach ($linefatcture as $key => $cell) {
            if (!empty($cell)) {
            if (strpos($cell, ',')) {
                $chaine = str_replace(',', '<br>', $cell);
                $html .= '<td>' . $chaine . '</td>';
            } else {
                $html .= '<td>' . $cell . '</td>';
            }
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
            <th scope="col">date </th>
            <th scope="col">Operation </th>
            <th scope="col">List opration</th>
            <th scope="col">nomtant</th>
        </tr>';
        $facture = $depense->DepenseMensuelle($mois);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    if(!empty( $cell)){
                        if (strpos($cell,',')) {
                            $chaine = str_replace(',','<br>',$cell);
                            $html .= '<td>' .$chaine.'</td>';
                        } else {
                            $html .= '<td>' .$cell.'</td>';
                        }
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
        <th scope="col">date Versement </th>
        <th scope="col">list Montant </th>
        <th scope="col">nomtant</th>
        <th scope="col">motif</th>
    </tr>';
    $facture = $versement->VersementMensuel($mois);
        foreach ($facture as $linefatcture) {
            $html .= '<tr>';
            foreach ($linefatcture as $key => $cell) {
                if (!empty($cell)) {
                    if (strpos($cell,',')) {
                        $chaine = str_replace(',','<br>',$cell);
                        $html .= '<td>' .$chaine.'</td>';
                    } else {
                        $html .= '<td>' .$cell.'</td>';
                    }
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
    $html .= '<td colspan="8" align="center"> Commade Poussin </td>';
    $html .= '</tr>
        <tr>
        <th scope="col">Date</th>
        <th scope="col">Nom</th>
        <th scope="col">Quantite</th>
        <th scope="col">prix Unit</th>
        <th scope="col">montant</th>
        <th scope="col">Souche</th>
        <th scope="col">Avance</th>
        <th scope="col">Reste</th>
        <th scope="col">Status</th>
    </tr>';
    $tabpoussin =$poussin->getPoussinMonth($mois);
    $montant =0;
    $quantite =0;
    $avance =0;
    $reste =0;
    foreach ($tabpoussin as $key ) {
        $quantite +=$key["quantite"];
        $montant += $key["montantOm"] + $key["montantCash"];
        $avance += $key["montantOm"] + $key["montantCash"];
        $reste += $key["reste"];
        $html .= '<tr>';
        $html .= '<td>' .$key["dateCommande"].'</td>';
        $html .= '<td>' .$key["Nomclient"].'</td>';
        $html .= '<td>' .$key["quantite"].'</td>';
        $html .= '<td>' .$key["prixUnite"].'</td>';
        $html .= '<td>' . $key["montant"].'</td>';
        $html .= '<td>' .$key["souche"].'</td>';
        $html .= '<td>' .$key["montantOm"] + $key["montantCash"].'</td>';
        $html .= '<td>' .$key["reste"].'</td>';
        $html .= '<td>' .$key["statusCommande"].'</td>';
    $html .= '</tr>';
    } 
    $html .= '<tr>
    <td>-----</td>
    <td>-----</td>
    <td>'.$quantite.'</td>
    <td>-----</td>
    <td>' .$montant.' FCFA </td>
    <td>-----</td>
        <td>'.$avance.'</td>
        <td>'.$reste.'</td>
        <td>-----</td>
    </tr>';   
$html .= '
</tbody>
</table>';

$html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="7" align="center""> Suivie : </th></tr>
            </thead>
            <tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="7" align="center"> Suivie Anmale </td>';
                $html .= '</tr>
                    <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Client</th>
                    <th scope="col">jour</th>
                    <th scope="col">observation</th>
                    <th scope="col">conduit</th>
                    <th scope="col">montant</th>
                    <th scope="col">datejour</th>
                </tr>';
                $tabconsultation =$vaccin->getsuivianimaleMonth($mois);
                $montant =0;
                foreach ($tabconsultation as $key ) {
                    $montant += $key["montant"];
                    $html .= '<tr>';
                    $html .= '<td>' .$key["nom"].'</td>';
                    $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                    $html .= '<td>' . $key["jour"].'</td>';
                    $html .= '<td>' .$key["observation"].'</td>';
                    $html .= '<td>' .$key["conduit"].'</td>';
                    $html .= '<td>' .$key["montant"].'</td>';
                    $html .= '<td>' .$key["datejour"].'</td>';
                $html .= '</tr>';
                }
                $html .= '<tr>
                <td>-----</td>
                <td>' .$montant.' FCFA </td>
                    <td colspan="5">-----</td>
                </tr>';    
            $html .= '
            </tbody>
        </table>';

        $html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="6" align="center""> Vaccination : </th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="7" align="center"> Vaccination  </td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Nom</th>
                <th scope="col">Client</th>
                <th scope="col">typeVacin</th>
                <th scope="col">date vaccin</th>
                <th scope="col">date secondvacin</th>
                <th scope="col">montant</th>
                <th scope="col">avance</th>
            </tr>';
            $tabconsultation =$vaccin->getVaccinationMonth($mois);
            $montant =0;
            foreach ($tabconsultation as $key ) {
                $montant += $key["montant"];
                $html .= '<tr>';
                $html .= '<td>' .$key["nomSujet"].'</td>';
                $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                $html .= '<td>' . $key["typeVacin"].'</td>';
                $html .= '<td>' .$key["datevacin"].'</td>';
                $html .= '<td>' .$key["daterappel"].'</td>';
                $html .= '<td>' .$key["montant"].'</td>';
                $html .= '<td>' .$key["netpayer"].'</td>';
            $html .= '</tr>';
            } 
            $html .= '<tr>
            <td>-----</td>
            <td>' .$montant.' FCFA </td>
                <td colspan="4">-----</td>
            </tr>';  
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="5" align="center""> Terrain : </th></tr>
            </thead>
            <tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="5" align="center"> Terrain  </td>';
                $html .= '</tr>
                    <tr>
                    <th scope="col">localisation</th>
                    <th scope="col">Client</th>
                    <th scope="col">telephone</th>
                    <th scope="col">date jour</th>
                    <th scope="col">Montant</th>
                    
                </tr>';
                $tabconsultation =$vaccin->getTerrainMonth($mois);
                $montant =0;
                foreach ($tabconsultation as $key ) {
                    $montant += $key["Montant"];
                    $html .= '<tr>';
                    $html .= '<td>' .$key["localisation"].'</td>';
                    $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                    $html .= '<td>' . $key["telephone"].'</td>';
                    
                    $html .= '<td>' .$key["datejour"].'</td>';
                    $html .= '<td>' .$key["Montant"].'</td>';
                $html .= '</tr>';
                }  
                $html .= '<tr>
                <td>-----</td>
                <td>' .$montant.' FCFA </td>
                    <td colspan="3">-----</td>
                </tr>'; 
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