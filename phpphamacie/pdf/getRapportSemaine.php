<?php
require_once("../connexion.php");
require('../../fpdf186/fpdf.php');
require_once("../bdmutilple/getvente.php");
require_once("../bdmutilple/getdepense.php");
require_once("../bdmutilple/getversement.php");
require_once("../bdmutilple/getachat.php");
require_once("../bdmutilple/getfournisseur.php");
require_once("../bdmutilple/getclient.php");
require_once("../bdmutilple/getcaise.php");
require_once("../bdmutilple/trievalue.php");
require_once("../bdmutilple/getpoussin.php");
require_once("../bdmutilple/getvaccin.php");

ini_set('memory_limit', '256M');
require '../../vendor/autoload.php';
use Dompdf\Dompdf;

$datedebut = $_POST["datedebutsemain"];
$datedefin = $_POST["datefinsemain"];

//var_dump($date);

$formule = 1;
$prix = 0;
$montant = 0;

$vente = new Vente($datedebut);
$depense = new Depense($datedebut);
$versement = new Versement($datedebut);
$achat = new Achat($datedebut);
$fournisseur = new Fournisseur($datedebut);
$client = new Client($datedebut);
$caise = new Caise($datedebut);
$trie = new TrieValue();
$poussin = new Poussin();
$vaccin = new Vaccin();
$value = $vente->getIdVenteByWeek($datedebut,$datedefin);

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
<body>
    <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="6" align="center""> rapport Vente du : '.$datedebut." au ".$datedefin.'</th></tr>
        </thead>
        <tbody>';
        foreach ($value as $line) {
            $inclient=$client->getClientByIdVente($line["id"]);
            $html .= '<tr>';
            $html .= '<td colspan="6" align="center"> Facture ' . $formule." Vente N= ".$line["id"]." Client : ".$inclient["firstname"]." Tel: ".$inclient["telephone"]." Tel: ".$inclient["telephone"]." utilisateur ".$line["iduser"]."/".$line["heure"]."/".$line["statusvente"].'</td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Nom produit</th>
                <th scope="col">quantite</th>
                <th scope="col">prix</th>
                <th scope="col">montant </th>
                <th scope="col">Typepaiement</th>
                <th scope="col">datevente</th>
            </tr>';
            $facture = $vente->getFactureVente($line["id"]);
    //var_dump($facture);
            foreach ($facture as $linefatcture) {
                $html .= '<tr>';
                foreach ($linefatcture as $key => $cell) {
                    $html .= '<td>' .$cell.'</td>';
                }
                $html .= '</tr>';
            }
            $formule++;
        }
        $html .= '
        </tbody>
    </table>';
        
        $html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="9" align="center""> Resultat vente du : '.$datedebut."-".$datedefin.'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="9" align="center"> Recapitulatif Vente </td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Total Vente Net</th>
                <th scope="col">Total Vente - Reduction</th>
                <th scope="col">Total Cash</th>
                <th scope="col">Total OM</th>
                <th scope="col">Total Credit </th>
                <th scope="col">Total reduction</th>
                <th scope="col">Total sortie caise</th>
                <th scope="col">Total Versement</th>
                <th scope="col">Net en Caise</th>
            </tr>';
                $html .= '<tr>';
                    $html .= '<td>' .$vente->getSommeVenteWeek($datedebut,$datedefin).'</td>';
                    $html .= '<td>' .$vente->getSommeVenteWeek($datedebut,$datedefin)-$vente->getSommeReductionWeek($datedebut,$datedefin).'</td>';
                    $html .= '<td>' .$vente->getSommeCashWeek($datedebut,$datedefin).'</td>';
                    $html .= '<td>' .$vente->getSommeOmWeek($datedebut,$datedefin).'</td>';
                    $html .= '<td>' .$vente->getSommeCreditWeek($datedebut,$datedefin).'</td>';
                    $html .= '<td>' .$vente->getSommeReductionWeek($datedebut,$datedefin).'</td>';
                    $html .= '<td>' .($caise->getByWeekSortie($datedebut,$datedefin)).'</td>';
                    $html .= '<td>' .$versement->ByWeekVersement($datedebut,$datedefin).'</td>';
                    $html .= '<td>' .(((($vente->getSommeCashWeek($datedebut,$datedefin))-0)+$caise->getByWeekSortie($datedebut,$datedefin))-0).'</td>';
                $html .= '</tr>';
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="3" align="center""> Tableau caisse : '.$datedebut."-".$datedefin.'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="3" align="center"> Recapitulatif Mouvement caisse </td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Operation </th>
                <th scope="col">Montant</th>
                <th scope="col">date operation</th>
            </tr>';
            $tabcaisse = $caise->AllSortieCaiseWeek($datedebut,$datedefin);
            foreach ($tabcaisse as $key ) {
                $html .= '<tr>';
                $html .= '<td>' .$key["operation"].'</td>';
                $html .= '<td>' .$key["montant"].'</td>';
                $html .= '<td>' .$key["dateoperation"].'</td>';
            $html .= '</tr>';
            }   
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="3" align="center""> Quantite Pour chaque produit : '.$datedebut."-".$datedefin.'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="3" align="center"> Recapitulatif Quantite Vendue </td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Mon du produit </th>
                <th scope="col">Quantite</th>
                <th scope="col">Date</th>
            </tr>';
            $quantiteproduit = $vente->getSommeProduitWeek($datedebut,$datedefin);
            foreach ($quantiteproduit as $key ) {
                $html .= '<tr>';
                $html .= '<td>' . $trie->RemoveChaine("provenderie",$key["nomproduit"]).'</td>';
                $html .= '<td>' .round($key["quantite"],2).'</td>';
                $html .= '<td>' .$key["datefacture"].'</td>';
            $html .= '</tr>';
            }   
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="6" align="center""> Resultat Versement : '.$datedebut."-".$datedefin.'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="6" align="center"> Recapitulatif Versement </td> </tr>';
            $html .= '
                <tr>
                <th scope="col">Nom client</th>
                <th scope="col">montant</th>
                <th scope="col">OM</th>
                <th scope="col">Montant cash</th>
                <th scope="col">Motif</th>
                <th scope="col">dateversement</th>
            </tr>';
            $tabversement = $versement->AllVersementWeek($datedebut,$datedefin);
            foreach ($tabversement as $key ) {
                $html .= '<tr>';
                $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                $html .= '<td>' .$key["montant"].'</td>';
                $html .= '<td>' .$key["Om"].'</td>';
                $html .= '<td>' .$key["montant"] - $key["Om"].'</td>';
                $html .= '<td>' .$key["motif"].'</td>';
                $html .= '<td>' .$key["dateversement"].'</td>';
            $html .= '</tr>';
            } 
            
            $html .= '
            <tr>
            <th scope="col">Total</th>
            <th scope="col">'.$versement->ByWeekVersement($datedebut,$datedefin).'</th>
            <th scope="col">'.$versement->ByWeekVersementOm($datedebut,$datedefin).'</th>
            <th scope="col">'.$versement->ByWeekVersementCash($datedebut,$datedefin).'</th>
            <th scope="col">-</th>
            <th scope="col">-</th>
        </tr>';

        $html .= '
        </tbody>
    </table>';
    
    $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="3" align="center""> Tableau depense : '.$datedebut."-".$datedefin.'</th></tr>
            </thead>
            <tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="3" align="center"> Recapitulatif Depense </td>';
                $html .= '</tr>
                    <tr>
                    <th scope="col">description</th>
                    <th scope="col">montant</th>
                    <th scope="col">Date</th>
                </tr>';
                $tabdepense = $depense->AllDepenseWeek($datedebut,$datedefin);
                foreach ($tabdepense as $key ) {
                    $html .= '<tr>';
                    $html .= '<td>' .$key["description"].'</td>';
                    $html .= '<td>' .$key["montant"].'</td>';
                    $html .= '<td>' .$key["datedepense"].'</td>';
                $html .= '</tr>';
                }  
                
                $html .= '</tr>
                    <tr>
                    <th scope="col">Total</th>
                    <th scope="col">'.$depense->ByWeekDepense($datedebut,$datedefin).'</th>
                    <th scope="col">-</th>
                </tr>';

            $html .= '
            </tbody>
        </table>';

        $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="6" align="center""> Tableau Achat : '.$datedebut."-".$datedefin.'</th></tr>
            </thead>
            <tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="6" align="center"> Recapitulatif Achat  </td>';
                $html .= '</tr>
                    <tr>
                    <th scope="col">Nom produit</th>
                    <th scope="col">quantite</th>
                    <th scope="col">prix Acaht</th>
                    <th scope="col">montant</th>
                    <th scope="col">fournisseur</th>
                    <th scope="col">date</th>
                </tr>';
                $tabachat = $achat->AllAchatWeek($datedebut,$datedefin);
                foreach ($tabachat as $key ) {
                    $html .= '<tr>';
                    $html .= '<td>' .$key["Nomproduit"].'</td>';
                    $html .= '<td>' .$key["quantite"].'</td>';
                    $html .= '<td>' .$key["prixAcaht"].'</td>';
                    $html .= '<td>' .$key["montant"].'</td>';
                    $html .= '<td>' . $fournisseur->getByIdFournisseur($key["idfournisseur"]).'</td>';
                    $html .= '<td>' .$key["dateachat"].'</td>';
                $html .= '</tr>';
                }  
                
                $html .= '</tr>
                    <tr>
                    <th scope="col">Total</th>
                    <th scope="col">-</th>
                    <th scope="col">-</th>
                    <th scope="col">'.$achat->getByWeek($datedebut,$datedefin).'</th>
                    <th scope="col">-</th>
                    <th scope="col">-</th>
                </tr>';
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
                </tr>';
                $tabpoussin =$poussin->getPoussinSemaine($datedebut,$datedefin);
                foreach ($tabpoussin as $key ) {
                    $html .= '<tr>';
                    $html .= '<td>' .$key["dateCommande"].'</td>';
                    $html .= '<td>' .$key["Nomclient"].'</td>';
                    $html .= '<td>' .$key["quantite"].'</td>';
                    $html .= '<td>' .$key["prixUnite"].'</td>';
                    $html .= '<td>' . $key["montant"].'</td>';
                    $html .= '<td>' .$key["souche"].'</td>';
                    $montant = $key["montantOm"] + $key["montantCash"];
                    $html .= '<td>' .$montant.'</td>';
                    $html .= '<td>' .$key["reste"].'</td>';
                $html .= '</tr>';
                }   
            $html .= '
            </tbody>
        </table>';

        $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="5" align="center""> Consultation : '.date("d-m-Y").'</th></tr>
            </thead>
            <tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="5" align="center"> Commade Poussin </td>';
                $html .= '</tr>
                    <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Age</th>
                    <th scope="col">race</th>
                    <th scope="col">Client</th>
                    <th scope="col">Montant</th>
                </tr>';
                $tabconsultation =$vaccin->getConsultationSemain($datedebut,$datedefin);
                foreach ($tabconsultation as $key ) {
                    $html .= '<tr>';
                    $html .= '<td>' .$key["Nom"].'</td>';
                    $html .= '<td>' .$key["age"].'</td>';
                    $html .= '<td>' . $key["race"].'</td>';
                    $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                    $html .= '<td>' .$key["montant"].'</td>';
                $html .= '</tr>';
                }   
            $html .= '
            </tbody>
        </table>';

        $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="7" align="center""> Suivie : '.date("d-m-Y").'</th></tr>
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
                $tabconsultation =$vaccin->getsuivianimaleSemaine($datedebut,$datedefin);
                foreach ($tabconsultation as $key ) {
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
            $html .= '
            </tbody>
        </table>';

        $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="6" align="center""> Vaccination : '.date("d-m-Y").'</th></tr>
            </thead>
            <tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="6" align="center"> Vaccination  </td>';
                $html .= '</tr>
                    <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Client</th>
                    <th scope="col">typeVacin</th>
                    <th scope="col">date vaccin</th>
                    <th scope="col">date secondvacin</th>
                    <th scope="col">montant</th>
                </tr>';
                $tabconsultation =$vaccin->getVaccinationSemain($datedebut,$datedefin);
                foreach ($tabconsultation as $key ) {
                    $html .= '<tr>';
                    $html .= '<td>' .$key["nom"].'</td>';
                    $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                    $html .= '<td>' . $key["typeVacin"].'</td>';
                    $html .= '<td>' .$key["datevacin"].'</td>';
                    $html .= '<td>' .$key["datesecondvacin"].'</td>';
                    $html .= '<td>' .$key["netpayer"].'</td>';
                $html .= '</tr>';
                }   
            $html .= '
            </tbody>
        </table>';


        $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="5" align="center""> Terrain : '.date("d-m-Y").'</th></tr>
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
                $tabconsultation =$vaccin->getTerrainSemain($datedebut,$datedefin);
                foreach ($tabconsultation as $key ) {
                    $html .= '<tr>';
                    $html .= '<td>' .$key["localisation"].'</td>';
                    $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                    $html .= '<td>' . $key["telephone"].'</td>';
                    
                    $html .= '<td>' .$key["datejour"].'</td>';
                    $html .= '<td>' .$key["Montant"].'</td>';
                $html .= '</tr>';
                }   
            $html .= '
            </tbody>
        </table>';

    $html.='<footer>
        
    </footer>
</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
$dompdf->getCanvas()->page_text(72, 18, "page: {PAGE_NUM} sur {PAGE_COUNT}", $font, 10, array(0,0,0));
$dompdf->stream('mon_fichier.pdf', array('Attachment' => 1));


?>