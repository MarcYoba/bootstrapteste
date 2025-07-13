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

        public function getConsultation() {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM consultation WHERE dateArrive = CURRENT_DATE";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }

        public function getConsultationDate($date) {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM consultation WHERE dateArrive = '$date'";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }

        public function getConsultationSemain($datedebut,$datefin) {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM consultation WHERE dateArrive BETWEEN '$datedebut' AND '$datefin'";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }
        public function getConsultationMonth($mois,$date) {
            global $conn;
            $data = [];
            $sql = "SELECT dateArrive, 
            ROUND(SUM(montant)) AS nomtant,
            ROUND(COUNT(*)) AS netpayer
            FROM consultation
            WHERE Month(dateArrive) = '$mois' AND YEAR(dateArrive) = YEAR('$date')
            ";
            $result = $conn->query($sql);
            while($row = mysqli_fetch_assoc($result)){
                $row["dateArrive"] = "TOTAL";
                array_push($data,$row);
            }
            return $data;
        }
        public function getsuivianimale() {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM suivianimale WHERE datejour =CURRENT_DATE";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }

        public function getsuivianimaleDate($date) {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM suivianimale WHERE datejour ='$date'";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }

        public function getsuivianimaleSemaine($datedebut,$datefin) {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM suivianimale WHERE datejour BETWEEN '$datedebut' AND '$datefin'";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }

        public function getsuivianimaleMonth($mois,$date) {
            global $conn;
            $data = [];
            $sql = "SELECT datejour, 
            ROUND(SUM(montant)) AS nomtant
            FROM suivianimale
            WHERE Month(datejour) = '$mois' AND YEAR(datejour) = YEAR('$date')
            ";
            $result = $conn->query($sql);
            while($row = mysqli_fetch_assoc($result)){
                $row["datejour"] = "TOTAL";
                $row["montant"] = $row["nomtant"];
                array_push($data,$row);
            }
            return $data;
        }

        public function getVaccination() {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM animale WHERE datevacin =CURRENT_DATE";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }

        public function getVaccinationDate($date) {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM animale WHERE datevacin ='$date'";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }

        public function getVaccinationSemain($datedebut,$datefin) {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM animale WHERE datevacin BETWEEN '$datedebut' AND '$datefin'";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }

        public function getVaccinationMonth($mois,$date) {
            global $conn;
            $data = [];

            $sql = "SELECT datevacin, 
            ROUND(SUM(montant)) AS nomtant,
            ROUND(SUM(netpayer)) AS netpayer
            FROM animale
            WHERE Month(datevacin) = '$mois' AND YEAR(datevacin) = YEAR('$date')
            ";
            $result = $conn->query($sql);
            while($row = mysqli_fetch_assoc($result)){
                $row["datevacin"] = "TOTAL";
                $row["netpayer"] = $row["netpayer"];
                array_push($data,$row);
            }
            return $data;
        }

        public function getTerrain() {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM terrain WHERE datejour =CURRENT_DATE";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }

        public function getTerrainDate($date) {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM terrain WHERE datejour ='$date'";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }

        public function getTerrainSemain($datedebut,$datefin) {
            global $conn;
            $data = [];
            $sql = "SELECT * FROM terrain WHERE datejour BETWEEN '$datedebut' AND '$datefin'";
            $result = $conn->query($sql);

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($data,$row);
            }
            return $data;
        }
        public function getTerrainMonth($mois,$date) {
            global $conn;
            $data = [];
            $sql = "SELECT COUNT(datejour) AS total,
            ROUND(SUM(montant)) AS nomtant
            FROM terrain
            WHERE Month(datejour) = '$mois' AND YEAR(datejour) = YEAR('$date')
            ";
            $result = $conn->query($sql);
            while($row = mysqli_fetch_assoc($result)){
                array_push($data,$row);
            }
            return $data;
        }
        public function ConsultationSemesttre($anne)
        {
            global $conn;
            $data =[];
            $sql = "SELECT 
            CEILING(MONTH(dateArrive) / 6) AS semestre,
            ROUND(SUM(montant),2) AS montant
            FROM 
                consultation
            WHERE YEAR(dateArrive) = $anne
            GROUP BY 
                semestre";

            $result = $conn->query($sql);
            while ($row = mysqli_fetch_assoc($result)){
                array_push($data,$row);
            }
            return $data; 
        }
        public function QuantiteConsultationSemesttre($anne)
        {
            global $conn;
            $data =[];
            $sql = "SELECT 
            CEILING(MONTH(dateArrive) / 6) AS semestre,
            COUNT(montant) AS montant
            FROM 
                consultation
            WHERE YEAR(dateArrive) = $anne
            GROUP BY 
                semestre";

            $result = $conn->query($sql);
            while ($row = mysqli_fetch_assoc($result)){
                array_push($data,$row);
            }
            return $data; 
        }
        public function VaccinSemesttre($anne)
        {
            global $conn;
            $data =[];
            $sql = "SELECT 
            CEILING(MONTH(datevacin) / 6) AS semestre,
            ROUND(SUM(montant),2) AS montant
            FROM 
                animale
            WHERE YEAR(datevacin) = $anne
            GROUP BY 
                semestre";

            $result = $conn->query($sql);
            while ($row = mysqli_fetch_assoc($result)){
                array_push($data,$row);
            }
            return $data; 
        }
        public function QuantiteVaccinSemesttre($anne)
        {
            global $conn;
            $data =[];
            $sql = "SELECT 
            CEILING(MONTH(datevacin) / 6) AS semestre,
            COUNT(montant) AS montant
            FROM 
                animale
            WHERE YEAR(datevacin) = $anne
            GROUP BY 
                semestre";

            $result = $conn->query($sql);
            while ($row = mysqli_fetch_assoc($result)){
                array_push($data,$row);
            }
            return $data; 
        }
    }
?>