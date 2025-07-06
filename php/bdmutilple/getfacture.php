<?php

require_once("../connexion.php"); 

class Facture{
    public $idfacture;
    public $TypePaie;
    public $om;
    public $credit;
    public $cash;
    public $idvente;
    

    public function __construct($idfacture)
    {
        $this->idfacture = $idfacture;
        $this->TypePaie ="";
        $this->om =0;
        $this->credit =0;
        $this->cash =0;
        $this->idvente = 0;
    }

    public function sommeVenteProduitFabriquer($anne){
        global $conn;
        
        $sql = "SELECT ROUND(SUM(v.prix),2) AS montant
                FROM vente v 
                INNER JOIN client c ON c.id = v.idclient
                WHERE YEAR(v.datevente) = '$anne'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function sommeVenteProduitFabriquerAnne($anne){
        global $conn;
        
        $sql = "SELECT ROUND(SUM(v.prix),2) AS montant
                FROM facture f 
                INNER JOIN vente v ON v.id = f.idvente 
                WHERE nomproduit='MACHINE' AND YEAR(F.datefacture) = '$anne'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function sommeVenteProduitFabriquerPasser($anne){
        global $conn;
        if ($anne == "") {
            $date = date("Y");
        } else {
            $date = $anne;
        }
        $date = $date-1;
        $sql = "SELECT ROUND(SUM(v.prix),2) AS montant
                FROM facture f 
                INNER JOIN vente v ON v.id = f.idvente 
                WHERE nomproduit='MACHINE' AND YEAR(F.datefacture) = $date";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function getByIdidFacture(){
        global $conn;
        $data =[];
        $sql = "SELECT id,nomproduit,quantite,prix,montant,idvente,idclient,Typepaiement  FROM facture WHERE idvente= '$this->idfacture'";
        $result = $conn->query($sql);
       while($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
       }
        return $data; 
    }

    public function UgradeProduitFacture($idproduit,$quantite){
        global $conn;

        $sql = "SELECT quantite_produit AS quantite FROM produit WHERE  id='$idproduit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result); 
        $quantite = $row["quantite"] + $quantite;

        $sql = "UPDATE produit SET quantite_produit = '$quantite' WHERE id = '$idproduit'";
        $result = $conn->query($sql);
        if($result === true){
            //return "Edite OK";
        }else{
            return "Edite false";
        }  
    }

    public function getIdClientFacture($id){
        global $conn;
        $sql = "SELECT idclient  FROM facture WHERE idvente= '$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["idclient"]; 
    }

    public function getIdQuantite($nomproduit){
        global $conn;
        $sqlproduit = "SELECT id as id ,quantite_produit as quantite   FROM produit  WHERE nom_produit = '$nomproduit'";
        $resultproduit = $conn->query($sqlproduit);
        $row = mysqli_fetch_assoc($resultproduit);
        return $row; 
    }

    public function getSommeProduit($idproduit,$dateProduit){
        global $conn;
        $sql = "SELECT SUM(quantite) AS quantites FROM facture WHERE idproduit='$idproduit' AND datefacture='$dateProduit';";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["quantites"]; 
    }

    public function setIdFacture($produit,$idproduit){
        global $conn;
        $sql = "SELECT idproduit,nomproduit  FROM facture WHERE nomproduit= '$produit'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        if (!empty($row)) {
            $sql = "UPDATE facture SET idproduit='$idproduit' WHERE nomproduit= '$produit'";
            $result = $conn->query($sql); 
            if ($result === TRUE) {
                //return $row; 
            }
            return "Trouver : "; 
        }else{
            return "nom trouver : ".$produit;
        }
    }

    public function produitstock($idvente,$quantite,$nomproduit){
        global $conn;
        
        $sql = "INSERT INTO quantiteproduit (quantiteRestant,produit,idvente,iduser,Qtdate) VALUES (?, ?, ?, ?, ?)";
        if (!$stmt = $conn->prepare($sql)) {
            die('Erreur de préparation de la requête : ' . $conn->error);
        }
        $date = date("y/m/d");
        $stmt->bind_param('dsdds', $quantite,$nomproduit, $idvente, $_SESSION["id"], $date);
        if (!$stmt->execute()) {
            die('Erreur d\'exécution de la requête : ' . $stmt->error);
        }
        $stmt->close();
    }

    public function InsertFacture($nomproduit,$quantite,$prix,$idvente,$idclient,$typepaie,$datevente){
        global $conn;
        //$nomproduit = substr_replace($nomproduit,"",strpos($nomproduit,"provenderie"));
        $nom = $nomproduit ;
        
        $row = $this->getIdQuantite($nomproduit);
        $id = $row["id"];
        $quantitestock = $row["quantite"];
        $quantitef = $quantitestock - $quantite;

        

        $sql = "UPDATE produit SET quantite_produit ='$quantitef' WHERE id = '$id'";
        $result = $conn->query($sql); 
        if ($result === True) {
          // $this->produitstock($idvente,$quantite,$nomproduit);
        }
        
        
        $sql = "INSERT INTO facture (nomproduit,quantite,prix,montant,Typepaiement,idclient,iduser,datefacture,idvente,idproduit) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)";

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
        $stmt->bind_param('sdddsddsdd',$nom, $quantite, $prix,$montant,$typepaie, $idclient, $_SESSION["id"], $date,$idvente,$id);

        // Exécuter la requête
        if (!$stmt->execute()) {
           
            die('Erreur d\'exécution de la requête : ' . $stmt->error);
        }
        
        // Fermer la requête su
        $stmt->close(); 
         
        
    }


    public function EditFacture($value){
        global $conn;
        $ligenid = array_pop($value);
        $this->idvente = $ligenid["idvente"];
        $ligneTotal = array_pop($value);
        

        if ($ligneTotal["cash"]>0) {
            $this->TypePaie = "CASH";
            
            $this->cash =$ligneTotal["cash"];
            if ($ligneTotal["credit"]>0) {
                $this->TypePaie = "CASH/CREDIT";
                $this->credit =$ligneTotal["credit"];
                if ($ligneTotal["momo"]>0) {
                    $this->TypePaie = "CASH/CREDIT/OM";
                    $this->om =$ligneTotal["momo"];
                }
            }elseif($ligneTotal["momo"]>0){
                $this->TypePaie = "CASH/OM";
            }
        } elseif($ligneTotal["credit"]>0) {
            $this->TypePaie = "CREDIT";
            $this->credit =$ligneTotal["credit"];
            if ($ligneTotal["cash"]>0) {
                $this->TypePaie = "CREDIT/CASH";
                $this->cash =$ligneTotal["cash"];
                if ($ligneTotal["momo"]>0) {
                    $this->TypePaie = "CREDIT/CASH/OM";
                    $this->om =$ligneTotal["momo"];
                }
            }elseif ($ligneTotal["momo"]>0) {
                $this->TypePaie = "CREDIT/CASH/OM";
                $this->om =$ligneTotal["momo"];
            }
        }else{
            $this->TypePaie = "OM";
            $this->om =$ligneTotal["momo"];
        }
        $Mmontant = $ligneTotal["Total"] ;
        $quantite = $ligneTotal["Qttotal"];
        $reduction = $ligneTotal["reduction"];

        $sql = "UPDATE vente SET typevente='$this->TypePaie', quantite ='$quantite',prix='$Mmontant',cash='$this->cash',credit='$this->credit', Om='$this->om',reduction='$reduction' WHERE id = '$this->idvente'";
        $result = $conn->query($sql); 
        

        $sql = "SELECT id FROM caisse WHERE idvente = '$this->idvente'";
        $result = $conn->query($sql);

        if ($result->num_rows>0) {
            $Mmontant = $ligneTotal["Total"] - $ligneTotal["credit"];
            $sql = "UPDATE caisse SET operation='$this->TypePaie', montant ='$Mmontant' WHERE idvente = '$this->idvente'";
            $result = $conn->query($sql); 

            if ($result == TRUE) {
                
            } else {
                
            }
        } 
            $sql = "SELECT id FROM dette WHERE idvente = '$this->idvente'";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                $this->credit = $ligneTotal["credit"];
                if ($ligneTotal["credit"] >0 ) {
                    $quantite = $ligneTotal["Qttotal"];
                    $sql = "UPDATE dette SET quantite='$quantite', montant ='$this->credit' WHERE idvente = '$this->idvente'";
                    $result = $conn->query($sql);
                    if ($result == TRUE) {
                       
                    } else {
                        
                    }
                    
                } else {
                    $quantite = $ligneTotal["Qttotal"];
                    $sql = "UPDATE dette SET quantite='$quantite', montant ='$this->credit',status='OK' WHERE idvente = '$this->idvente'";
                    $result = $conn->query($sql);
                    if ($result == TRUE) {
                        
                    } else {
                        
                    }
                }  
                
            }else{
                if ($ligneTotal["credit"] >0) {
                    $Mmontant = $ligneTotal["credit"];
                    $sql = "SELECT idclient FROM vente WHERE id = '$this->idvente'";
                    $result = $conn->query($sql);
                    $row = mysqli_fetch_assoc($result);
                    $idclient = $row["idclient"];
                    $sql = "INSERT INTO dette (quantite,prix,montant,idclient,iduser,datedette,idvente,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
                    // Lier les paramètres
                    if (!$stmt = $conn->prepare($sql)) {
                        die('Erreur de préparation de la requête : ' . $conn->error);
                    }
                // $montant = $quantite * $prix;
                    $dette = "en cour";
                    $date = date("y/m/d");
                    $stmt->bind_param('dddddsds', $quantite, $Mmontant,$Mmontant, $idclient, $_SESSION["id"], $date,$this->idvente,$dette);
        
                    // Exécuter la requête
                    if (!$stmt->execute()) {
                        die('Erreur d\'exécution de la requête : ' . $stmt->error);
                    }
        
                    $sql ="SELECT SUM(dette) as somme FROM client WHERE id='$idclient'";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_assoc($result);
                        $versement = $Mmontant + $row["somme"];
        
                    $sql = "UPDATE client SET dette = '$versement' WHERE id ='$idclient'" ;
                    $result = $conn->query($sql);
                    // Fermer la requête
                    $stmt->close();
                }
            }
            
        
        if ($result == true) {

            $sql = "SELECT id,idclient,quantite,idproduit  FROM facture WHERE idvente = '$this->idvente'";
                $result = $conn->query($sql);
                
            if(($ligneTotal["taille"]-2) >1){
                $sql = "SELECT id,idclient,quantite,idproduit  FROM facture WHERE idvente = '$this->idvente'";
                $result = $conn->query($sql);

                if ($result->num_rows<($ligneTotal["taille"]-2)) {
                    $nblignebd = $result->num_rows;
                    $ndligneFac = ($ligneTotal["taille"]-2);
                    
                    while (($row = mysqli_fetch_assoc($result)) && $nblignebd >0) {
                        $id = $row["id"];
                        $idclient = $row["idclient"];
                        $stockFacture = $row["quantite"];
                        $idproduit = $row["idproduit"];
                       $line = array_shift($value);
                     
                            $nomproduit = $line["produit"];
                            $quantite = $line["quantite"];
                            $position = strpos($nomproduit, "provenderie");

                            if ($position !== false) {
                                // Si le mot est trouvé, le supprimer
                                $nouveauTexte = substr_replace($nomproduit, "", $position, strlen("provenderie"));
                                $nomproduit = $nouveauTexte;
                            } 
                            if ($stockFacture!=$quantite) {
                                $autre = $stockFacture-$quantite;
                                $this->UgradeProduitFacture($idproduit,$autre);
                            }
                            
                            $prix = $line["prix"];
                            $total = $line["total"];
                            //$nomproduit = substr_replace($nomproduit,"",strpos($nomproduit,"provenderie"));
                            $sql = "UPDATE facture SET nomproduit='$nomproduit',quantite='$quantite', prix ='$prix',montant='$total' WHERE  id='$id'";
                            $resultup = $conn->query($sql); 
                            
                            if ($resultup == true) {      
                            }  
                            $nblignebd--; 
                            $ndligneFac--;
                    }
                    $ndligneFac = count($value);
                    while ($ndligneFac > 0) {
                            $line = array_shift($value);
                            $nomproduit = $line["produit"];
                            $quantite = $line["quantite"];
                            $prix = $line["prix"];
                            $total = $line["total"];
                            //$nomproduit = substr_replace($nomproduit,"",strpos($nomproduit,"provenderie"));
                            $this->InsertFacture($nomproduit,$quantite,$prix,$this->idvente,$idclient,$this->TypePaie,date("Y-m-d"));
                            $ndligneFac--;
                    }
                    

                } else if($result->num_rows==($ligneTotal["taille"]-2)) {
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row["id"];
                        $stockFacture = $row["quantite"];
                        $idproduit = $row["idproduit"];
                       $line = array_shift($value);
                     
                            $nomproduit = $line["produit"];
                            $quantite = $line["quantite"];

                            $position = strpos($nomproduit, "provenderie");

                            if ($position !== false) {
                                // Si le mot est trouvé, le supprimer
                                $nouveauTexte = substr_replace($nomproduit, "", $position, strlen("provenderie"));
                                $nomproduit = $nouveauTexte;
                            } 
                            if ($stockFacture!=$quantite) {
                                $autre = $stockFacture-$quantite;
                                $this->UgradeProduitFacture($idproduit,$autre);
                            }
                            $prix = $line["prix"];
                            $total = $line["total"];
                            //$nomproduit = substr_replace($nomproduit,"",strpos($nomproduit,"provenderie"));
                            $sql = "UPDATE facture SET nomproduit='$nomproduit',quantite='$quantite', prix ='$prix',montant='$total' WHERE  id='$id'";
                            $resultup = $conn->query($sql); 
                            
                            if ($resultup == true) {      
                            }    
                    }
                } else if($result->num_rows>($ligneTotal["taille"]-2)) {
                    return "ligne inferieur";
                }
                
             }else{
                foreach ($value as $key) {
                    $nomproduit = $key["produit"];
                    $quantite = $key["quantite"];
                    $prix = $key["prix"];
                    $total = $key["total"];

                    $sql = "SELECT id,idclient,quantite,idproduit,nomproduit  FROM facture WHERE idvente = '$this->idvente'";
                    $result = $conn->query($sql);
                    $row = mysqli_fetch_assoc($result);

                    if ($nomproduit != $row["nomproduit"]) {
                        $n = $row["idproduit"];
                        $q = $row["quantite"];
                        $v = $this->UgradeProduitFacture($n,$q);

                        $sql = "SELECT id  FROM produit WHERE nom_produit = '$nomproduit'";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_assoc($result);
                        $n = $row["id"];
                        $q = $quantite*-1;

                       $v = $this->UgradeProduitFacture($n,$q);
                        $sql = "UPDATE facture SET nomproduit='$nomproduit',quantite='$quantite', prix ='$prix',montant='$total',idproduit='$n' WHERE idvente = '$this->idvente'";
                        $result = $conn->query($sql); 
                        if ($result == true) {
                        }
                    } else {
                        $n = $row["idproduit"];
                        $q = $row["quantite"];
                        $v = $this->UgradeProduitFacture($n,$q);
                        $sql = "UPDATE facture SET nomproduit='$nomproduit',quantite='$quantite', prix ='$prix',montant='$total' WHERE idvente = '$this->idvente'";
                        $result = $conn->query($sql); 
                        if ($result == true) {
                        }
                    } 
                }
            }
            
        }

        $reponse = [
            "success" => true,
            "message" => $this->idvente
        ];
       return $reponse;
    }

    public function HistoriqueVente($datedebut, $datefin,$nomProduit){
        global $conn;
        $data =[];
        $sql = "SELECT c.firstname ,f.nomproduit,f.quantite,f.datefacture, v.datevente
        FROM facture f 
        LEFT JOIN client c ON c.id = f.idclient
        INNER JOIN vente v ON v.id = f.idvente
        WHERE (MONTH(f.datefacture) BETWEEN MONTH($datedebut) AND MONTH($datefin)) OR f.nomproduit='$nomProduit'";
        $result = $conn->query($sql);
       while($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
       }

       $sql = "SELECT ROUND(SUM(f.quantite),2) AS quantite_total
        FROM facture f 
        WHERE (MONTH(f.datefacture) BETWEEN MONTH($datedebut) AND MONTH($datefin)) OR f.nomproduit='$nomProduit'";
        $result = $conn->query($sql);
       $row = mysqli_fetch_assoc($result);

            array_push($data,["TOTAL",$nomProduit,$row["quantite_total"],$datedebut."au".$datefin,$datedebut."au".$datefin]);
    
        return $data; 
    }
}
?>