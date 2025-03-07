<?php
 require_once("../connexion.php");

 global $conn;



// Formatage des résultats en JSON
$data = array(
    "achat" =>0,
    "vente" =>0,
    "dette" =>0,
    "versement" =>0,
);

$sql = "SELECT SUM(montant) as montant FROM achatphamacie WHERE YEAR(dateachat) = YEAR(CURRENT_DATE)";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$data["achat"] = $row["montant"];

$sql = "SELECT SUM(prix) as montant FROM ventephamacie WHERE YEAR(datevente) = YEAR(CURRENT_DATE)";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$data["vente"] =$row["montant"];

$sql = "SELECT SUM(montant) as montant FROM dettephamacie WHERE YEAR(datedette) = YEAR(CURRENT_DATE)";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$data["dette"] =$row["montant"];

$sql = "SELECT SUM(montant) as montant FROM versementphamacie WHERE YEAR(dateversement) = YEAR(CURRENT_DATE)";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$data["versement"] =$row["montant"];

$reponse = [
    'message' => $data
 ];
echo json_encode($reponse);

?>