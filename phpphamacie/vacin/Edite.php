<?php 
    session_start();
    require_once("../connexion.php");
    require_once("../bdmutilple/getvaccin.php");

    header('Content-Type: application/json');

    $json = file_get_contents('php://input');
    $donnees = json_decode($json,true);

    $vacin = new Vaccin();

    if (isset($donnees["vaccin"])) {
        $donnees = $vacin->getVacin($donnees["vaccin"]);
       //$donnees = $donnees["vaccin"];
        echo json_encode($donnees);
    }else if (isset($donnees["vaccindelete"])) {
        $donnees = $vacin->SupprimerVaccin($donnees["vaccindelete"]);
      // $donnees = $donnees["vaccindelete"];
        echo json_encode($donnees);
    }
    
?>