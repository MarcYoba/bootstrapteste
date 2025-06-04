<?php
 require_once("../connexion.php");

 global $conn;
 $data = json_decode(file_get_contents('php://input'), true);
 // Vérification de la connexion à la base de données

// Récupération de l'ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}else if (!is_array($data)) {
    $id = $data;

    $sql = "SELECT * FROM produit WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Vérification si la vente existe
        $row = $result->fetch_assoc();
        // Encode Une variable JavaScript
        $tableaujson = json_encode($row);
        echo $tableaujson;
    } else {
        echo "Produit nom Trouver";
    }
    $conn->close();

}else if(is_array($data)){
    $id = $data["id"];
    $nom = $data["nom_produit"];
    $quantite = $data["quantite_produit"];
    $prixvente = $data["prix_produit_vente"];
    $prixachat = $data["prix_achat_produit"];
    $typeproduit = $data["type_produit"];
    $cathegorie = $data["cathegorie"];

        $sql = "UPDATE produit SET nom_produit='$nom',prix_produit_vente='$prixvente', quantite_produit='$quantite',
        prix_achat_produit='$prixachat',type_produit ='$typeproduit', cathegorie='$cathegorie' WHERE id = '$id'";
        $result = $conn->query($sql);

        if($result === true){
            $data = array(
                'status' => 'success',
                'message' => 'Produit modifié avec succès.'
            );
            echo json_encode($data);
        }else{
            $data = array(
                'status' => 'false',
                'message' => 'Produit nom modifié avec succès.'
            );
            echo json_encode($data);
        } 

    


}


// Requête SQL pour récupérer les informations de la vente

?>