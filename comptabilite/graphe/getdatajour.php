<?php
 require_once("../bdmutilple/connexion.php");

 global $conn;

 //$sql = "SELECT * FROM ";
//$result = $conn->query($sql);

// Formatage des résultats en JSON
$data = array(
    "jen" =>10,
    "fev" =>20,
    "mar" =>30,
    "avr" =>400,
    "mai" =>50,
    "jun" =>60,
    "jui" =>70,
    "aou" =>80,
    "sep" =>90,
    "oct" =>100,
    "nov" =>120,
    "dec" =>130,
);
//while($row = $result->fetch_assoc()) {
  //$data[] = $row;
//}
$reponse = [
    'message' => $data
 ];
echo json_encode($reponse);

?>