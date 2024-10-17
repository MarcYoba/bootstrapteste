<?php
 require_once("../connexion.php");

 global $conn;

 

// Formatage des résultats en JSON
$data = array(
    "lundi" =>0,
    "mardi" =>0,
    "mercredi" =>0,
    "jeudi" =>0,
    "vendredi" =>0,
    "samedi" =>0,
    "dimanche" =>0,
);

$sql = "SELECT prix , CASE WEEKDAY(datevente) WHEN 0 THEN 'Lundi' WHEN 1 THEN 'mardi' WHEN 2 THEN 'mercredi' WHEN 3 THEN 'jeudi' WHEN 4 THEN 'vendredi' WHEN 5 THEN 'samedi' ELSE 'dimanche' END AS jourSemaine FROM ventephamacie WHERE datevente BETWEEN DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) AND CURDATE();";
 $result = $conn->query($sql);
 while ($row = mysqli_fetch_assoc($result)) {
   switch ($row["jourSemaine"]) {
    case 'Lundi':
       $data["lundi"] += $row["prix"];
        break;
    case 'mardi':
        $data["mardi"] += $row["prix"];
        break;
    case 'mercredi':
        $data["mercredi"] += $row["prix"];
        break;
    case 'jeudi':
        $data["jeudi"] += $row["prix"];
        break;
    case 'vendredi':
        $data["vendredi"] += $row["prix"];
        break;
    case 'samedi':
        $data["samedi"] += $row["prix"];
        break;
    default:
        $data["dimanche"] += $row["prix"];
        break;
   }
 }

$reponse = [
    'message' => $data
 ];
echo json_encode($reponse);

?>