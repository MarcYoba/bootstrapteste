<?php 
require_once("../connexion.php");
global $conn;
// $datetab = array(
//     "lundi" => "monday this week",
//     "mardi" => "tuesday this week",
//     "mercredi" => "wednesday this week",
//     "jeudi" => "thursday this week",
//     "vendredi" => "friday this week",
//     "samedi" => "saturday this week",
//     "dimanche" => "sunday this week"
// );

// $date = new DateTime();



// foreach ($datetab as $key => $value) {
//     $date->modify($value);
//     echo $key.'  '.$date->format('Y-m-d');
//     echo '<br>';
// }

$id = $_GET["id"];

$sql = "DELETE  FROM versement WHERE id = $id";
$result = $conn->query($sql);
if ($result == true) {
    header("Location:liste.php");
} else {
    header("Location:liste.php");
}

?>