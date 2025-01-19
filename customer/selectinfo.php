<?php

use FontLib\Table\Type\head;
session_start();
require_once("getclient.php");

$client = new Client(0);

if (isset($_POST['suivre'])) {

    $clientselec = $_POST['clientselec'];
    $refecrence = $_POST['refecrence'];

    $_SESSION['idclient']  = $refecrence; 

    header('Location: client.php');
}

if (isset($_POST['enregistrer'])) {

    $reference = 0;
    $OM = 0;
    $MOMO = 0;
    $BANQUE = 0;
    $CASH = 0;

    if (isset($_POST['OM'])) {     
        $OM = $_POST['OM'];
    }
    if (isset($_POST['MOMO'])) {
        $MOMO = $_POST['MOMO'];
    }
    if (isset($_POST['BANQUE'])) {
        $BANQUE = $_POST['BANQUE'];
    }
    if (isset($_POST['CASH'])) {
        $CASH = $_POST['CASH'];
    }
    if (isset($_POST['reference'])) {
        $reference = $_POST['reference'];
    }

    $paie = $OM." ".$MOMO." ".$BANQUE." ".$CASH;
    if (!empty($OM) || !empty($MOMO) || !empty($BANQUE) || !empty($CASH) || !empty($reference)){

        $client->insertToCommande($reference,$paie);
        header('Location: client.php');
    }else{
        header('Location: client.php');
    }
  
}


?>