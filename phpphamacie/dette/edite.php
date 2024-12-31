<?php
session_start();
 require_once("../connexion.php");

 global $conn;

// Récupération de l'ID
$id = $_GET['id'];
$tab = array(
    "role" =>"enregistrement",
    "iddette" =>0,
    "montant" =>0,
    "idclient" =>0,
    "firstname" =>0,
    "motif" =>0,
);

// Requête SQL pour récupérer les informations de la vente
// $sql = "SELECT dette.id as id,client.firstname as nom, dette.montant, client.id AS idclient FROM dette,client WHERE dette.idclient ='$id' AND client.id = '$id' AND dette.status = 'en cour'";
 $sql = "SELECT id, montant, idclient FROM dettephamacie WHERE id ='$id'";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 $tab["iddette"] = $row["id"];
 $tab["montant"] = $row["montant"];
 $id = $row["idclient"];

 $sql1 = "SELECT id, firstname FROM client WHERE id ='$id'";
 $result1 = $conn->query($sql1);

if ($result->num_rows > 0 && $result1->num_rows > 0 ) {
    // $row = $result->fetch_assoc();
    $row1 = $result1->fetch_assoc();
    // // Encode Une variable JavaScript
    
    $tab["idclient"] = $row1["id"];
    $tab["firstname"] = $row1["firstname"];

    $tableaujson = json_encode($tab);
    header("Location:../versement/versement.php?tableau=$tableaujson");
} else {
    header("location :dette.php");
}
$conn->close();
?>