<?php
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
require_once("../bdmutilple/getproduit.php");

require '../../vendor/autoload.php';
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;

if (isset($_POST['annee'])) {
    $annee = $_POST['annee'];
} else {
    $annee = date("Y");
}



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
$produit = new Produit();
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
            <th scope="col">'.$annee.'</th>
            <th scope="col">Exercice -1 </th>
        </tr>';
        
        $sommevente = $vente->SommeVenteAnne($annee);
        $sommeventeAnnePasse = $vente->SommeVenteAnnePasse($annee);
        $html .= '
        <tr>
            <th scope="col">Ventes de marchandises (A)</th>
            <th scope="col">+</th>
            <th scope="col">1</th>
            <th scope="col">'.$sommevente.'</th>
            <th scope="col">'.$sommeventeAnnePasse.'</th>
        </tr>';
        $sommeachat = $achat->SommeAchatAnne($annee);
        $sommeachatAnnePasse = $achat->SommeAchatAnnePasse($annee);
        $html .= '
        <tr>
            <th scope="col">Achats de marchandises </th>
            <th scope="col">-</th>
            <th scope="col">-1</th>
            <th scope="col">'.$sommeachat.'</th>
            <th scope="col">'.$sommeachatAnnePasse.'</th>
        </tr>';
        //$stok->VariationStok()
        $html .= '
        <tr>
            <th scope="col">Variation de stocks de marchandises</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        $xampp = $sommevente - $sommeachat;
        $xamppAnnePasse = $sommeventeAnnePasse - $sommeachatAnnePasse;
        $html .= '
        <tr>
            <th scope="col" style="color: blue;">MARGE COMMERCIALE (Somme TA à RB)</th>
            <th scope="col" style="color: blue;">-</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">'.$xampp.'</th>
            <th scope="col" style="color: blue;">'.$xamppAnnePasse.'</th>
        </tr>';
        $produitFabrique=0; //$facture->sommeVenteProduitFabriquer($annee);
        $produitFabriqueAnnePasse=0; //$facture->sommeVenteProduitFabriquerPasser($annee);
        $html .= '
        <tr>
            <th scope="col">Ventes de produits fabriqués (B)</th>
            <th scope="col">+</th>
            <th scope="col">1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        $sommeservice=0; //$service->sommeService($annee);
        $sommeservicepasse =0; //$service->sommeServiceAnne($annee);
        if (Empty($sommeservicepasse) || Empty($sommeservice)) {
            $sommeservicepasse = 0;
            $sommeservice = 0;
        }   
        $html .= '
        <tr>
            <th scope="col">Travaux, services vendus (C)</th>
            <th scope="col">+</th>
            <th scope="col">1</th>
            <th scope="col">'.$sommeservice.'</th>
            <th scope="col">'.$sommeservicepasse.'</th>
        </tr>';
        //'.$comptabilite->SommeCorporelles(date("Y")).'
        
        $html .= '
        <tr>
            <th scope="col">Produits accessoires (D)</th>
            <th scope="col">+</th>
            <th scope="col">1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        //'.$service->sommeService() + $facture->sommeVenteProduitFabriquer().'
        $chiffreAffaire = $sommevente  ;
        $chiffreAffaireAnnePasse = $sommeventeAnnePasse ;
        $html .= '
        <tr>
            <th scope="col" style="color: blue;">CHIFFRE AFFAIRES (A  B  C  D)</th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">'.$chiffreAffaire.'</th>
            <th scope="col" style="color: blue;">'.$chiffreAffaireAnnePasse.'</th>
        </tr>';
        //'.$produit->SommeProduitStocker(date("Y")).'
        $html .= '
        <tr>
            <th scope="col">Production stockée (ou déstockage) </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        //'.$comptabilite->SommeImmobilisationCorporel().'
        //'.$comptabilite->SommeImmobilisationCorporelexercice().'
        $html .= '
        <tr>
            <th scope="col">Production immobilisée </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        //'.$comptabilite->SommeSubvention().'
        //'.$comptabilite->SommeSubventionexercice().'
        $html .= '
        <tr>
            <th scope="col">Subventions d’exploitation</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        //'.$depenses->SommeDepenseAchat().'
        $html .= '
        <tr>
            <th scope="col">Autres produits</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        //'.$depenses->SommeDepense().'
        //'.$depenses->SommeDepenseExercice().'
        $html .= '
        <tr>
            <th scope="col">Transferts de charges exploitation   </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        //'.$achat->SommeAchat().'
        //'.$achat->SommeAchatAnnePasse().'
        $html .= '
        <tr>
            <th scope="col">Achats de matières premières et fournitures liées  </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        //'.$stok->VariationStokfourniture().'
        //'.$stok->VariationStokfournitureExercice().'
        $html .= '
        <tr>
            <th scope="col">Variation de stocks de matières premières et fournitures liées  </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        $sommedepenseAchat = $depenses->SommeDepenseAchatAnne($annee);
        $sommedepenseExerciceAchat = $depenses->SommeDepenseExerciceAchat($annee);
        $html .= '
        <tr>
            <th scope="col">Autres achats   </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$sommedepenseAchat.'</th>
            <th scope="col">'.$sommedepenseExerciceAchat.'</th>
        </tr>';
        //'.$comptabilite->SommeAutreAprovision().'
        //'.$comptabilite->SommeAutreAprovisionExercice().'
        $html .= '
        <tr>
            <th scope="col">Variation de stocks d’autres approvisionnements</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">0</th>
            <th scope="col">0</th>
        </tr>';
        $sommedepensevoyage = $depenses->SommeDepenseVoyagesAnne($annee);
        $sommedepenseExerciceVoyage = $depenses->SommeDepenseExerciceVoyages($annee);
        $html .= '
        <tr>
            <th scope="col">Transports</th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'. $sommedepensevoyage.'</th>
            <th scope="col">'.$sommedepenseExerciceVoyage.'</th>
        </tr>';
        $sommeservice = $depenses->SommeServiceExterieux($annee);
        $sommeserviceExercice = $depenses->SommeServiceExterieuxAnne($annee);
        $html .= '
        <tr>
            <th scope="col">Services extérieurs </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$sommeservice.'</th>
            <th scope="col">'.$sommeserviceExercice.'</th>
        </tr>';
        $sommeinpot = $depenses->SommeDepenseImpotAnne($annee);
        $sommeinpotExercice = $depenses->SommeDepenseExerciceImpot($annee);
        $html .= '
        <tr>
            <th scope="col">Impôts et taxes </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$sommeinpot.'</th>
            <th scope="col">'.$sommeinpotExercice.'</th>
        </tr>';
        $sommeautrecharge = $depenses->SommeDepenseAutreChargeAnne($annee);
        $sommeautrechargeExercice = $depenses->SommeDepenseExerciceAutreCharge($annee);
        $html .= '
        <tr>
            <th scope="col">Autres charges  </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$sommeautrecharge .'</th>
            <th scope="col">'.$sommeautrechargeExercice.'</th>
        </tr>';
        $xc = $sommeautrecharge + $sommeinpot + $sommeservice + $sommedepensevoyage + $sommedepenseAchat;
        $xcExercice = $sommeautrechargeExercice + $sommeinpotExercice + $sommeservice + $sommedepenseExerciceVoyage + $sommedepenseExerciceAchat;
        $html .= '
        <tr>
            <th scope="col">VALEUR AJOUTEE (XB +RA+RB) + (somme TE à RJ)  </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">'.$xc.'</th>
            <th scope="col" style="color: blue;">'.$xcExercice.'</th>
        </tr>';
        $sommepersonnel = $depenses->SommeDepensePersonnelAnne($annee);
        $sommepersonnelexercice = $depenses->SommeDepenseExercicePersonnel($annee);
        $html .= '
        <tr>
            <th scope="col">Charges de personnel  </th>
            <th scope="col">-/+</th>
            <th scope="col">-1</th>
            <th scope="col">'.$sommepersonnel.'</th>
            <th scope="col">'.$sommepersonnelexercice.'</th>
        </tr>';
        $xd = $xc - $sommepersonnel;
        $xdExercice = $xcExercice - $sommepersonnelexercice;
        $html .= '
        <tr>
            <th scope="col">EXCEDENT BRUT EXPLOITATION (XC+RK)   </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">'.$xd.'</th>
            <th scope="col" style="color: blue;">'.$xdExercice.'</th>
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
        $xe = $xd - $comptabilite->SommeAmortise();
        $xeExercice = $xdExercice - $comptabilite->SommeExerciceAmortise();
        $html .= '
        <tr>
            <th scope="col">RESULTAT EXPLOITATION (XD+TJ+ RL)  </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">'.$xe.'</th>
            <th scope="col" style="color: blue;">'.$xeExercice.'</th>
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
        $xg = $xe;
        $xgExercice = $xeExercice;
        $html .= '
        <tr>
            <th scope="col">RESULTAT DES ACTIVITES ORDINAIRES (XE+XF)  </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">'.$xg.'</th>
            <th scope="col" style="color: blue;">'.$xgExercice.'</th>
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
        $xh = $xg*(26.5/100);
        $xhExercice = $xgExercice*(26.5/100);
        $html .= '
        <tr>
            <th scope="col">RESULTAT HORS ACTIVITES ORDINAIRES (somme TN à RP)  </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">'.$xh.'</th>
            <th scope="col" style="color: blue;">'.$xhExercice.'</th>
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
        $xi = $xg - $xh;
        $xiExercice = $xgExercice - $xhExercice;
        $html .= '
        <tr>
            <th scope="col">RESULTAT NET (XG+XH+RQ+RS)  </th>
            <th scope="col" style="color: blue;">-/+</th>
            <th scope="col" style="color: blue;">-1</th>
            <th scope="col" style="color: blue;">'.$xi.'</th>
            <th scope="col" style="color: blue;">'.$xiExercice.'</th>
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