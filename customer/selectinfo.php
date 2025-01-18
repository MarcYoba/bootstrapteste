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

    $reference = $_POST['reference'];
    $OM = $_POST['OM'];
    $MOMO = $_POST['MOMO'];
    $BANQUE = $_POST['BANQUE'];
    $CASH = $_POST['CASH'];

    if (!empty($OM) || !empty($MOMO) || !empty($BANQUE) || !empty($CASH) || !empty($reference)){
        $client->insertToCommande($refecrence,$OM." ".$MOMO." ".$BANQUE." ".$CASH);
        header('Location: client.php');
    }else{
        header('Location: client.php');
    }
         
    
    
}


?>