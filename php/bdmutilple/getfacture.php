<?php

require_once("../connexion.php"); 


class Facture{
    public $idfacture;
    public $TypePaie;
    public $om;
    public $credit;
    public $cash;
    

    public function __construct($idfacture)
    {
        $this->idfacture = $idfacture;
        $this->TypePaie ="";
        $this->om =0;
        $this->credit =0;
        $this->cash =0;
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

    public function EditFacture($value){
        global $conn;
        $ligenid = array_pop($value);
        $this->idfacture = $ligenid["idvente"];
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
            }
        }else{
            $this->TypePaie = "OM";
            $this->om =$ligneTotal["momo"];
        }

        $sql = "UPDATE vente SET typevente=?, quantite=?, prix='',cash=?, credit=?, Om=?, reduction=? WHERE idvente=? ";
            $stmt = mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($stmt,"siiiiiii",$this->TypePaie,$ligneTotal["Qttotal"],$ligneTotal["total"],$ligneTotal["cash"],$ligneTotal["credit"],$ligneTotal["momo"],$ligneTotal["reduction"],$this->idfacture);
        if(mysqli_stmt_execute($stmt)){
            foreach ($value as $key ) {
                $sql = "UPDATE facture SET nomproduit=?, quantite=?, prix='',montant=?, Typepaiement=? WHERE idvente=? ";
                 $stmt = mysqli_prepare($conn,$sql);
                 mysqli_stmt_bind_param($stmt,"siiisi",$key["nomproduit"],$key["quantite"],$key["prix"],$key["montant"],$this->TypePaie,$this->idfacture);
                 mysqli_stmt_execute($stmt);
            }
            
        }else{

        }   
        
    }
}
?>