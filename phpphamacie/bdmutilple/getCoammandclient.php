<?php
require_once("../connexion.php");

class CommandClient{
    public function __construct()
    {
        
    }

    public function ValiderCommande($id){
        global $conn;
        
        $sql = "UPDATE commadeclientc SET statuscommande='valide' WHERE id = '$id'";
        $result = $conn->query($sql); 
        if ($result === True) {
            return "OK";
        }else {
            return "ECHEC";
        }
    }
    public function AnnulCommande($id){
        global $conn;
        
        $sql = "UPDATE commadeclientc SET statuscommande='annuler' WHERE id = '$id'";
        $result = $conn->query($sql); 
        if ($result === True) {
            return "OK";
        }else {
            return "ECHEC";
        }
    }

    public function VerifieCommande(){
        global $conn;
        
        $sql = "SELECT * FROM commadeclientc WHERE statuscommande='en coure'";
        $result = $conn->query($sql); 

        if ( $result->num_rows>0) {
            return "success";
        }else {
            return "false";
        }
    }
}

?>