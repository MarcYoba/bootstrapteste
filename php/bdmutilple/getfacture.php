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
                return "caise ok";
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
                        return "edite dette ok";
                    } else {
                        return "edite dette lost";
                    }
                    
                } else {
                    $quantite = $ligneTotal["Qttotal"];
                    $sql = "UPDATE dette SET quantite='$quantite', montant ='$this->credit',status='OK' WHERE idvente = '$this->idvente'";
                    $result = $conn->query($sql);
                    if ($result == TRUE) {
                        return "efface dette ok";
                    } else {
                        return "efface dette lost";
                    }
                }  
                
            }
        }
          
    }
}
?>