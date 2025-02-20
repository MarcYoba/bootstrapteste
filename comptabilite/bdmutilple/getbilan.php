<?php
require_once("connexion.php");

class Bilan{

    public function __construct()
    {
        
    }

    public function GetActif($annee){

        global $conn;
        $data =[];
        
        $sql = "SELECT id,libelle ,SUM(brut)as brut, SUM(amortisement) as amortisement, SUM(net) as net FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='Incorporelles'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale imobilisatiion Incorporelles";
            array_push($data,$row);
        }

        $sql = "SELECT * FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='Incorporelles' ORDER BY id";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT id,libelle ,SUM(brut)as brut, SUM(amortisement) as amortisement, SUM(net) as net FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='corporelles'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale imobilisatiion corporelles";
            array_push($data,$row);
        }

        $sql = "SELECT * FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='corporelles'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT id,libelle ,SUM(brut)as brut, SUM(amortisement) as amortisement, SUM(net) as net FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='financieres'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale financieres";
            array_push($data,$row);
        }

        $sql = "SELECT * FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='financieres'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT id,libelle ,SUM(brut)as brut, SUM(amortisement) as amortisement, SUM(net) as net FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='circulant'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale Actif circulant";
            array_push($data,$row);
        }
        $sql = "SELECT * FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='circulant'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT id,libelle ,SUM(brut)as brut, SUM(amortisement) as amortisement, SUM(net) as net FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='trsorerieactif'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale trsorerie actif";
            array_push($data,$row);
        }
        $sql = "SELECT * FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='trsorerieactif'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT id,libelle ,SUM(brut)as brut, SUM(amortisement) as amortisement, SUM(net) as net FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='differentiels'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale differentiels";
            array_push($data,$row);
        }
        $sql = "SELECT * FROM actif WHERE YEAR(datebilan)= '$annee' AND cathegorie='differentiels'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT id,libelle ,SUM(brut)as brut, SUM(amortisement) as amortisement, SUM(net) as net FROM actif WHERE YEAR(datebilan)= '$annee'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale GENERALE";
            array_push($data,$row);
        }
        return $data; 
    }

    public function GetPassif($annee){

        global $conn;
        $data =[];
        
        $sql = "SELECT id,libelle ,SUM(montant)as montant FROM passif WHERE YEAR(datepassif)= '$annee' AND cathegorie='Capital'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale CAPITAUX PROPRES ET RESSOURCES ASSIMILEES";
            array_push($data,$row);
        }

        $sql = "SELECT * FROM passif WHERE YEAR(datepassif)= '$annee' AND cathegorie='Capital' ORDER BY id";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT id,libelle ,SUM(montant)as montant FROM passif WHERE YEAR(datepassif)= '$annee' AND cathegorie='DETTES'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale DETTES FINANCIERES ET RESSOURCES ASSIMILEES";
            array_push($data,$row);
        }

        $sql = "SELECT * FROM passif WHERE YEAR(datepassif)= '$annee' AND cathegorie='DETTES'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT id,libelle ,SUM(montant)as montant FROM passif WHERE YEAR(datepassif)= '$annee' AND cathegorie='circulant'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale PASSIF CIRCULANT";
            array_push($data,$row);
        }

        $sql = "SELECT * FROM passif WHERE YEAR(datepassif)= '$annee' AND cathegorie='circulant'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT id,libelle ,SUM(montant)as montant FROM passif WHERE YEAR(datepassif)= '$annee' AND cathegorie='TRESORERIE'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale TRESORERIE-PASSIF";
            array_push($data,$row);
        }
        $sql = "SELECT * FROM passif WHERE YEAR(datepassif)= '$annee' AND cathegorie='TRESORERIE'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT id,libelle ,SUM(montant)as montant FROM passif WHERE YEAR(datepassif)= '$annee' AND cathegorie='differentiels'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale differentiels";
            array_push($data,$row);
        }
        $sql = "SELECT * FROM passif WHERE YEAR(datepassif)= '$annee' AND cathegorie='differentiels'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }

        $sql = "SELECT id,libelle ,SUM(montant)as montant FROM passif WHERE YEAR(datepassif)= '$annee'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $row["libelle"] = "Totale GENERALE";
            array_push($data,$row);
        }
        return $data; 
    }

    public function getElement($id){
        global $conn;
        $sql = "SELECT * FROM actif WHERE id='$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function getElementPassif($id){
        global $conn;
        $sql = "SELECT * FROM passif WHERE id='$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

?>