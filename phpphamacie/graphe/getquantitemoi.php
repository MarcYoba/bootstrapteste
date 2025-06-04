<?php
 require_once("../connexion.php");

 if (empty($donnees)) {
  $day = date('m');
}else{
  $day = $donnees;
}

$sql = "SELECT DATE(datevente) AS jour, SUM(quantite) AS quantite FROM ventephamacie WHERE YEAR(datevente) = YEAR(CURRENT_DATE) AND MONTH(datevente) = '$day' GROUP BY DATE(datevente) ORDER BY jour";
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