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
$sheet->setCellValue('A1', 'cathegorie');
$sheet->setCellValue('B1', 'montant');

// Construction de la clause WHERE pour le semestre
if ($semestre == 1) {
    $moisDebut = 1;
    $moisFin = 6;
} else {
    $moisDebut = 7;
    $moisFin = 12;
}

// Préparation de la requête SQL avec des paramètres
$sql = "SELECT `cathegorie`, `montant` 
FROM `depensesphamacie` 
WHERE MONTH(`datedepense`) BETWEEN ? AND ? AND YEAR(`datedepense`) = ?
GROUP BY `cathegorie`
ORDER BY `cathegorie`";

$stmt = $conn->prepare($sql);
$stmt->bind_param('iii', $moisDebut, $moisFin, $anne);
$stmt->execute();
$result = $stmt->get_result();

// Commencer à la ligne 2
$ligne = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $ligne, $row['cathegorie']);
    $sheet->setCellValue('B' . $ligne, $row['montant']);
    $ligne++;
}

// Auto-ajuster les colonnes
foreach (range('A', 'B') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Nettoyer le tampon de sortie pour éviter la corruption du fichier Excel
if (ob_get_length()) {
    ob_end_clean();
}

// En-têtes pour le téléchargement
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="depense_post.xlsx"');
header('Cache-Control: max-age=0');

// Générer le fichier Excel
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;


?>