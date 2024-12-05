<?php
session_start();
require_once("../connexion.php");
// Vérification si un fichier a été envoyé
if(isset($_FILES['image'])){
    $date = $_POST["date"];
    $target_dir = "uploads/"; // Dossier de destination
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Vérifications de sécurité (à adapter selon vos besoins)
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "Fichier image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Le fichier n'est pas une image.";
            $uploadOk = 0;
        }
    }
    // ... Autres vérifications (taille, format, etc.)

    // Si aucune erreur n'a été détectée, on enregistre le fichier
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléchargé.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            //echo "Le fichier ". basename( $_FILES["image"]["name"]). " a été téléchargé.";
           // $date = date("Y-m-d");
            $sql = "INSERT INTO Boncommande (nomimage , chemin,iduser,datecommade) VALUES ('" . basename($_FILES["image"]["name"]) . "', '" . $target_file . "','".$_SESSION["id"]."','".$date."')";
            if (mysqli_query($conn, $sql)) {
                header('Location:liste.php?date='.$date.'');
            } else {
                echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Une erreur est survenue lors du téléchargement du fichier.";
        }
    }
}else if(isset($_POST['edite'])){
    if(isset($_FILES['images'])){
        $date = $_POST["date"];
        $idimage = $_POST["idimage"];
        $target_dir = "uploads/"; // Dossier de destination
        
        $target_file = $target_dir . basename($_FILES["images"]["name"]);

        // Vérifications de sécurité (taille, type, etc.)
    
        // Si l'upload est réussi, on supprime l'ancienne image et on met à jour la base de données
        if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
            // Récupérer l'ancien chemin de l'image depuis la base de données
            $sql = "SELECT chemin FROM boncommande WHERE id = $idimage";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $ancien_chemin = $row['chemin'];
    
            // Supprimer l'ancienne image du serveur
            unlink($ancien_chemin);
    
            // Mettre à jour le chemin dans la base de données
            $sql = "UPDATE boncommande SET chemin = '$target_file' WHERE id = $idimage";
            mysqli_query($conn, $sql);
    
            header('Location:liste.php?date='.$date.'');
        }
    }
}