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

$achat = new Achat(0);
$vente = new Vente(0);
$client = new Client(0);
$formule = 1;
$date = $_POST['datedette'];
$dette = new Dette();
$versement = new Versement(1);
$nomproduit = $_POST["produit"];
$fournisseur = new Fournisseur(0);

if (isset($_POST['datedette'])) {
    if ((!empty($_POST['datedett2'])) && (!empty($_POST['datedette'])) && ($nomproduit == "ALL")) {
        $tabledette= $achat->AllAchatWeek($_POST['datedette'],$_POST['datedett2']);
    }else if ((!empty($_POST['datedett2'])) && (!empty($_POST['datedette'])) && ($nomproduit != "ALL")) {
        $tabledette= $achat->AllAchatWeekProduit($_POST['datedette'],$_POST['datedett2'],$nomproduit);
    }
    else if (empty($_POST['datedette']) && $nomproduit == "ALL") {
        $tabledette = $achat->getAllAchat();
    }else if($nomproduit == "ALL" && (!empty($_POST['datedette']))){
        $tabledette = $achat->AllAchatDate($_POST['datedette']);
    }else if($nomproduit != "ALL" && (!empty($_POST['datedette']))){
        $tabledette = $achat->AllAchatDateProduit($_POST['datedette'],$nomproduit);
    }else if($nomproduit != "ALL"){
        $tabledette = $achat->getAllAchatProduit($nomproduit);
    }
} else {
    $date = date("Y-m-d");
    $tabledette = $dette->getAllDette();
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
        $html .=' <tr><th colspan="6" align="center""> Rapport des Achats : '.$date." Au ".$_POST['datedett2'].'</th></tr>
        </thead>
        <tbody>';
            $html .= '<tr>';
            $html .= '<td colspan="6" align="center"> Rapport des Achats  </td>';
            $html .= '</tr>
                <tr>
                <th scope="col">Nom produit</th>
                <th scope="col">Prix Acaht</th>
                <th scope="col">quantite</th>
                <th scope="col">montant</th>
                <th scope="col">Fournisseur </th>
                <th scope="col">date achat </th>
              
            </tr>';
            $som = 0; 
            $somQt = 0;

            foreach ($tabledette as $key ) {
                $html .= '<tr>';
                $html .= '<td>' .$key["Nomproduit"].'</td>';
                $html .= '<td>' .$key["prixAcaht"].'</td>';
                $html .= '<td>' .$key["quantite"].'</td>';
                $html .= '<td>' .$key["montant"].'</td>';
                $som = $som + $key["montant"];
                $somQt =  $somQt + $key["quantite"];
                $html .= '<td>' .$fournisseur->getByIdFournisseur($key["idfournisseur"]).'</td>';
                $html .= '<td>' .$key["dateachat"].'</td>';
                $html .= '</tr>';
            }
                $html .= '<tr>';
                    $html .= '<td>Total</td>';
                    $html .= '<td>-</td>';
                    $html .= '<td>'.$somQt.'</td>';
                    $html .= '<td>'.$som.'</td>';
                    $html .= '<td>-</td>';
                    $html .= '<td>-</td>';
                    
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

?>