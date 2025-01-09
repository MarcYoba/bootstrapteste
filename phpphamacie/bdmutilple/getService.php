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
    }

?>