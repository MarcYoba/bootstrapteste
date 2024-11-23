<?php 
session_start();
require_once("../connexion.php");

class CommandFourniseur{
    
    public function InsertCommandFourniseur($tableau){
        global $conn;
        $quantie = 0;
        if (is_string($tableau["souche"])) {
            $quantie = 0;
        } else {
            $quantie = $tableau["souche"];
           
        }
        
        $sql = "INSERT INTO commandPoussin (idfournisseur , souche , montant , statuscommande ,iduser ,datecommande,quantie ) VALUES (?,?,?,?,?,?,?)";

        // Lier les paramètres
        if (!$stmt = $conn->prepare($sql)) {
            return "erreur sql";
        }
        $stmt->bind_param('dsdsdsd',$tableau["fournisseur"],$tableau["souche"],$tableau["montant"],$tableau["status"],$_SESSION["id"],$tableau["datevalue"],$quantie);

        // Exécuter la requête
        if (!$stmt->execute()) {
            return "Echec";
        }else{
            return "OK";
        }
    }

}
?>