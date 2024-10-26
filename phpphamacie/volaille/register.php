<?php 
require_once("../connexion.php");
require_once("../bdmutilple/getclient.php");
require_once("../bdmutilple/getpoussin.php");
$client = new Client(1);
$poussin = new Poussin();

if (isset($_POST["client"])) {
    $tableaux = [
        "NOMS" => $_POST["Nomclient"],
        "TELEPHONE" => $_POST["telephone"],
        "SUJETS" => "0"
    ];
    
    if (($client->insertToClient($tableaux))=="OK") {
        header("location: volaille.php");
    } else {
        header("Location: volaille.php");
    }
} else if (isset($_POST["submit"])) {
    $tableaux=[
        "dateCommande" => $_POST["dateCommande"],
        "fournisseur"=> $_POST["fournisseur"],
        "quantite" => $_POST["quantite"],
        "souche" => $_POST["souche"],
        "prixunite" => $_POST["prixunite"],
        "datelivraison" => $_POST["datelivraison"],
        "quantitetotale"=> $_POST["quantitetotale"],
        "OM"=>$_POST["OM"],
        "CREDIT"=>$_POST["CREDIT"],
        "CASH" => $_POST["CASH"],
        "RESTE" => $_POST["RESTE"]
    ];

    if (($poussin->InsertPoussin($tableaux)) == "OK") {
        header("location: liste.php");
    } else {
        header("location: volaille.php");
    }
    
}else if(isset($_POST["livraison"])){
    $tableaux=[
        "reference" => $_POST["reference"],
        "quantite" => $_POST["quantite"],
        "prixunite" => $_POST["prixunite"],
        "quantitetotale"=> $_POST["quantitetotale"],
        "OM"=>$_POST["OM"],
        "CREDIT"=>$_POST["CREDIT"],
        "CASH" => $_POST["CASH"],
        "RESTE" => $_POST["RESTE"]
    ];

    if (($poussin->InsertLivraison($tableaux)) == "OK") {
        header("location: liste.php");
    } else {
        header("location: Edite.php");
    }  
}


?>