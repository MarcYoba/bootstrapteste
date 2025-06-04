<?php 
require_once("../bdmutilple/getcommandefourniseur.php");


    $json = file_get_contents('php://input');
    $donnees = json_decode($json,true);
    $tableau = 0;
    
    $commande = new CommandFourniseur();
    
    if (count($donnees)>1) {
        // while (is_array($donnees)) {
        //     $tableau = array_shift($donnees);
        //     $commande->InsertCommandFourniseur($tableau);
        // }
        $reponse =[
            "success"=>true
        ];
        echo json_encode($reponse);
        exit();
    }else{
        $commande->InsertCommandFourniseur(array_shift($donnees));
        $reponse =[
            "success"=>true
        ];
        echo json_encode($reponse);
    }
?>