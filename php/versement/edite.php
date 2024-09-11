<?php
session_start();
 require_once("../connexion.php");

 global $conn;

// Récupération de l'ID
$id = $_GET['id'];
$tab = array(
    "role" =>"modification",
    "iddette" =>0,
    "iddette" =>0,
    "montant" =>0,
    "idclient" =>0,
    "firstname" =>0,
    "dateversement" =>0,
    "motif" =>0,
);


 $sql = "SELECT id, montant, idclient, iddette,dateversement,motif FROM versement WHERE id ='$id'";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 $tab["iddette"] = $row["id"];
 $tab["iddette"] = $row["iddette"];
 $tab["montant"] = $row["montant"];
 $tab["dateversement"] = $row["dateversement"];
 $tab["motif"] = $row["motif"];

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