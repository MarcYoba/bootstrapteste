<?php
 require_once("../connexion.php");

 global $conn;

$sql = "SELECT DATE(datevente) AS jour, SUM(quantite) AS quantite FROM vente WHERE Year(datevente) = 2024 AND MONTH(datevente) = 8 AND typevente ='CASH' GROUP BY DATE(datevente) ORDER BY jour";
$result = $conn->query($sql);
//$data = mysqli_fetch_assoc($result);
$data = [];
// Formatage des résultats en JSON

while($row = $result->fetch_assoc()) {
  array_push($data,$row);
}
$reponse = [
     $data
 ];
echo json_encode($reponse);

?>