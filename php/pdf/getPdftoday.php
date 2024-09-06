<?php
require_once("../connexion.php");
require('../../fpdf186/fpdf.php');

$date = date("Y-m-d");
//var_dump($date);

$sql = "SELECT * FROM vente WHERE MONTH(datevente) = MONTH(NOW())  AND datevente ='$date'";
$result = $conn->query($sql);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$titre = "Rapport Provenderie du : " . date("d-m-Y");
$pdf->Cell(80);
$pdf->Cell(30,10,$titre,4,20,'C');
$pdf->Ln();

$pdf->Cell(50,40,'nomproduit');
$pdf->Cell(40,40,'quantite');
$pdf->Cell(30,40,'prix');
$pdf->Cell(30,40,'montant');
$pdf->Cell(30,40,'Typepaiement');

$nomproduit = '';
$formule = 1;
$quantite = 0;
$prix = 0;
$montant = 0;
$somme = 0;
$sommeom = 0;
$sommecredit =0;
$sommecash = 0;
$sommereduction = 0;
$sommedepense = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id"];
    $sqlfacture = "SELECT * FROM facture WHERE  idvente = '$id'";
    $resultfa = $conn->query($sqlfacture); 

    $idclient = $row["idclient"];
    $sqlclient = "SELECT * FROM client WHERE  id = '$idclient'";
    $resultaclient = $conn->query($sqlclient); 
    $rowclient = mysqli_fetch_assoc($resultaclient);

    $quantite = 0;
    $prix = 0;
    $montant = 0;

    $pdf->Ln();
    $pdf->Cell(80);
    $pdf->Cell(30,10,'Formule'.$formule.' '.$rowclient["firstname"].' '.$rowclient["telephone"],4,20,'C');
    $pdf->Ln();
   
    while ($rowfacture = mysqli_fetch_assoc($resultfa)) {
        $nomproduit = substr_replace($rowfacture['nomproduit'],"",strpos($rowfacture['nomproduit'],"provenderie"));
        //$nomproduit = substr_replace($nomproduit,"1",strpos($nomproduit,"TOURTEAUX"));
        $pdf->Cell(69,10, $nomproduit);
        $pdf->Cell(20,10,$rowfacture['quantite']);
        $pdf->Cell(25,10,$rowfacture['prix']);
        $pdf->Cell(25,10,$rowfacture['montant']);
        $pdf->Cell(25,10,$rowfacture['Typepaiement']);
        $pdf->Ln();

        $quantite += $rowfacture['quantite'];
        $prix += $rowfacture['prix'];
        $montant += $rowfacture['montant'];
    } 
    
    $pdf->Cell(69,10,'Total');
    $pdf->Cell(20,10,$quantite);
    $pdf->Cell(25,10,$prix);
    $pdf->Cell(25,10,$montant);
    $pdf->Cell(25,10,'-');
    $pdf->Ln();

    $pdf->Cell(69,10,'om');
    $pdf->Cell(20,10,' ');
    $pdf->Cell(25,10,' ');
    $pdf->Cell(25,10,$row["Om"]);
    $pdf->Cell(25,10,'-');
    $pdf->Ln();

    $pdf->Cell(69,10,'cash');
    $pdf->Cell(20,10,' ');
    $pdf->Cell(25,10,' ');
    $pdf->Cell(25,10,$row["cash"]);
    $pdf->Cell(25,10,'-');
    $pdf->Ln();

    $pdf->Cell(69,10,'Credit');
    $pdf->Cell(20,10,' ');
    $pdf->Cell(25,10,' ');
    $pdf->Cell(25,10,$row["credit"]);
    $pdf->Cell(25,10,'-');
    $pdf->Ln();

    $pdf->Cell(69,10,'Reduction');
    $pdf->Cell(20,10,' ');
    $pdf->Cell(25,10,' ');
    $pdf->Cell(25,10,$row["reduction"]);
    $pdf->Cell(25,10,'-');
    $pdf->Ln();

    $pdf->Cell(69,10,'NET a payer');
    $pdf->Cell(20,10,' ');
    $pdf->Cell(25,10,' ');
    $pdf->Cell(25,10,($montant-$row["reduction"]));
    $pdf->Cell(25,10,'-');
    $pdf->Ln();

    $somme +=$montant;
    $sommeom += $row["Om"];
    $sommecredit +=$row["credit"];
    $sommecash += $row["cash"];
    $sommereduction += $row["reduction"];

   $formule++;
}
$pdf->Ln();
$titre = "Depense: " . date("d-m-Y");
$pdf->Cell(80);
$pdf->Cell(30,10,$titre,2,20,'C');
$pdf->Ln();

$pdf->Cell(50,40,'description');
$pdf->Cell(40,40,'montant');
$pdf->Ln();

$sqldepense = "SELECT * FROM depenses WHERE MONTH(datedepense) = MONTH(NOW())  AND datedepense ='$date'";
$resultdepense = $conn->query($sqldepense);

while ($rowdepense = mysqli_fetch_assoc($resultdepense)) {
    
    $pdf->Cell(69,10, $rowdepense["description"]);
    $pdf->Cell(40,10,$rowdepense['montant']);
    $pdf->Ln();

    $sommedepense+=$rowdepense['montant'];

}

$pdf->Ln();
$pdf->Cell(69,10,'Total Vente');
$pdf->Cell(20,10,' ');
$pdf->Cell(25,10,' ');
$pdf->Cell(25,10,$somme.'  FCFA');
$pdf->Cell(25,10,'-');
$pdf->Ln();


$pdf->Cell(69,10,'Total cash');
$pdf->Cell(20,10,' ');
$pdf->Cell(25,10,' ');
$pdf->Cell(25,10,$sommecash.'  FCFA');
$pdf->Cell(25,10,'-');
$pdf->Ln();

$pdf->Cell(69,10,'Total OM');
$pdf->Cell(20,10,' ');
$pdf->Cell(25,10,' ');
$pdf->Cell(25,10,$sommeom.'  FCFA');
$pdf->Cell(25,10,'-');
$pdf->Ln();

$pdf->Cell(69,10,'Total Credit');
$pdf->Cell(20,10,' ');
$pdf->Cell(25,10,' ');
$pdf->Cell(25,10,$sommecredit.'  FCFA');
$pdf->Cell(25,10,'-');
$pdf->Ln();

$pdf->Cell(69,10,'Total reduction');
$pdf->Cell(20,10,' ');
$pdf->Cell(25,10,' ');
$pdf->Cell(25,10,$sommereduction.'  FCFA');
$pdf->Cell(25,10,'-');
$pdf->Ln();

$pdf->Cell(69,10,'Total depense');
$pdf->Cell(20,10,' ');
$pdf->Cell(25,10,' ');
$pdf->Cell(25,10,$sommedepense.'  FCFA');
$pdf->Cell(25,10,'-');
$pdf->Ln();

$pdf->Cell(69,10,'Net en caise');
$pdf->Cell(20,10,' ');
$pdf->Cell(25,10,' ');
$pdf->Cell(25,10,(((($somme-$sommereduction)-$sommecredit)-$sommedepense)-$sommeom).'  FCFA');
$pdf->Cell(25,10,'-');
$pdf->Ln();
$pdf->Output();
?>