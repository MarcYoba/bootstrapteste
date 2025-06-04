<?php

// Connexion à la base de données
session_start();
require_once("../connexion.php");
require_once("../bdmutilple/getuser.php");

$user = new User();
// Fonction pour créer un compte utilisateur
function creerCompte($nom, $prenom, $email, $mot_de_passe,$roles,$travaile ) {
    global $conn;
    
    // Hacher le mot de passe
    $hash= password_hash($mot_de_passe, PASSWORD_DEFAULT, [
        'cost' => 12, // Ajuster le coût selon vos besoins
    ]);

    // Préparer la requête SQL
    
    $sql = "INSERT INTO user (email, roles, password, firstname, lastname, datecreate, zonetravail) VALUES (?, ?, ?, ?, ?, ?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param('sssssss', $email , $roles ,  $hash, $nom, $prenom, date("d/m/y"),$travaile);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
}

function creerClient($nom, $prenom, $email, $mot_de_passe,$phone,$speculation,$ancienete) {
    global $conn;
    $roles = "client";
    // Hacher le mot de passe
    $hash= password_hash($mot_de_passe, PASSWORD_DEFAULT, [
        'cost' => 12, // Ajuster le coût selon vos besoins
    ]);

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO client (firstname,adresse, telephone,speculation,enceinente ,datecreation) VALUES (?, ?, ?, ?,? ,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $date = date("y/m/d");
    $stmt->bind_param('ssdsss', $nom , $prenom ,  $phone,$speculation,$ancienete, $date);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    //--------------------------------------------------------------------------------------
    // select id client  

    $sql = "SELECT id FROM client WHERE telephone = '$phone'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    $idclient =  $row["id"];

    //---------------------------------------------------------------------------------------
    //creation de l'utilisateur pour le client (insertion de donne)
    
    $sql = "INSERT INTO user (email, roles, password, firstname, lastname, datecreate, idclient) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $stmt->bind_param('ssssssd', $email , $roles ,  $hash, $nom, $prenom, $date, $idclient);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
}

// Formulaire d'inscription
if (isset($_POST['submit'])) {

    $nom = $_POST['FirstName'];
    $prenom = $_POST['LastName'];
    $email = $_POST['InputEmail'];
    $mot_de_passe = $_POST['InputPassword'];
    $mot_de_passe_verifi = $_POST['RepeatPassword'];
    $roles = $_POST["roleuser"];
    $iduser = $_POST["iduser"];
    $travaile = $_POST["travaile"];
    $cathegorie = $_POST["cathegorie"];
    // Vérifier si tous les champs sont remplis
    if (!empty($nom) || !empty($prenom) || !empty($email) || !empty($mot_de_passe) || !empty($mot_de_passe_verifi) || !empty($travaile)) {
        if ($mot_de_passe_verifi == $mot_de_passe){
            if ($iduser == 0) {
                $sql = "SELECT * FROM user WHERE email = ?";

                if (!$stmt = $conn->prepare($sql)) {
                    die('Erreur de préparation de la requête : ' . $conn->error);
                }
                
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $stmt->store_result();
    
                if ($stmt->num_rows > 0) {
                    echo 'Cette adresse e-mail est déjà utilisée.';
                } else {
                    // Créer le compte utilisateur
                    creerCompte($nom, $prenom, $email, $mot_de_passe,$roles, $travaile);
                    header("Location: ../../index.php");
                    exit();
                }
    
                $stmt->close();
            } else {
                if ($mot_de_passe == $mot_de_passe_verifi) {
                    if ($user->UpdateUser($nom,$prenom,$email,$mot_de_passe,$roles,$iduser,$travaile,$cathegorie)) 
                    {
                        header("location:liste.php");
                    } else {
                        header("location:page.php?id".$iduser);
                     }
                }else{
                    header("location:page.php?id".$iduser);
                }
            }
            
            // Vérifier si l'adresse e-mail existe déjà
           

        }else{
            echo 'verifier mote de passe.';
        }

        
    }else {
        header("Location: ../../404.html");
        exit();
    }
}else if (isset($_POST['create'])) {
    echo 'non';
if (isset($_POST['create'])) {
    $nom = $_POST['FirstName'];
    $prenom = $_POST['LastName'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $mot_de_passe = $_POST['InputPassword'];
    $mot_de_passe_verifi = $_POST['RepeatPassword'];
    $speculation = $_POST["speculation"];
    $ancienete = $_POST["ancienete"];

    // Vérifier si tous les champs sont remplis
    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($mot_de_passe) && !empty($mot_de_passe_verifi) && !empty($ancienete)) {
        if ($mot_de_passe_verifi == $mot_de_passe) {
            $sql = "SELECT * FROM user WHERE email = ?";

            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }

            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo 'Cette adresse e-mail est déjà utilisée.';
            } else {
                // Créer le compte utilisateur
                creerClient($nom, $prenom, $email, $mot_de_passe, $telephone,$speculation,$ancienete);
                header("Location: ../../index.php");
                exit();
            }

            $stmt->close();
        } else {
            echo 'Les mots de passe ne correspondent pas.';
        }
    } else {
        echo 'Veuillez remplir tous les champs.';
    }
}
}else{
    header("Location: ../../404.html");
    exit();
}

?>

