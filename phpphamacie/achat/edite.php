<?php
    session_start();
    require_once("../bdmutilple/getachat.php");
    require_once("../bdmutilple/getproduit.php");

    $achat = new Achat(1);
    $produit = new Produit();

    if (isset($_GET["edite"])) {
    //     $idachat = $_GET["edite"];

    //     $table = ["id"=> "86" ,
    //     "Nomproduit"=>  "MAIS",
    //      "prixAcaht"=>  "150" ,
    //      "quantite"=>  "178",
    //      "idfournisseur"=>  "178"
    //      ];
    //    header('location:modifie.php');//?tableau=' . urlencode(json_encode($table)));
    //     //var_dump($achat->getAchatById($idachat)) ;

    }elseif (isset($_GET["delete"])) {
        $tab = $achat->getAchatById($_GET["delete"]);
        $tab = array_shift($tab);
        $produit->UpdateProduit($tab["idproduit"],($produit->getQuantiteProduit($tab["Nomproduit"])-$tab["quantite"]));
       if (($achat->DeleteAchat($_GET["delete"]))) {
        header("location:liste.php");
       } else {
        header('Location: editeachat.php?tableau=' . urlencode(json_encode($achat->getAchatById($idachat))));
       }
        
        header("location:liste.php");
    }elseif (isset($_POST["enregistrer"])) {
        $tab = $achat->getAchatById($_POST["idachat"]);
        $tab = array_shift($tab);

        $quantiteStock = $_POST["quantiteStock"];
        $idachat = $_POST["idachat"];
        $nomProduit = $_POST["nomProduit"];
        $quantite = $_POST["quantite"];
        $prix = $_POST["prix"];
        $fournisseur = $_POST["fournisseur"];
        if (($quantiteStock == $quantite) && ($tab["idfournisseur"] == $fournisseur) && ($prix == $tab["prixAcaht"])) {
            header("location:liste.php");
            exit;
        }
        $quantiteStock = $quantite - $quantiteStock ;
       
        if ($achat->UpdateAchat($idachat,$quantite,$nomProduit,$quantiteStock,$fournisseur,$prix)) {
            header("location:liste.php");
            exit;
        } else {
            header('Location: editeachat.php?tableau=' . urlencode(json_encode($achat->getAchatById($idachat))));
        }
    }
    else{
        header("location:liste.php");
    }

?>