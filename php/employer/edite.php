<?php
require_once("../bdmutilple/getPersonnel.php");

$data = json_decode(file_get_contents('php://input'), true);
$Personnel = new Personnel();

if(isset($_GET['id']) && isset($_GET['nom'])){
    if($_GET['nom'] == "personnel"){
        $result = $Personnel->DeletePersonnel($_GET['id']);
        header("Location: personnel.php");
        exit();
    }else if($_GET['nom'] == "salaire"){
        $result = $Personnel->DeleteSalaire($_GET['id']);
        header("Location: liste.php");
        exit();
    }  
}

if(isset($data['id']) && isset($data['salaire'])){
    if($data['salaire'] == "salaire"){
        $result = $Personnel->getAllByIdSalaire($data['id']);
        echo json_encode($result);
        exit();
    }  
}else if (($data['id']) && isset($data['personnel'])) {
  if($data['personnel'] == "personnel"){
    $result = $Personnel->getAllByIdPersonnel($data['id']);
    echo json_encode($result);
    exit();
}
}

?>  