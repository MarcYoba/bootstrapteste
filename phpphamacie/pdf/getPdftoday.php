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
require_once("../bdmutilple/getclient.php");
require_once("../bdmutilple/getpoussin.php");
require_once("../bdmutilple/getvaccin.php");

require '../../vendor/autoload.php';
use Dompdf\Dompdf;

$date = date("Y-m-d");
//var_dump($date);

$formule = 1;
$prix = 0;
$montant = 0;

$vente = new Vente("vente");
$depense = new Depense($date);
$versement = new Versement($date);
$achat = new Achat($date);
$fournisseur = new Fournisseur(0);
$client = new Client(0);
$caise = new Caise($date);
$trie = new TrieValue();
$stok = new Stock(1,$date,$date);
$produit = new Produit();
$client = new Client($date);
$poussin = new Poussin();
$vaccin = new Vaccin();

$value = $vente->getIdVente();

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
        $html .=' <tr><th colspan="6" align="center""> rapport Vente du : '.date("d-m-Y").'</th></tr>
        </thead>
        <tbody>';
        foreach ($value as $line) {
            $inclient=$client->getClientByIdVente($line["id"]);
            $html .= '<tr>';
            $html .= '<td colspan="6" align="center"> Facture ' . $formule. " Client : ".$inclient["firstname"]." Tel: ".$inclient["telephone"]." utilisateur ".$line["iduser"]."/".$line["heure"]."/".$line["statusvente"]. '</td>';
            $html .= '</tr>
                <tr>
                <th scope="col">nom produit</th>
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
        $html .=' <tr><th colspan="9" align="center""> Resultat vente du : '.date("d-m-Y").'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="9" align="center"> Recapitulatif Vente </td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Total Vente</th>
                <th scope="col">Total Cash</th>
                <th scope="col">Total OM</th>
                <th scope="col">Total Credit </th>
                <th scope="col">Total reduction</th>
                <th scope="col">Total Depense</th>
                
                <th scope="col">Total Versement</th>
                <th scope="col">Sortie caise</th>
                <th scope="col">Net en Caise</th>
            </tr>';
                $html .= '<tr>';
                    $html .= '<td>' .($vente->getSommeCash() + $vente->getSommeOm()+ $vente->getSommeCredit()).'</td>';
                    $html .= '<td>' .$vente->getSommeCash().'</td>';
                    $html .= '<td>' .$vente->getSommeOm() .'</td>'; //$versement->ByDateVersementOm($date)
                    $html .= '<td>' .$vente->getSommeCredit().'</td>';
                    $html .= '<td>' .$vente->getSommeReduction().'</td>';
                    $html .= '<td>' .$depense->ToDay().'</td>';
                    $html .= '<td>' .$versement->ToDay().'</td>';
                    $html .= '<td>' .(-1*$caise->ToDay()).'</td>';
                    $html .= '<td>' .((((($vente->getSommeCash())-0)-0)-0)+$caise->ToDay()).'</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                    $html .= '<td colspan="3"> Argent en main du 01-12-2024 au '.date("d-m-Y").'</td>';
                    $html .= '<td colspan="2">' .$vente->getSommeTotalCaisse().'</td>';
                    $html .= '<td colspan="3"> Total credit du 01-12-2024 au '.date("d-m-Y").'</td>';
                    $html .= '<td colspan="1">' .$vente->getSommeCreditCaisse()-$versement->TotalVersement().'</td>';
                $html .= '</tr>';
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="4" align="center""> Tableau Caise : '.date("d-m-Y").'</th></tr>
            </thead>
            <tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="4" align="center"> Recapitulatif Operation caise </td>';
                $html .= '</tr>
                    <tr>
                    <th scope="col">operation</th>
                    <th scope="col">montant</th>
                    <th scope="col">date</th>
                    <th scope="col">motif</th>
                </tr>';
                $tabcaise = $caise->AllSortieCaise();
                $montant = 0;
                foreach ($tabcaise as $key ) {
                    $montant +=($key["montant"]);
                    $html .= '<tr>';
                    $html .= '<td>' .$key["operation"].'</td>';
                    $html .= '<td>' .(-1*$key["montant"]).'</td>';
                    $html .= '<td>' .$key["dateoperation"].'</td>';
                    $html .= '<td>' .$key["motif"].'</td>';
                $html .= '</tr>';
                } 
                $html .= '<tr>
                    <td>-----</td>
                    <td>' .$montant.' FCFA </td>
                    <td>-----</td>
            </tr>';  
            $html .= '
            </tbody>
        </table>';

    $html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="5" align="center""> Quantite Pour chaque produit : '.date("d-m-Y").'</th></tr>
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
            $quantiteproduit = $vente->getSommeProduit();
            
            foreach ($quantiteproduit as $key ) {
                
                $html .= '<tr>';
                $html .= '<td>' . $trie->RemoveChaine("provenderie",$key["nomproduit"]) .'</td>';
                $html .= '<td>' .$stok->getLogsProduit($trie->RemoveChaine("provenderie",$key["nomproduit"])).'</td>';
                $html .= '<td>' .round($key["quantite"],2).'</td>';
                //$html .= '<td>' .$stok->getLogsProduit($trie->RemoveChaine("provenderie",$key["nomproduit"])) - round($key["quantite"],2).'</td>';
                $html .= '<td>' .$produit->getQuantiteProduit($key["nomproduit"]).'</td>';
                $html .= '<td>' .$key["datefacture"].'</td>';
            $html .= '</tr>';
            }   
        $html .= '
        </tbody>
    </table>';

    $html .='<br><br><br> <table style="width:100%">
        <thead>';
        $html .=' <tr><th colspan="5" align="center""> Resultat Versement : '.date("d-m-Y").'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="5" align="center"> Recapitulatif Versement </td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Nom client</th>
                <th scope="col">montant</th>
                <th scope="col">OM</th>
                <th scope="col">motif</th>
                <th scope="col">dateversement</th>
            </tr>';
            $tabversement = $versement->AllVersement();
            foreach ($tabversement as $key ) {
                $html .= '<tr>';
                $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                $html .= '<td>' .$key["montant"].'</td>';
                $html .= '<td>' .$key["Om"].'</td>';
                $html .= '<td>' .$key["motif"].'</td>';
                $html .= '<td>' .$key["dateversement"].'</td>';
            $html .= '</tr>';
            }   
        $html .= '
        </tbody>
    </table>';
    
    $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="3" align="center""> Tableau depense : '.date("d-m-Y").'</th></tr>
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
                $tabdepense = $depense->AllDepense();
                foreach ($tabdepense as $key ) {
                    $html .= '<tr>';
                    $html .= '<td>' .$key["description"].'</td>';
                    $html .= '<td>' .$key["montant"].'</td>';
                    $html .= '<td>' .$key["datedepense"].'</td>';
                $html .= '</tr>';
                }   
            $html .= '
            </tbody>
        </table>';

        $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="6" align="center""> Tableau Achat : '.date("d-m-Y").'</th></tr>
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
                $tabachat = $achat->AllAchat();
                $montant = 0;
                foreach ($tabachat as $key ) {
                    $montant += $key["montant"];
                    $html .= '<tr>';
                    $html .= '<td>' .$key["Nomproduit"].'</td>';
                    $html .= '<td>' .$key["quantite"].'</td>';
                    $html .= '<td>' .$key["prixAcaht"].'</td>';
                    $html .= '<td>' .$key["montant"].'</td>';
                    $html .= '<td>' . $fournisseur->getByIdFournisseur($key["idfournisseur"]).'</td>';
                    $html .= '<td>' .$key["dateachat"].'</td>';
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
                $tabpoussin =$poussin->getPoussin();
                $montant = 0;
                foreach ($tabpoussin as $key ) {
                    $montant += $key["montant"];
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
                $html .= '<tr>
                    <td>-----</td>
                    <td>' .$montant.' FCFA </td>
                    <td colspan="6">-----</td>
            </tr>'; 
            $html .= '
            </tbody>
        </table>';

        $html .='<br><br><br> <table style="width:100%">
            <thead>';
            $html .=' <tr><th colspan="5" align="center""> Consultation : '.date("d-m-Y").'</th></tr>
            </thead>
            <tbody>';
                $html .= '<tr>';
                $html .= '<td colspan="5" align="center"> Consultation</td>';
                $html .= '</tr>
                    <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Age</th>
                    <th scope="col">race</th>
                    <th scope="col">Client</th>
                    <th scope="col">Montant</th>
                </tr>';
                $tabconsultation =$vaccin->getConsultation();
                $montant = 0;
                foreach ($tabconsultation as $key ) {
                    $montant += $key["montant"];
                    $html .= '<tr>';
                    $html .= '<td>' .$key["Nom"].'</td>';
                    $html .= '<td>' .$key["age"].'</td>';
                    $html .= '<td>' . $key["race"].'</td>';
                    $html .= '<td>' .$client->getByIdClient($key["idclient"]).'</td>';
                    $html .= '<td>' .$key["montant"].'</td>';
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
                $tabconsultation =$vaccin->getsuivianimale();
                $montant = 0;
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
                    <th scope="col">Avance</th>
                </tr>';
                $tabconsultation =$vaccin->getVaccination();
                $montant = 0;
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
                $tabconsultation =$vaccin->getTerrain();
                $montant = 0;
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

     $html .= '<footer>
        
    </footer>
</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");
$dompdf->getCanvas()->page_text(72, 18, "page: {PAGE_NUM} sur {PAGE_COUNT}", $font, 10, array(0,0,0));
$dompdf->stream('mon_fichier.pdf', array('Attachment' => false));


?>