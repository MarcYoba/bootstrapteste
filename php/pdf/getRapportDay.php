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
require_once("../bdmutilple/getstock.php");
require_once("../bdmutilple/getproduit.php");
require '../../vendor/autoload.php';
use Dompdf\Dompdf;

$date = $_POST["date"];

//var_dump($date);
if (empty($date)) {
   exit;
}
$formule = 1;
$prix = 0;
$montant = 0;

$vente = new Vente($date);
$depense = new Depense($date);
$versement = new Versement($date);
$achat = new Achat($date);
$fournisseur = new Fournisseur($date);
$client = new Client($date);
$caise = new Caise($date);
$trie = new TrieValue();
$produit = new Produit();
$stock = new Stock(1,$date,$date);
$value = $vente->getIdVenteByDate($date);


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
        $html .=' <tr><th colspan="6" align="center""> rapport Vente du : '.$date.'</th></tr>
        </thead>
        <tbody>';
        foreach ($value as $line) {
            $inclient=$client->getClientByIdVente($line["id"]);
            $html .= '<tr>';
            $html .= '<td colspan="6" align="center"> Formule ' . $formule." Vente N= ".$line["id"]. " Client : ".$inclient["firstname"]." Tel: ".$inclient["telephone"]." utilisateur".$line["iduser"]."/".$line["heure"]."/".$line["aliment"]. '</td>';
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
        $html .=' <tr><th colspan="9" align="center""> Resultat vente du : '.$date.'</th></tr>
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
                    $html .= '<td>' .$vente->getSommeVentedate($date).'</td>';
                    $html .= '<td>' .$vente->getSommeVentedate($date)-$vente->getSommeReductionDate($date).'</td>';
                    $html .= '<td>' .$vente->getSommeCashDate($date).'</td>';
                    $html .= '<td>' .$vente->getSommeOmDate($date).'</td>';
                    $html .= '<td>' .$vente->getSommeCreditDate($date).'</td>';
                    $html .= '<td>' .$vente->getSommeReductionDate($date).'</td>';
                    $html .= '<td>' .($caise->getByDateSortie($date)).'</td>';
                    $html .= '<td>' .$versement->ByDateVersement($date).'</td>';
                    $html .= '<td>' .(((($vente->getSommeCashDate($date))-0)+$caise->getByDateSortie($date))+$caise->RetourCaisse($date)).'</td>';
                $html .= '</tr>';
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="3" align="center""> Tableau caisse : '.$date.'</th></tr>
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
            $tabcaisse = $caise->AllSortieCaiseDate($date);
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
        $html .=' <tr><th colspan="5" align="center""> Quantite Pour chaque produit : '.$date.'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="5" align="center"> Recapitulatif Quantite Vendue </td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Mon du produit </th>
                <th scope="col">Quantite debut</th>
                <th scope="col">Quantite</th>
                <th scope="col">Quantite fin</th>
                <th scope="col">Date</th>
            </tr>';
            $quantiteproduit = $vente->getSommeProduitDate($date);
            foreach ($quantiteproduit as $key ) {
                $html .= '<tr>';
                $html .= '<td>' . $trie->RemoveChaine("provenderie",$key["nomproduit"]).'</td>';
                $html .= '<td>' .$stock->getLogsProduitDate($trie->RemoveChaine("provenderie",$key["nomproduit"]),$date).'</td>';
                $html .= '<td>' .round($key["quantite"],2).'</td>';
                $html .= '<td>' .$stock->getLogsSuivant($trie->RemoveChaine("provenderie",$key["nomproduit"]),$date).'</td>';
                $html .= '<td>' .$key["datefacture"].'</td>';
            $html .= '</tr>';
            }   
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="6" align="center""> Resultat Versement : '.$date.'</th></tr>
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
            $tabversement = $versement->AllVersementDate();
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
            <th scope="col">'.$versement->ByDateVersement($date).'</th>
            <th scope="col">'.$versement->ByDateVersementOm($date).'</th>
            <th scope="col">'.$versement->ByDateVersementCash($date).'</th>
            <th scope="col">-</th>
            <th scope="col">-</th>
        </tr>';

        $html .= '
        </tbody>
    </table>';
    
    $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="3" align="center""> Tableau depense : '.$date.'</th></tr>
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
                $tabdepense = $depense->AllDepenseDate($date);
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
                    <th scope="col">'.$depense->ByDateDepense($date).'</th>
                    <th scope="col">-</th>
                </tr>';

            $html .= '
            </tbody>
        </table>';

        $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="6" align="center""> Tableau Achat : '.$date.'</th></tr>
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
                $tabachat = $achat->AllAchatDate($date);
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
                    <th scope="col">'.$achat->getByDate($date).'</th>
                    <th scope="col">-</th>
                    <th scope="col">-</th>
                </tr>';
            $html .= '
            </tbody>
        </table>
    <footer>
        
    </footer>
</body>
</html>';
$nomfichier = $date."pdf";
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
$dompdf->getCanvas()->page_text(72, 18, "page: {PAGE_NUM} sur {PAGE_COUNT}", $font, 10, array(0,0,0));
$dompdf->stream('mon_fichier.pdf', array('Attachment' => false));


?>