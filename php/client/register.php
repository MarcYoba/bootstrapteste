<?php

// Connexion à la base de données

require_once("../bdmutilple/getclient.php");
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//use PhpOffice\PhpSpreadsheet\Cell\CellIterator;

//header('Content-Type: application/json');
$json = file_get_contents('php://input');
$donnees = json_decode($json,true);

$client = new Client(1);

if (!empty($donnees)) {
    if (is_array($donnees)) {
       echo json_encode($client->insertToClient($donnees));
    }
}

// Fonction pour créer un compte utilisateur
function creerClient($nom, $prenom, $email, $mot_de_passe,$phone,$sexe) {
    global $conn;
    $roles = "client";
    // Hacher le mot de passe
    $hash= password_hash($mot_de_passe, PASSWORD_DEFAULT, [
        'cost' => 12, // Ajuster le coût selon vos besoins
    ]);

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO client (firstname,adresse, telephone,sexe, datecreation) VALUES (?, ?, ?, ?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $date = date("y/m/d");
    $stmt->bind_param('ssdss', $nom , $prenom ,  $phone,$sexe, $date);

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
    $phone = $_POST['Inputphone'];
    $sexe = $_POST['sexe'];

    // Vérifier si tous les champs sont remplis
    if (isset($nom ) && isset($prenom) && isset($phone) && isset($sexe)) {

        if (!empty($nom) || !empty($prenom) || !empty($email) || !empty($mot_de_passe) || !empty($mot_de_passe_verifi) || !empty($phone) || !empty($sexe)) {
            if ($mot_de_passe_verifi == $mot_de_passe){
    
                // Vérifier si l'adresse e-mail existe déjà
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
                    creerClient($nom, $prenom, $email, $mot_de_passe, $phone,$sexe);
                   // header("Location: ../../home.html");
                    header("Location:liste.php");
                    exit();
                }
    
                $stmt->close();
    
            }else{
                echo 'verifier mote de passe.';
            }
            
        }
        
    }

  

    if (isset($_FILES['file_excel']) && ($_FILES['file_excel']['error'] == 0)) {
        if (!empty($_FILES["file_excel"])) {
             $file_name = $_FILES['file_excel']['name'];
             $file_tmp = $_FILES['file_excel']['tmp_name'];
             $file_type = $_FILES['file_excel']['type'];
     
             //var_dump($file_name);
                 // Vérification du type de fichier (ici, on vérifie si c'est un fichier Excel)
         if($file_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
             // Déplacement du fichier vers un répertoire de destination (à adapter)
             $destination = '../../uploads'.$file_name;
             move_uploaded_file($file_tmp,$destination);
     
             // Utilisation de PHPSpreadsheet pour lire le fichier Excel
             $spreadsheet = IOFactory::load($destination);
             $worksheet = $spreadsheet->getActiveSheet();
             $highestColumn = $worksheet->getHighestColumn();
             $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
            
            $tab= [];
            
            $tmp = array(
                "NOMS" => " ",
                "TELEPHONE" => 0,
                "SUJETS" => " ",
         );

            if ($highestColumnIndex==3) {
                foreach ($worksheet->getRowIterator() as $row) {
                    $cellIterator = $row->getCellIterator();
                    $indextabe=1;
                    foreach ($cellIterator as $cell) {
                        $value = $cell->getValue();
                        //echo $value.' ';
                        switch ($indextabe) {
                            case 1:
                                $tmp["NOMS"] = $value;
                                break;
                            case 2:
                                $tmp["TELEPHONE"] = $value;
                                break;
                            case 3:
                                $tmp["SUJETS"] = $value;
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                        $indextabe++;
                    }
                    array_push($tab,$tmp);
                    
                    //echo '<br>';
                }
                array_shift($tab);
                foreach ($tab as $key => $valu) {
                    $indextabe = 1;
                   foreach ($valu as $key => $val) {    
                        if ($indextabe == 1) {
                            $tmp["NOMS"] = $val;
                        }else if($indextabe == 2){
                            $tmp["TELEPHONE"] = $val;
                        }else{
                            $tmp["SUJETS"] = $val;
                        }
                    
                    $indextabe++;
                    
                   }
                   $client->insertToClientFile($tmp);
                }
                header("Location: liste.php");
            }else{
                header("Location: client.php");
            }
            // Parcours des lignes et des colonnes
         } else {
             echo 'Le fichier envoyé n\'est pas un fichier Excel.';
         }
        } else {
            echo 'Aucun fichier n\'a été envoyé.';
        }
        
    }else{
        echo "erreur";
    }
    
}


if (isset($_POST["template"])) {
    // Charger un fichier Excel existant (remplacer 'mon_fichier.xlsx' par votre chemin)
    // un nouvel objet Spreadsheet
$spreadsheet = new Spreadsheet();

// Sélectionner la feuille active (par défaut, la première)
$sheet = $spreadsheet->getActiveSheet();

// Écrire des données dans une cellule
$sheet->setCellValue('A1', 'NOMS');
$sheet->setCellValue('B1', 'TELEPHONE');
$sheet->setCellValue('C1', 'SUJET');
// Créer un writer pour le format XLSX
$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Template.xlsx"'); 

header('Cache-Control: max-age=0');

// Sauvegarder le fichier directement dans la sortie
$writer->save('php://output');

}


?>

