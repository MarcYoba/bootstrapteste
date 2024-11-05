<?php

require_once("phpphamacie/historique/getproduit.php");


$produit = new Produit();


// Créer un objet DateTime représentant la date d'hier
$hier = new DateTime('yesterday');

// Formater la date comme vous le souhaitez (exemple : YYYY-MM-DD)
$date_hier = $hier->format('Y-m-d');


$date_jour = date('Y-m-d');

    if (!empty($produit->getHistoriqueStockDate($date_jour))) {
       
    }else {
        $produit->InsertHistoriqueStock($produit->getByIdProduit());
        
    }  

?>