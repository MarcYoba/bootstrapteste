<?php 
    require_once("../connexion.php");

    class Service{
        public function __construct(){

        }
        public function getElement($idelement){
            global $conn;
            $sql = "SELECT * FROM terrain WHERE id='$idelement'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);

            return $row;
        }
        public function sommeService() {
            global $conn;
            $sql = "SELECT ROUND(SUM(Montant),2) as montant FROM terrain WHERE YEAR(datejour)= YEAR(CURRENT_DATE)";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            return $row["montant"]; 
        }
    
        public function sommeServiceAnne($anne) {
            global $conn;
            $sql = "SELECT ROUND(SUM(Montant),2) as montant FROM terrain WHERE YEAR(datejour)= '$anne'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);
            if (empty($row["montant"])) {
                $row["montant"] = 0;
            }
            return $row["montant"]; 
        }
        public function sommeServiceAnnepasse($anne) {
            global $conn;
            if ($anne == null) {
                $anne = date("Y");
            }
            $anne = $anne - 1;
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