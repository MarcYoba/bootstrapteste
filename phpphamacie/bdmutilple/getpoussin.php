<?php 
require_once("../connexion.php");

class Poussin{

    public function InsertPoussin($tableau){
        global $conn;
        $sql = "INSERT INTO poussin (Nomclient, quantite, prixUnite, montant,souche,montantOm,montantCredit,montantCash,reste,statusCommande,dateCommande,dateLivraison) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

        // Lier les paramètres
        if (!$stmt = $conn->prepare($sql)) {
            return "erreur sql";
        }
        $datedebut = $tableau["dateCommande"];
        $status = "EN COUR";
        $tableau["quantitetotale"] = $tableau["quantite"] * $tableau["prixunite"];

        $stmt->bind_param('sdddsddddsss',$tableau["fournisseur"],$tableau["quantite"],$tableau["prixunite"],$tableau["quantitetotale"],$tableau["souche"],$tableau["OM"],$tableau["CREDIT"],$tableau["CASH"],$tableau["RESTE"],$status, $datedebut ,$tableau["datelivraison"]);

        // Exécuter la requête
        if (!$stmt->execute()) {
            return "Echec";
        }else{
            return "OK";
        }
    }

    public function InsertLivraison($tableau){
        global $conn;
        $id = $tableau["reference"];
        $status = "Livree";
        $qt = $tableau["quantite"];
        $prix = $tableau["prixunite"];
        $montant = $tableau["quantitetotale"];
        $om = $tableau["OM"];
        $cred = $tableau["CREDIT"];
        $cash = $tableau["CASH"];
        $rest = $tableau["RESTE"];
        $sql = "UPDATE poussin SET quantite='$qt',prixUnite='$prix',montant='$montant',montantOm='$om',montantCredit='$cred',montantCash='$cash',reste='$rest',statusCommande='$status' WHERE id='$id'";
        $result = $conn->query($sql);
        // Exécuter la requête
        if ($result == true) {
            return "OK";
        }else{
            return "echec";
        }
    }
}
?>