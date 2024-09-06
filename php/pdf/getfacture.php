<?php
session_start();
require_once("../connexion.php");
require('../../fpdf186/fpdf.php');

$date = date("Y-m-d");
//var_dump($date);
$id =  $_GET["id"];

$sqlfacture = "SELECT * FROM facture WHERE  idvente = '$id'";
$resultfa = $conn->query($sqlfacture); 
$rowfacture = mysqli_fetch_assoc($resultfa);

$idclient = $rowfacture["idclient"];

$sql = "SELECT * FROM client WHERE  id = '$idclient'";
$result = $conn->query($sql); 
$row= mysqli_fetch_assoc($result);

$iduser = $_SESSION["id"];
$sqluser = "SELECT * FROM user WHERE  id = '$iduser'";
$resultuser = $conn->query($sqluser); 
$rowuser= mysqli_fetch_assoc($resultuser);


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$titre = "Facture ABgroup du : " . date("d-m-Y");
$pdf->Cell(80);
$pdf->Cell(30,10,$titre,4,20,'C');
$pdf->Ln();

$pdf->Cell(60);
$pdf->Cell(30,10,"Client  :".$row["firstname"]. "  adresse : ".$row["adresse"]." Phone :" .$row["telephone"],4,20,'C');
$pdf->Ln();

$pdf->Cell(60);
$pdf->Cell(30,10,"Employer  :".$rowuser["firstname"]. " ".$rowuser["lastname"],4,20,'C');
$pdf->Ln();

$pdf->Cell(50,40,'nomproduit');
$pdf->Cell(50,40,'quantite');
$pdf->Cell(30,40,'prix');
$pdf->Cell(30,40,'montant');
$pdf->Cell(30,40,'Typepaiement');

$nomproduit = '';
$formule = 1;
$quantite = 0;
$prix = 0;
$montant = 0;

$pdf->Ln();
        $pdf->Cell(80);
        $pdf->Cell(30,10,'Formule',4,20,'C');
        $pdf->Ln();

$sqlfacture = "SELECT * FROM facture WHERE  idvente = '$id'";
$resultfa = $conn->query($sqlfacture); 
   
    while ($rowfacture = mysqli_fetch_assoc($resultfa)) {
        
        $nomproduit = substr_replace($rowfacture['nomproduit'],"",strpos($rowfacture['nomproduit'],"provenderie"));
        //$nomproduit = substr_replace($nomproduit,"1",strpos($nomproduit,"TOURTEAUX"));

        $pdf->Cell(50,10, $nomproduit);
        $pdf->Cell(50,10,$rowfacture['quantite']);
        $pdf->Cell(30,10,$rowfacture['prix']);
        $pdf->Cell(30,10,$rowfacture['montant']);
        $pdf->Cell(30,10,$rowfacture['Typepaiement']);
        $pdf->Ln();

        $quantite += $rowfacture['quantite'];
        $prix += $rowfacture['prix'];
        $montant += $rowfacture['montant'];
        $formule++;
    } 
    
    $pdf->Cell(50,10,'Total');
    $pdf->Cell(50,10,$quantite);
    $pdf->Cell(30,10,$prix);
    $pdf->Cell(30,10,$montant);
    $pdf->Cell(30,10,'-');

$pdf->Output();
?>