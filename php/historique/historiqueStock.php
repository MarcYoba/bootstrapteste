<?php

require_once("php/historique/getproduit.php");


$produit = new Produit();

date_default_timezone_set('Africa/Douala');
// Créer un objet DateTime représentant la date d'hier
$hier = new DateTime();

// Formater la date comme vous le souhaitez (exemple : YYYY-MM-DD)
$date_hier = $hier->format('Y-m-d');

$date_jour = date('Y-m-d');
    if (!empty($produit->getHistoriqueStockDate($date_jour))) {
       
    }else {
        $produit->InsertHistoriqueStock($produit->getByIdProduit());
        
    }  

?>