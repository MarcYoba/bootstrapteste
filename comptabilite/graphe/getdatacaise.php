<?php
 require_once("../bdmutilple/connexion.php");

 global $conn;



// Formatage des résultats en JSON
$data = array(
    "achat" =>0,
    "vente" =>0,
    "dette" =>0,
    "versement" =>0,
);

$sql = "SELECT SUM(montant) as montant FROM achat";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$data["achat"] = $row["montant"];

$sql = "SELECT SUM(prix) as montant FROM vente";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$data["vente"] =$row["montant"];

$sql = "SELECT SUM(montant) as montant FROM dette";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$data["dette"] =$row["montant"];

$sql = "SELECT SUM(montant) as montant FROM versement";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$data["versement"] =$row["montant"];

$reponse = [
    'message' => $data
 ];
echo json_encode($reponse);

?>