<?php
require_once("../connexion.php");
require_once("../bdmutilple/getproduit.php");
require_once("../bdmutilple/getstock.php");
require_once("../bdmutilple/getfacture.php");
require_once('../bdmutilple/getachat.php');
require_once("../bdmutilple/getInventaire.php");

$produit = new Produit();
$stock = new Stock(1,1,1);
$facture = new Facture(1);
$achat = new Achat(1);
$inventaire = new Inventaire();

if (isset($_POST["enregistrer"])) {
    $nomproduit = $_POST["nomProduit"];
    $quantite = $_POST["quantite"];
    if ((!empty($produit)) && (!empty($_POST["quantite"]))) {
     $historique = $stock->getHistorique($produit->getIdProduit($nomproduit));
     $idprod = 0;
     foreach ($historique as $key => $value) {
        $idprod = $value["idproduit"];
        $stock->UpdateHistorique($value["idproduit"],$value["datet"],$quantite);
        $quantite = $quantite + $achat->getSommeAchat($idprod,$value["datet"]);
        $sommeQuantite = $facture->getSommeProduit($value["idproduit"],$value["datet"]);
        $quantite = $quantite- $sommeQuantite;
     }

     $produit->UpdateProduit($idprod,$quantite);

     header("location:recaptliste.php");

    } else {
        header("location:editeStock.php");
    }

} else if (isset($_POST["inventaire"])){
    $nomproduit = $_POST["nomProduitP"];
    $quantite = $_POST["quantite2"];
    if($inventaire->InsertInventaire($nomproduit,$quantite)){
        header("location:recaptliste.php");
    }else{
        header("location:editeStock.php");  
    }
    
}else {
    header("location:editeStock.php");
}



?>