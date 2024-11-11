<?php
require_once("../connexion.php");
global $conn;



// Formulaire d'enregistrement produit
if (isset($_POST['submit'])) {

    $date = $_POST['date'];
    $Name = $_POST['Name'];
    $vaccin = $_POST['vaccin'];
    $age = $_POST['age'];
    $Sexe = $_POST['Sexe'];
    $Poid = $_POST['Poid'];
    $Espace = $_POST['Espace'];
    $Regime = $_POST['Regime'];
    $Race = $_POST['Race'];
    $Robe = $_POST['Robe'];
    $Temterature = $_POST['Temterature'];
    $idclient = $_POST['idclient'];
    $Motic = $_POST['Mc'];
    $symptomes = $_POST['symptomes'];
    $diagnostic = $_POST['diagnostic'];
    $traitement = $_POST['traitement'];
    $Pronostique = $_POST['Pronostique'];
    $Prophylaxe = $_POST['Prophylaxe'];
    $Indication = $_POST['Indication'];
    $montant = $_POST['montant'];
    $Vermifuge = $_POST['Vermifuge'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($date) || !empty($age) || !empty($Sexe) || !empty($Race) || !empty($diagnostic) || !empty($montant)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            $sql = "SELECT * FROM consultation WHERE Nom = ?";

            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            
            $stmt->bind_param('s', $Name);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo 'Cette animale est déjà utilisée.';
                //exit();
            } else {
               
                // Créer le compte utilisateur
                $sql = "INSERT INTO consultation (Nom, age, sexe, poid, esperce, robe, race, idclient, vaccin, vermufuge, regime, moticconsultation, temperature, symtome, dianostique , traitement , Pronostique , Prophylaxe , Indication , montant,dateArrive) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                    // Lier les paramètres
                    if (!$stmt = $conn->prepare($sql)) {
                        die('Erreur de préparation de la requête : ' . $conn->error);
                    }
                    $date = date("y/m/d");
                    $stmt->bind_param('sdsdsssdssssdssssssds', $Name, $age,$Sexe,$Poid,$Espace,$Robe,$Race,$idclient,$vaccin,$Vermifuge,$Regime,$Motic,$Temterature,$symptomes,$diagnostic,$traitement,$Pronostique,$Prophylaxe,$Indication,$montant, $date);

                    // Exécuter la requête
                    if (!$stmt->execute()) {
                        die('Erreur d\'exécution de la requête : ' . $stmt->error);
                    }

                    // Fermer la requête
                    $stmt->close();
                    $conn->close();

                header("Location:liste.php");
                exit();
            }

            $stmt->close(); 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>