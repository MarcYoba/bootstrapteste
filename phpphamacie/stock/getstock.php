<?php
require_once("../connexion.php"); 
require '../../vendor/autoload.php';
require_once("../bdmutilple/getstock.php");
require_once("../bdmutilple/getproduit.php");
use Dompdf\Dompdf;


$nom = $_POST['nomProduit'];
$datefirst = $_POST['date'];
$datesecon = $_POST['date2'];
$date = date("Y-m-d");
$value = [];
$bdstock = new Stock($nom,1,$datefirst);
$produit = new Produit();

if ((!empty($_POST["Achat"]))) {
    header('Location: ../achat/liste.php');
    exit;
}

if ((!empty($_POST["vente"]))) {
    header('Location: ../vente/liste.php');
    exit;
}

if ((!empty($_POST["reel"]))&& ($nom == "All") && ((empty($datefirst)) )) {
    $value = $produit->getAllProduit();
} else if ((!empty($_POST["reel"]))&& ($nom != "All") && (empty($datefirst)))  {
    $value = $produit->getAllProduitName($nom);
} else if ((!empty($_POST["reel"]))&& ($nom != "All") && (!empty($datefirst)) && (empty($datesecon)))  {
   $value = $bdstock->DayofMonthHitorique($nom);
}else if ((!empty($_POST["reel"]))&& ($nom != "All") && (!empty($datefirst)) && (!empty($datesecon)))  {
    $value = $bdstock->getHitoriqueIntervale($nom,$datesecon);
}else if ((!empty($_POST["reel"]))&& ($nom == "All") && (!empty($datefirst)) && (!empty($datesecon)))  {
    $value = $bdstock->HitoriqueIntervale($datesecon);
}else if ((!empty($_POST["reel"]))&& ($nom == "All") && ((!empty($datefirst)))) {
    $value = $produit->getHistoriqueProduit($datefirst);
}

if ((!empty($_POST["Intentaire"]))&& ($nom == "All") && (empty($datefirst)) ) {
    $value = $produit->getAllProduit();
} else if ((!empty($_POST["Intentaire"]))&& ($nom != "All") && (empty($datefirst)))  {
    $value = $produit->getAllProduitName($nom);
} else if ((!empty($_POST["Intentaire"]))&& ($nom != "All") && (!empty($datefirst)) && (empty($datesecon)))  {
   $value = $bdstock->DayofMonthHitorique($nom);
}else if ((!empty($_POST["Intentaire"]))&& ($nom != "All") && (!empty($datefirst)) && (!empty($datesecon)))  {
    $value = $bdstock->getHitoriqueIntervale($nom,$datesecon);
}else if ((!empty($_POST["Intentaire"]))&& ($nom == "All") && (!empty($datefirst)) && (!empty($datesecon)))  {
    $value = $bdstock->HitoriqueIntervale($datesecon);
}


/*
if ($nom == "All") { && (empty($datesecon))
    if ($periode == "day") {
        if (!empty($datejour)) {
            $value = $bdstock->DayofMonth();
        } else {
            $value = $bdstock->ToDay();
        } 
    }
    else if($periode=="semain"){
        if (!empty($datejour)) {
            $value = $bdstock->ToWeek();
        } else {
            $value = $bdstock->ToDayWeek();
        } 
    }else{
        if (!empty($datejour)) {
            $value = $bdstock->ToMonth();
        } else {
            $value = $bdstock->AllMonth();
        }  
    }
   
} else {
    if ($periode == "day") {
        if (!empty($datejour)) {
            $value = $bdstock->GetProduitToDay();
        } else {
            $value = $bdstock->GetProduitToDay();
        } 
    }else{

    }
}
*/


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
        <thead>
            <tr>
                <th scope="col">numero</th>
                <th scope="col">quantite</th>
                <th scope="col">produit</th>
                <th scope="col">Qtdate</th>
            </tr>
        </thead>
        <tbody>';

foreach ($value as $line) {
    $html .= '<tr>';
    foreach ($line as $key => $cell) {
        $html .= '<td>' . $cell. '</td>';
    }
    $html .= '</tr>';
}

$html .= '
        </tbody>
    </table>
    <footer>
        
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


