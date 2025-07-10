<?php
require '../../vendor/autoload.php';

session_start();
// Connexion à la base de données
require_once("../connexion.php");
require_once("../bdmutilple/getproduit.php");

// Récupération sécurisée des variables POST
$semestre = isset($_POST['semestre']) ? intval($_POST['semestre']) : 1;
$speculation = isset($_POST['speculation']) ? $_POST['speculation'] : '';
$anne = isset($_POST['anne']) ? intval($_POST['anne']) : date('Y');

// Validation du semestre
if ($semestre !== 1 && $semestre !== 2) {
    $semestre = 1;
}

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Créer un nouveau document Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Titres des colonnes
$sheet->setCellValue('A1', 'client');
$sheet->setCellValue('B1', 'typevente');
$sheet->setCellValue('C1', 'total_ventes');
$sheet->setCellValue('D1', 'speculation');

// Construction de la clause WHERE pour le semestre
if ($semestre == 1) {
    $moisDebut = 1;
    $moisFin = 6;
} else if($semestre == 'ALL') {
    $moisDebut = 1;
    $moisFin = 12;
}else{
    $moisDebut = 7;
    $moisFin = 12;
}

// Préparation de la requête SQL avec des paramètres
if ($speculation == 'ALL') {
    $sql = "SELECT
        c.firstname AS client,
        v.typevente,
        SUM(v.prix) AS total_ventes,
        v.esperce AS speculation
    FROM vente v
    INNER JOIN client c ON v.idclient = c.id
    WHERE
        YEAR(v.datevente) = ?
        AND MONTH(v.datevente) BETWEEN ? AND ?
    GROUP BY c.firstname, v.esperce
    ORDER BY client, v.esperce";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $anne, $moisDebut, $moisFin);
} else {
    // Si aucune spéculation n'est sélectionnée, on ne filtre pas par spéculation
    $sql = "SELECT
    c.firstname AS client,
    v.typevente,
    SUM(v.prix) AS total_ventes,
    v.esperce AS speculation
    FROM vente v
    INNER JOIN client c ON v.idclient = c.id
    WHERE
        YEAR(v.datevente) = ?
        AND MONTH(v.datevente) BETWEEN ? AND ?
        AND v.esperce = ?
    GROUP BY c.firstname, v.esperce
    ORDER BY client, v.esperce";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiis', $anne, $moisDebut, $moisFin, $speculation);
}

$stmt->execute();
$result = $stmt->get_result();

// Commencer à la ligne 2
$ligne = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $ligne, $row['client']);
    $sheet->setCellValue('B' . $ligne, $row['typevente']);
    $sheet->setCellValue('C' . $ligne, $row['total_ventes']);
    $sheet->setCellValue('D' . $ligne, $row['speculation']);
    $ligne++;
}

// Auto-ajuster les colonnes
foreach (range('A', 'D') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Nettoyer le tampon de sortie pour éviter la corruption du fichier Excel
if (ob_get_length()) {
    ob_end_clean();
}

// En-têtes pour le téléchargement
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="export_speculation.xlsx"');
header('Cache-Control: max-age=0');

// Générer le fichier Excel
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;


?>