<?php 
//session_start();
require_once("../connexion.php");

Class Service{
    public function __construct()
    {
        
    }

    public function sommeService($anne) {
        global $conn;
        if ($anne == "") {
            $anne = date("Y");
        }
        $sql = "SELECT ROUND(SUM(Montant),2) as montant FROM terrain WHERE YEAR(datejour)= '$anne'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row["montant"]; 
    }

    public function sommeServiceAnne($anne) {
        global $conn;
        if ($anne == "") {
            $anne = date("Y");
        }
        $anne = $anne - 1; // Pour l'année précédente
        $sql = "SELECT ROUND(SUM(Montant),2) as montant FROM terrain WHERE YEAR(datejour)= '$anne'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        if (empty($row["montant"])) {
            $row["montant"] = 0;
        }
        return $row["montant"]; 
    }
}

?>