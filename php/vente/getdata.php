<?php
require_once("../bdmutilple/getclient.php");
header('Content-Type: application/json');
global $conn;

$json = file_get_contents('php://input');
$donnees = json_decode($json,true);


if (is_array($donnees)){
    $data = 0;
    $quantite = 0;
    $nom = $donnees["nom"];
            $sql = "SELECT nom_produit as nom, prix_produit_vente as prix, quantite_produit as quantite FROM produit WHERE nom_produit = '$nom'";
            $result = $conn->query($sql);
    
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["nom"] == $donnees["nom"] ) {
                        $data = $row["prix"];
                        $quantite = $row["quantite"];
                        break;
                     
                } else {
                    
                }     
            }
            
          
            
    $reponse = [
        'success' => true,
        'message' => $data,
        'quantite' => $quantite
     ];
    echo json_encode($reponse);
}else{
    $client = new Client($donnees);
    $reponse = [
        'success' => true,
        'nom' => $client->getByNameClient($donnees),
     ];
    echo json_encode($reponse);
}


?>