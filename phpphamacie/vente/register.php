<?php
session_start();
require_once("../connexion.php");
header('Content-Type: application/json');


$json = file_get_contents('php://input');
$donnees = json_decode($json,true);
$credit = 0;
    $cash = 0;
    $tab = array(
        "typepaiement" => "Banque",
        "provende" => "provenderie",
        "pharmacie" => "pharmacie",
        "provend" => 0,
        "phamac" => 0,
        "idclient" => 0,
        "idvente" => 0,
        "date" => 0,
        "cash" => 0,
        "credit" => 0,
        "om" => 0,
        "Banque" => 0,
        "status" => 0,
        "montant" => 0,
        "quantite" => 0,
        "reduction" => 0,
    );

    $donneVente = 1;
   /* 
        $reponse = [
            'success' => true,
            'message' => "enregistrement avec success"
        ];
        echo json_encode($reponse);
    */

 // Fonction pour créer un compte utilisateur $nom, $type, $prixvente, $prixachat, $quantite
 function produitstock($idvente,$quantiteRestant,$produit) {
    global $conn;
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------

    $sql = "INSERT INTO quantiteproduitphamacie(quantiteRestant,produit,idvente,iduser,Qtdate) VALUES (?, ?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $date = date("y/m/d");
    $stmt->bind_param('dsdds', $quantiteRestant,$produit, $idvente, $_SESSION["id"], $date);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }
    // Fermer la requête
    $stmt->close();
    
}

 function cashvente($lecash) {
    global $conn;
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------

    $sql = "INSERT INTO cashphamacie(montant,idvente ,idclient ,iduser,datacash) VALUES (?, ?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $date = date("y/m/d");
    $stmt->bind_param('dddds', $lecash["cash"], $lecash["idvente"], $lecash["idclient"], $_SESSION["id"], $date);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }
    // Fermer la requête
    $stmt->close();
    
}

function OM_momo($om) {
    global $conn;
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------

    $sql = "INSERT INTO om_momophamacie (montamt,idvente ,idclient ,iduser,dateOM) VALUES (?, ?, ?, ?, ?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }

    $date = date("y/m/d");
    $stmt->bind_param('dddds', $om["om"], $om["idvente"], $om["idclient"], $_SESSION["id"], $date);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }
    // Fermer la requête
    $stmt->close();
    
}

function insertCaisse($operation,$montant,$idvente) {
    global $conn;
    
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------

    $sql = "INSERT INTO caissePhamacie (operation,montant,idvente,iduser,dateoperation,motif) VALUES (?, ?, ?, ?, ?,?)";

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
    
}

function insertDette($quantite,$prix,$idvente,$idclient) {
    global $conn;

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 


    $sql = "INSERT INTO dettephamacie (quantite,prix,montant,idclient,iduser,datedette,idvente,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

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

function insertFacture($nomproduit,$quantite,$prix,$idvente,$idclient,$typepaie,$datevente) {
    global $conn;

    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du client (insertion de donne) 

   // $nomproduit = substr_replace($nomproduit,"",strpos($nomproduit,"provenderie"));
    
    $sqlproduit = "SELECT id as id , quantite_produit AS quantite  FROM produitphamacie  WHERE nom_produit = '$nomproduit'";
    $resultproduit = $conn->query($sqlproduit);
    $row = mysqli_fetch_assoc($resultproduit);
    $id = $row["id"];
    $quantitestock = $row["quantite"];


    $sql = "INSERT INTO facturephamacie (nomproduit,quantite,prix,montant,Typepaiement,idclient,iduser,datefacture,idvente,idproduit) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)";

    // Lier les paramètres
    if (!$stmt = $conn->prepare($sql)) {
        die('Erreur de préparation de la requête : ' . $conn->error);
    }
    $montant = $quantite * $prix;

    if ($datevente == "") {
        $date = date("y/m/d");
    } else {
        $date = $datevente;
    }
    $stmt->bind_param('sdddsddsdd',$nomproduit, $quantite, $prix,$montant,$typepaie, $idclient, $_SESSION["id"], $date,$idvente,$id);

    // Exécuter la requête
    if (!$stmt->execute()) {
        die('Erreur d\'exécution de la requête : ' . $stmt->error);
    }

    // Fermer la requête su
    $stmt->close(); 
    
    $quantite = $quantitestock - $quantite;
    if ($quantite == 0) {
        $sql = "UPDATE produitphamacie SET quantite_produit ='$quantite',datePeramtion='' WHERE id = '$id'";
    } else {
        $sql = "UPDATE produitphamacie SET quantite_produit ='$quantite' WHERE id = '$id'";
    }
    $result = $conn->query($sql); 
    if ($result === True) {
        produitstock($idvente,$quantite,$nomproduit);
    } 
    
}

// insertion dans la table de vents du produit


function insertVente($type,$quntite,$prix,$idclient,$typeproduit,$donnees,$datevente,$tab) {
    global $conn;
    global $donneVente;
    // Préparer la requête SQL
    // --------------------------------------------------------------------------------
    // Creation du prix (insertion de donne) 

    if ($type != " ") {
        $sql = "INSERT INTO ventephamacie (typevente,quantite,prix,idclient,iduser,datevente,typeprduit,cash,credit,Om,reduction,banque,heure,statusvente) VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?)";

    // Lier les paramètres
        if (!$stmt = $conn->prepare($sql)) {
            die('Erreur de préparation de la requête : ' . $conn->error);
        }
        $date =  date("y/m/d");
        
        if ($datevente == "") {
            $date = date("y/m/d");
        } else {
            $date = $datevente;
        }
        date_default_timezone_set('Africa/Douala');
        $timestamp = new DateTime();
        $timestamp = $timestamp->format('H:i:s');
        $stmt->bind_param('sddddssdddddss', $type , $quntite, $prix,$idclient,$_SESSION["id"], $date,$typeproduit,$tab["cash"],$tab["credit"],$tab["om"],$tab["reduction"],$tab["Banque"],$timestamp,$tab["status"]);

        // Exécuter la requête
        if (!$stmt->execute()) {
            die('Erreur d\'exécution de la requête : ' . $stmt->error);
        }

        // Fermer la requête
        $stmt->close();

        // selection la id dans la table d'achat

        $sql = "SELECT id FROM ventephamacie WHERE datevente = '$date' ORDER BY id DESC LIMIT 1";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            $id = $row["id"];
            $tab["idvente"] = $row["id"];
            $donneVente = $row["id"];

            if (($tab["cash"] > 0)) {
                cashvente($tab);
                insertCaisse("CASH", $tab["cash"],$id);  
            }
            if($tab["credit"] > 0){ 
                insertDette($tab["quantite"],$tab["credit"],$id,$idclient);
            }
            if ($tab["om"] > 0) {
                OM_momo($tab);
                insertCaisse("OM", $tab["om"],$id); 
            }
    
        foreach ($donnees as $key => $value) {
            insertFacture($value["produit"],$value["quantite"],$value["prix"],$tab["idvente"] ,$value["fournisseur"],$tab["typepaiement"],$datevente);             
        }
        $id = $tab["idvente"];
        
        
    }
}

try {
    
    foreach ($donnees as $key => $value) {
        
        
            $tab["provend"] = 1; 
            $tab["idclient"] = $value["fournisseur"]; 
        
        
        if ($tab["provend"] == 1 && $tab["phamac"] == 1 ) {
            $reponse = [
                'success' => false,
                'message' => "echec"
             ];
            echo json_encode($reponse);
            exit();
        }      
    }

    $denierligne= end($donnees);
    if ($denierligne["momo"] > 0 ) {
        $tab["typepaiement"] = "OM";
        $tab["om"] = $denierligne["momo"];
        if ($denierligne["cash"] > 0) {
            $tab["cash"] = $denierligne["cash"];
            $tab["typepaiement"] = "OM/CASH";
            if ($denierligne["credit"] > 0) {
                $tab["credit"] = $denierligne["credit"];
                $tab["typepaiement"] = "OM/CASH/CREDIT";
            }  
        }    
    } else {
        if ($denierligne["cash"] > 0) {
            $tab["typepaiement"] = "CASH";
            $tab["cash"] = $denierligne["cash"];
            if ($denierligne["credit"] > 0) {
                $tab["typepaiement"] = "CASH/CREDIT";
                $tab["credit"] = $denierligne["credit"];
            }
        } else {
            if ($denierligne["credit"]>0) {
                $tab["typepaiement"] = "CREDIT";
                $tab["credit"] = $denierligne["credit"];
            } else {
                $tab["typepaiement"] = "BANQUE";
                $tab["Banque"] = $denierligne["Banque"];
            }
        }   
    }
    $tab["montant"] = $denierligne["Total"];
    $tab["quantite"] = $denierligne["Qttotal"];
    $tab["reduction"] = $denierligne["reduction"];
    $tab["idclient"] = $denierligne["fournisseur"];
    $tab["date"] = $denierligne["date"];
    $tab["Banque"] = $denierligne["Banque"];
    $tab["status"] = $denierligne["statusvente"];

    array_pop($donnees);

    
    if ($tab["provend"] == 1) {

        insertVente($tab["typepaiement"],$tab["quantite"],$tab["montant"], $tab["idclient"],$tab["provende"],$donnees,$tab["date"],$tab);
       // insertVente($tab["typecredit"],$tab["quantitecredit"],$tab["montantcredit"], $tab["idclient"],$tab["provende"],$donnees,$tab["date"]);
    } elseif( $tab["phamac"] == 1){
        insertVente($tab["typepaiement"],$tab["quantite"],$tab["montant"], $tab["idclient"],$tab["pharmacie"],$donnees,$tab["date"],$tab);
       // insertVente($tab["typecredit"],$tab["quantitecredit"],$tab["montantcredit"], $tab["idclient"],$tab["pharmacie"],$donnees,$tab["date"]);
    }
    

    $reponse = [
        'success' => true,
        'message' =>  $donneVente
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
