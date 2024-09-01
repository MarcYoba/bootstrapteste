<?php
session_start();
require_once("../connexion.php");
header('Content-Type: application/json');


$json = file_get_contents('php://input');
$donnees = json_decode($json,true);
$credit = 0;
    $cash = 0;
    $tab = array(
        "montantcash" => 0,
        "quantitecash" => 0,
        "typecash" => " ",
        "montantcredit" => 0,
        "quantitecredit" => 0,
        "typecredit" => " ",
        "provende" => "provenderie",
        "pharmacie" => "pharmacie",
        "provend" => 0,
        "phamac" => 0,
        "idclient" => 0,
        "idvente" =>0,
        "date" => 0
        );
   /* 
        $reponse = [
            'success' => true,
            'message' => "enregistrement avec success"
        ];
        echo json_encode($reponse);
    */

 // Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
function insertCaisse($operation,$montant,$idvente) {
    global $conn;
    
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 


    $sql = "INSERT INTO caisse (operation,montant,idvente,iduser,dateoperation,motif) VALUES (?, ?, ?, ?, ?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $date = date("y/m/d");
    $motif = "vente";
    $stmt->bind_param('sdddss', $operation, $montant, $idvente, $_SESSION["id"], $date,$motif);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête
    $stmt->close();

    // selection la id dans la table d'achat

       // insertPrix($produit, $prix,$id);
    
}

function insertDette($quantite,$prix,$idvente,$idclient) {
    global $conn;

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 


    $sql = "INSERT INTO dette (quantite,prix,montant,idclient,iduser,datedette,idvente,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
   // $montant = $quantite * $prix;
    $dette = "en cour";
    $date = date("y/m/d");
    $stmt->bind_param('dddddsds', $quantite, $prix,$prix, $idclient, $_SESSION["id"], $date,$idvente,$dette);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    $sql ="SELECT SUM(dette) as somme FROM client WHERE id='$idclient'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $versement = $prix + $row["somme"];

       $sql = "UPDATE client SET dette = '$versement' WHERE id ='$idclient'" ;
       $result = $conn->query($sql);
    // Fermer la requête
    $stmt->close();

    
}

function insertFacture($nomproduit,$quantite,$prix,$idvente,$idclient,$typepaie) {
    global $conn;

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 


    $sql = "INSERT INTO facture (nomproduit,quantite,prix,montant,Typepaiement,idclient,iduser,datefacture,idvente) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $montant = $quantite * $prix;

    $date = date("y/m/d");
    $stmt->bind_param('sdddsddsd',$nomproduit, $quantite, $prix,$montant,$typepaie, $idclient, $_SESSION["id"], $date,$idvente);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête su
    $stmt->close(); 

    $nomproduit = substr_replace($nomproduit,"",strpos($nomproduit,"provenderie"));
    
    $sqlproduit = "SELECT quantite_produit as quantite  FROM produit  WHERE nom_produit = '$nomproduit'";
    $resultproduit = $conn->query($sqlproduit);
    $row = mysqli_fetch_assoc($resultproduit);
    $quantitestock = $row["quantite"];
    $quantite = $quantitestock - $quantite;

     $sql = "UPDATE produit SET quantite_produit ='$quantite' WHERE nom_produit = '$nomproduit'";
    $result = $conn->query($sql);       

}

// insertion dans la table de vents du produit


function insertVente($type,$quntite,$prix,$idclient,$typeproduit,$donnees,$datevente) {
    global $conn;
    
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du prix (insertion de donne) 

    if ($type != " ") {
        $sql = "INSERT INTO vente (typevente,quantite,prix,idclient,iduser,datevente,typeprduit) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Lier les paramètres
        if (!$stmt = $conn->prepare($sql)) {
            die('Erreur de préparation de la requête : ' . $conn->error);
        }
        $date =  date("y/m/d");
        
        if ($datevente == "") {
            $date = date("y/m/d");
        } else {
            //$date = date("y/m/d",strtotime($datevente));
            $date = $datevente;
        }
        
        $stmt->bind_param('sddddss', $type , $quntite, $prix,$idclient,$_SESSION["id"], $date,$typeproduit);

        // Exécuter la requête
        if (!$stmt->execute()) {
            die('Erreur d\'exécution de la requête : ' . $stmt->error);
        }

        // Fermer la requête
        $stmt->close();

        // selection la id dans la table d'achat

    
        $sql = "SELECT id FROM vente WHERE datevente = '$date' ORDER BY id DESC LIMIT 1";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            $id = $row["id"];
            $tab["idvente"] = $row["id"];

            if ($type == "CASH") {
                insertCaisse($type, $prix,$id);
                foreach ($donnees as $key => $value) {
                    if ($value["typepaie"] == "CASH") {
                        insertFacture($value["produit"],$value["quantite"],$value["prix"],$tab["idvente"] ,$value["fournisseur"],$value["typepaie"]);
                    }
                }
                $id = $tab["idvente"];
                $sql = "SELECT id FROM facture WHERE idvente = '$id'";
                $result = $conn->query($sql);
                $idfacture =0 ;
                
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($idfacture==0) {
                        $idfacture= $row["id"];
                    } else {
                        $idfacture = $idfacture.$row["id"];
                    }
                    
                }

                $sql = "UPDATE vente set numfacture ='$idfacture' WHERE id = '$id'";
                $result = $conn->query($sql);
                  
            }else if($type == "CREDIT"){ 
                insertDette($quntite,$prix,$id,$idclient);
                foreach ($donnees as $key => $value) {
                    if ($value["typepaie"] == "CREDIT") {
                        insertFacture($value["produit"],$value["quantite"],$value["prix"],$tab["idvente"] ,$value["fournisseur"],$value["typepaie"]);
                    }              
                }
                $id = $tab["idvente"];
                $sql = "SELECT id FROM facture WHERE idvente = '$id'";
                $result = $conn->query($sql);
                $idfacture =0 ;
                
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($idfacture==0) {
                        $idfacture = $row["id"];
                    } else {
                        $idfacture = $idfacture.$row["id"];
                    }
                    
                }

                $sql = "UPDATE vente set numfacture ='$idfacture' WHERE id = '$id'";
                $result = $conn->query($sql);
            }
    }
}

try {
    
    foreach ($donnees as $key => $value) {
        /*
        if ((str_contains($value["produit"],$tab["pharmacie"])) == true) {
            $tab["phamac"] = 1;
            $tab["idclient"] = $value["fournisseur"];
        } 
        */
        if((str_contains($value["produit"],$tab["provende"])) == true) {
            $tab["provend"] = 1; 
            $tab["idclient"] = $value["fournisseur"]; 
        }
        
        if ($tab["provend"] == 1 && $tab["phamac"] ==1 ) {
            $reponse = [
                'success' => false,
                'message' => "echec"
             ];
            echo json_encode($reponse);
            exit();
        }
        
        if ($value["typepaie"] == "CASH") {

            $tab["montantcash"] = $value["total"] + $tab["montantcash"];
            $tab["quantitecash"] = $value["quantite"] + $tab["quantitecash"];
            $tab["typecash"] = "CASH";
            $tab["date"] = $value["date"];
        }else{
            $tab["montantcredit"] = $value["total"] + $tab["montantcredit"];
            $tab["quantitecredit"] = $value["quantite"] + $tab["quantitecredit"];
            $tab["typecredit"] = "CREDIT";
            $tab["date"] = $value["date"];
        }   
    }

    if ($tab["provend"] == 1) {
        insertVente($tab["typecash"],$tab["quantitecash"],$tab["montantcash"], $tab["idclient"],$tab["provende"],$donnees,$tab["date"]);
        insertVente($tab["typecredit"],$tab["quantitecredit"],$tab["montantcredit"], $tab["idclient"],$tab["provende"],$donnees,$tab["date"]);
    } elseif( $tab["phamac"] == 1){
        insertVente($tab["typecash"],$tab["quantitecash"],$tab["montantcash"], $tab["idclient"],$tab["pharmacie"],$donnees,$tab["date"]);
        insertVente($tab["typecredit"],$tab["quantitecredit"],$tab["montantcredit"], $tab["idclient"],$tab["pharmacie"],$donnees,$tab["date"]);
    }
    
    $reponse = [
        'success' => true,
        'message' =>  $tab
     ];
    echo json_encode($reponse);

} catch (\Throwable $th) {
   // $reponse = [
        //'success' => "exec",
        //'message' => "probleme execusion"
    // ];
    echo json_encode($th);
    
}



?>
