<?php
require '../../vendor/autoload.php';

session_start();
// Connexion à la base de données
require_once("../connexion.php");
require_once("../bdmutilple/getproduit.php");

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$produit = new Produit();
// Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function creerProduit($nom, $type, $prixvente, $prixachat,$quantite,$cathegorie) {
    global $conn;

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

    $sql = "INSERT INTO produit (nom_produit, prix_produit_vente,quantite_produit, prix_achat_produit, stock_start_produit,type_produit,date_ajout_produit,cathegorie,iduser) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $date = date("Y-m-d H:i:s");
    $stmt->bind_param('sddddsssd', $nom, $prixvente,$quantite,  $prixachat,$quantite,$type, $date,$cathegorie,$_SESSION["id"]);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();
    $conn->close();
}

// Formulaire d'enregistrement produit
if (isset($_POST['enregistrement'])) {

    $nom = $_POST['Nomproduit'];
    $type = $_POST['typeProduit'];
    $prixvente = $_POST['prixvente'];
    $prixachat = $_POST['prixachat'];
    $quantite = $_POST['InputQuantite'];
    $cathegorie = $_POST['cathegorie'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($nom) && !empty($type) && !empty($prixvente) && !empty($prixachat) && !empty($quantite) && !empty($cathegorie)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            $sql = "SELECT * FROM produit WHERE nom_produit = ?";

            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            
            $stmt->bind_param('s', $nom);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo 'Cette produit est déjà utilisée.';
                //exit();
            } else {
                // Créer le compte utilisateur
                creerProduit($nom, $type, $prixvente, $prixachat, $quantite,$cathegorie);
                header("Location:liste.php");
                exit();
            }

            $stmt->close(); 
    }

    if (($_FILES['file_excel']) && ($_FILES['file_excel']['error'] == 0)) {
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
                "PRODUITS" => " ",
                "QUANTITES" => 0,
                "PRIX_ACHAT" => " ",
                "PRIX_VENTE" => " ",
                "TYPE" => " ",
                "CATHEGORIE" => " ",
         );

            if ($highestColumnIndex==6) {
                foreach ($worksheet->getRowIterator() as $row) {
                    $cellIterator = $row->getCellIterator();
                    $indextabe=1;
                    foreach ($cellIterator as $cell) {
                        $value = $cell->getValue();
                        //echo $value.' ';
                        switch ($indextabe) {
                            case 1:
                                $tmp["PRODUITS"] = $value;
                                break;
                            case 2:
                                $tmp["QUANTITES"] = $value;
                                break;
                            case 3:
                                $tmp["PRIX_ACHAT"] = $value;
                                break;
                            case 4:
                                $tmp["PRIX_VENTE"] = $value;
                                break;
                            case 5:
                                $tmp["TYPE"] = $value;
                                break;
                            case 6:
                                $tmp["CATHEGORIE"] = $value;
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
                    $produit->InserProduit($valu,$_SESSION["id"]);
                }
                header("Location: liste.php");
            }else{
                header("Location: produit.php");
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

// Formulaire d'modification produit
if (isset($_POST['modifier'])) {

    $id = $_POST['reference'];
    $nom = $_POST['Nomproduit'];
    $type = $_POST['typeProduit'];
    $prixvente = $_POST['prixvente'];
    $prixachat = $_POST['prixachat'];
    $quantite = $_POST['InputQuantite'];
    $cathegorie = $_POST['cathegorie'];
    
    // Vérifier si tous les champs sont remplis
    if (!empty($nom) || !empty($type) || !empty($prixvente) || !empty($prixachat) || !empty($quantite) || !empty($cathegorie)) {
        
            // Vérifier si l'adresse e-mail existe déjà
            $sql = "SELECT * FROM produit WHERE id = ?";

            if (!$stmt = $conn->prepare($sql)) {
                die('Erreur de préparation de la requête : ' . $conn->error);
            }
            
            $stmt->bind_param('d', $id);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $sesion = $_SESSION["id"];
                $sql = "UPDATE produit set nom_produit ='$nom',type_produit ='$type', prix_produit_vente ='$prixvente',
                	prix_achat_produit ='$prixachat', quantite_produit ='$quantite',cathegorie ='$cathegorie',iduser ='$sesion' WHERE id = '$id'";
                $result = $conn->query($sql);
                
                $sql = "UPDATE historiquestock set Nomproduit ='$nom' WHERE idproduit  = '$id'";
                $result = $conn->query($sql);
                header("Location: liste.php");

            } else {
                echo 'Ce produit viens d de quel stock.';
            } 
    }else {
        header("Location: ../../404.html");
        exit();
    }
}

if (isset($_POST["template"])) {
    // Charger un fichier Excel existant (remplacer 'mon_fichier.xlsx' par votre chemin)
    // un nouvel objet Spreadsheet
    $spreadsheet = new Spreadsheet();

    // Sélectionner la feuille active (par défaut, la première)
    $sheet = $spreadsheet->getActiveSheet();

    // Écrire des données dans une cellule
    $sheet->setCellValue('A1', 'PRODUITS');
    $sheet->setCellValue('B1', 'QUANTITE');
    $sheet->setCellValue('C1', 'PRIXVENTE');
    $sheet->setCellValue('D1', 'PRIXACHAT');
    $sheet->setCellValue('E1', 'TYPE');
    $sheet->setCellValue('F1', 'CATHEGORIE');
    // Créer un writer pour le format XLSX
    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="template.xlsx"'); 

    header('Cache-Control: max-age=0');

    // Sauvegarder le fichier directement dans la sortie
    $writer->save('php://output');
    exit;
}

?>

