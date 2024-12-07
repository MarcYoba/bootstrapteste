<?php 
    require_once("../connexion.php");

    class Vaccin{
        public function __construct()
        {
            
        }

        public function getVacin($id){
            global $conn;
            $sql = "SELECT * FROM animale WHERE id='$id'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);

            return $row;
        }

        public function SupprimerVaccin($id) {
            global $conn;
            $sql = "SELECT * FROM animale WHERE id = $id";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            
                $sql = "DELETE  FROM animale WHERE id = $id";
                if($conn->query($sql) === TRUE){
                   return 1;
                }else{
                    return 2;
                }
            } else {
                return 3;
            }
        }
    }
?>