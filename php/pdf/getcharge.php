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
require_once("../bdmutilple/getfacture.php");
require_once("../bdmutilple/getservice.php");
require_once("../bdmutilple/getstock.php");
require_once("../bdmutilple/comptabilite.php");

require '../../vendor/autoload.php';
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;

$date = date("Y-m-d");
$depenses = new Depense(0);
$vente = new Vente(0);
$client = new Client(0);
$formule = 1;
$achat = new Achat(0);
$facture = new Facture(0);
$dette = new Dette();
$versement = new Versement(1);
$service = new Service();
$stok = new Stock(0,0,0,0);
$comptabilite = new Comptabilite();
//var_dump($date);

// Créer une instance de Dompdf
$dompdf = new Dompdf();

// Créer le contenu HTML du PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Facture</title>
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
        $html .= '
        <tr>
            <th scope="col" colspan="5">Cahier de charge</th>
        </tr>';
        
        $html .= '
        <tr>
            <th scope="col">Libelle</th>
            <th scope="col">Signe</th>
            <th scope="col">Coef</th>
            <th scope="col">'.date("Y").'</th>
            <th scope="col">Exercice -1 </th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Ventes de marchandises (A)</th>
            <th scope="col">+</th>
            <th scope="col">1</th>
            <th scope="col">'.$vente->SommeVente().'</th>
            <th scope="col">'.$vente->SommeVenteAnnePasse().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Achats de marchandises </th>
            <th scope="col">-</th>
            <th scope="col">-1</th>
            <th scope="col">'.$achat->SommeAchat().'</th>
            <th scope="col">'.$achat->SommeAchatAnnePasse().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Variation de stocks de marchandises</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$stok->VariationStok().'</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col" style="color: blue;">MARGE COMMERCIALE (Somme TA à RB)</th>
            <th scope="col" style="color: blue;">-</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">'.($achat->SommeAchat()*-1) + $vente->SommeVente().'</th>
            <th scope="col" style="color: blue;">'.($achat->SommeAchatAnnePasse()*-1) + ($vente->SommeVenteAnnePasse()).'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Ventes de produits fabriqués (B)</th>
            <th scope="col">+</th>
            <th scope="col">1</th>
            <th scope="col">'.$facture->sommeVenteProduitFabriquer().'</th>
            <th scope="col">0</th>
        </tr>';
        $html .= '
        <tr>
            <th scope="col">Travaux, services vendus (C)</th>
            <th scope="col">+</th>
            <th scope="col">1</th>
            <th scope="col">'.$service->sommeService().'</th>
            <th scope="col">0</th>
        </tr>';
        $html .= '
        <tr>
            <th scope="col">Produits accessoires (D)</th>
            <th scope="col">+</th>
            <th scope="col">1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col" style="color: blue;">CHIFFRE AFFAIRES (A  B  C  D)</th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">'.$service->sommeService() + $facture->sommeVenteProduitFabriquer().'</th>
            <th scope="col" style="color: blue;">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Production stockée (ou déstockage) </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        $html .= '
        <tr>
            <th scope="col">Production immobilisée </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$comptabilite->SommeImmobilisationCorporel().'</th>
            <th scope="col">'.$comptabilite->SommeImmobilisationCorporelexercice().'</th>
        </tr>';
        $html .= '
        <tr>
            <th scope="col">Subventions d’exploitation</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$comptabilite->SommeSubvention().'</th>
            <th scope="col">'.$comptabilite->SommeSubventionexercice().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Autres produits</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Transferts de charges exploitation   </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$depenses->SommeDepense().'</th>
            <th scope="col">'.$depenses->SommeDepenseExercice().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Achats de matières premières et fournitures liées  </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$achat->SommeAchat().'</th>
            <th scope="col">'.$achat->SommeAchatAnnePasse().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Variation de stocks de matières premières et fournitures liées  </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$stok->VariationStokfourniture().'</th>
            <th scope="col">'.$stok->VariationStokfournitureExercice().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Autres achats   </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$depenses->SommeDepenseAchat().'</th>
            <th scope="col">'.$depenses->SommeDepenseExerciceAchat().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Variation de stocks d’autres approvisionnements</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$comptabilite->SommeAutreAprovision().'</th>
            <th scope="col">'.$comptabilite->SommeAutreAprovisionExercice().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Transports</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$depenses->SommeDepenseVoyages().'</th>
            <th scope="col">'.$depenses->SommeDepenseExerciceVoyages().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Services extérieurs </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Impôts et taxes </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$depenses->SommeDepenseImpot().'</th>
            <th scope="col">'.$depenses->SommeDepenseExerciceImpot().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Autres charges  </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$depenses->SommeDepenseAutreCharge().'</th>
            <th scope="col">'.$depenses->SommeDepenseExerciceAutreCharge().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">VALEUR AJOUTEE (XB +RA+RB) + (somme TE à RJ)  </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">0</th>
            <th scope="col" style="color: blue;">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Charges de personnel  </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$depenses->SommeDepensePersonnel().'</th>
            <th scope="col">'.$depenses->SommeDepenseExercicePersonnel().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">EXCEDENT BRUT EXPLOITATION (XC+RK)   </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">0</th>
            <th scope="col" style="color: blue;">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Reprises d’amortissements, provisions et dépréciations</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        $html .= '
        <tr>
            <th scope="col">Dotations aux amortissements, aux provisions et dépréciations</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$comptabilite->SommeAmortise().'</th>
            <th scope="col">'.$comptabilite->SommeExerciceAmortise().'</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">RESULTAT EXPLOITATION (XD+TJ+ RL)  </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">0</th>
            <th scope="col" style="color: blue;">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Revenus financiers et assimilés </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        $html .= '
        <tr>
            <th scope="col">Reprises de provisions et dépréciations financières </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Transferts de charges financières </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Frais financiers et charges assimilées </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Dotations aux provisions et aux dépréciations financières  </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        
        $html .= '
        <tr>
            <th scope="col">RESULTAT FINANCIER (somme TK à RN)  </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">0</th>
            <th scope="col" style="color: blue;">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">RESULTAT DES ACTIVITES ORDINAIRES (XE+XF)  </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">0</th>
            <th scope="col" style="color: blue;">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Produits des cessions d immobilisations   </th>
            <th scope="col">+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Autres Produits HAO   </th>
            <th scope="col">+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Valeurs comptables des cessions d immobilisations   </th>
            <th scope="col">+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Autres Charges HAO   </th>
            <th scope="col">+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">RESULTAT HORS ACTIVITES ORDINAIRES (somme TN à RP)  </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">0</th>
            <th scope="col" style="color: blue;">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Participation des travailleurs    </th>
            <th scope="col">+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">Impôts sur le résultat     </th>
            <th scope="col">+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';

        $html .= '
        <tr>
            <th scope="col">RESULTAT NET (XG+XH+RQ+RS)  </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">0</th>
            <th scope="col" style="color: blue;">0</th>
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