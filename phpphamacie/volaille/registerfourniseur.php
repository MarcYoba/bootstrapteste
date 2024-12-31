<?php 
require_once("../connexion.php");
require_once("../bdmutilple/getcommandefourniseur.php");
header('Content-Type: application/json');

    $json = file_get_contents('php://input');
    $donnees = json_decode($json,true);
    $tableau = 0;

    $commande = new CommandFourniseur();

    if (count($donnees)>1) {
        while (count($donnees)>0) {
            $tableau = array_shift($donnees);
            $commande->InsertCommandFourniseur($tableau);
        }
        $reponse =[
            "success"=>true
        ];
        echo json_encode($reponse);
    }else{
        $commande->InsertCommandFourniseur(array_shift($donnees));
        $reponse =[
            "success"=>true
        ];
        echo json_encode($reponse);
    }
?>