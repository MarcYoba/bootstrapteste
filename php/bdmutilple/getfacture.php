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

    public function getIdClientFacture($id){
        global $conn;
        $sql = "SELECT idclient  FROM facture WHERE idvente= '$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["idclient "]; 
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
        $stmt->bind_param('dsdds', $quantiteRestant,$produit, $idvente, $_SESSION["id"], $date);
        if (!$stmt->execute()) {
            die('Erreur d\'exécution de la requête : ' . $stmt->error);
        }
        $stmt->close();
    }

    public function InsertFacture($nomproduit,$quantite,$prix,$idvente,$idclient,$typepaie,$datevente){
        global $conn;
        $nomproduit = substr_replace($nomproduit,"",strpos($nomproduit,"provenderie"));
    
        $sqlproduit = "SELECT id as id  FROM produit  WHERE nom_produit = '$nomproduit'";
        $resultproduit = $conn->query($sqlproduit);
        $row = mysqli_fetch_assoc($resultproduit);
        $id = $row["id"];


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
        $stmt->bind_param('sdddsddsdd',$nomproduit, $quantite, $prix,$montant,$typepaie, $idclient, $_SESSION["id"], $date,$idvente,$id);

        // Exécuter la requête
        if (!$stmt->execute()) {
            die('Erreur d\'exécution de la requête : ' . $stmt->error);
        }

        // Fermer la requête su
        $stmt->close(); 

        $nomproduit = substr_replace($nomproduit,"",strpos($nomproduit,"provenderie"));
        
        $sqlproduit = "SELECT  quantite_produit as quantite  FROM produit  WHERE nom_produit = '$nomproduit'";
        $resultproduit = $conn->query($sqlproduit);
        $row = mysqli_fetch_assoc($resultproduit);
        $quantitestock = $row["quantite"];
        $quantite = $quantitestock - $quantite;

        

        $sql = "UPDATE produit SET quantite_produit ='$quantite' WHERE nom_produit = '$nomproduit'";
        $result = $conn->query($sql); 
        if ($result === True) {
            produitstock($idvente,$quantite,$nomproduit);
        }
        
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
        
        
        if ($result == true) {

            

             if(($ligneTotal["taille"]-2) >1){
                $sql = "SELECT id  FROM facture WHERE idvente = '$this->idvente'";
                $result = $conn->query($sql);

                if ($result->num_rows<($ligneTotal["taille"]-2)) {
                    $nblignebd = $result->num_rows;
                    $ndligneFac = ($ligneTotal["taille"]-2);

                    while (($row = mysqli_fetch_assoc($result)) && $nblignebd >0) {
                        $id = $row["id"];
                       $line = array_shift($value);
                     
                            $nomproduit = $line["produit"];
                            $quantite = $line["quantite"];
                            $prix = $line["prix"];
                            $total = $line["total"];
            
                            $sql = "UPDATE facture SET nomproduit='$nomproduit',quantite='$quantite', prix ='$prix',montant='$total' WHERE  id='$id'";
                            $resultup = $conn->query($sql); 
                            
                            if ($resultup == true) {      
                            }  
                            $nblignebd--; 
                            $ndligneFac--;
                    }
                    
                    while ($ndligneFac > 0) {
                            $line = array_shift($value);
                            $nomproduit = $line["produit"];
                            $quantite = $line["quantite"];
                            $prix = $line["prix"];
                            $total = $line["total"];

                            $this->InsertFacture($nomproduit,$quantite,$prix,$this->idvente,$this->getIdClientFacture($this->idvente),$this->TypePaie,date("Y-m-d"));
                            $ndligneFac--;
                    }
                    // $reponse = [
                    //     'success' => true,
                    //     'message' =>  $this->idvente
                    //  ];
                    // return "ligne superire";

                } else if($result->num_rows==($ligneTotal["taille"]-2)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row["id"];
                       $line = array_shift($value);
                     
                            $nomproduit = $line["produit"];
                            $quantite = $line["quantite"];
                            $prix = $line["prix"];
                            $total = $line["total"];
            
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
    
                    $sql = "UPDATE facture SET nomproduit='$nomproduit',quantite='$quantite', prix ='$prix',montant='$total' WHERE idvente = '$this->idvente'";
                    $result = $conn->query($sql); 
    
                    if ($result == true) {
                        
                    }
                }
            }
            
        }


        $sql = "SELECT id FROM caisse WHERE idvente = '$this->idvente'";
        $result = $conn->query($sql);

        if ($result->num_rows>0) {
            $Mmontant = $ligneTotal["Total"] - $ligneTotal["credit"];
            $sql = "UPDATE caisse SET operation='$this->TypePaie', montant ='$Mmontant' WHERE idvente = '$this->idvente'";
            $result = $conn->query($sql); 

            if ($result == TRUE) {
                $reponse = [
                    'success' => true,
                    'message' =>  $this->idvente
                 ];
                return $reponse;
            } else {
                return "lost edite";
            }
        } else {
            $sql = "SELECT id FROM dette WHERE idvente = '$this->idvente'";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                $this->credit = $ligneTotal["credit"];
                if ($ligneTotal["credit"] >0 ) {
                    $quantite = $ligneTotal["Qttotal"];
                    $sql = "UPDATE dette SET quantite='$quantite', montant ='$this->credit' WHERE idvente = '$this->idvente'";
                    $result = $conn->query($sql);
                    if ($result == TRUE) {
                        $reponse = [
                            'success' => true,
                            'message' =>  $this->idvente
                         ];
                        return $reponse;
                    } else {
                        return "edite dette lost";
                    }
                    
                } else {
                    $quantite = $ligneTotal["Qttotal"];
                    $sql = "UPDATE dette SET quantite='$quantite', montant ='$this->credit',status='OK' WHERE idvente = '$this->idvente'";
                    $result = $conn->query($sql);
                    if ($result == TRUE) {
                        $reponse = [
                            'success' => true,
                            'message' =>  $this->idvente
                         ];
                        return $reponse;
                    } else {
                        return "efface dette lost";
                    }
                }  
                
            }
        }
          
    }
}
?>