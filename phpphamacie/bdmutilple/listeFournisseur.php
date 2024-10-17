<?php 
require_once("../connexion.php"); 

global $conn;
$sql = "SELECT * FROM fournisseurphamacie ";
$result = $conn->query($sql);
    while ($row = mysqli_fetch_assoc($result)){
        echo '<tr>';
        echo '<td>'.$row["id"].'</td>';
        echo '<td>'.$row["nom"].'</td>';
        echo '<td>'.$row["adresse"].'</td>';
        echo '<td>'.$row["telephone"].'</td>';
        echo '<td>'.$row["email"].'</td>';
        echo '<td>'.$row["datecreation"].'</td>';
        echo '<td>'.$row["numerofacature"].'</td>';
        echo '<td>'.$row["dateachat"].'</td>';
        
        $id = $row["id"];
        $sql = "SELECT SUM(idfourniseur) as somme FROM livraison WHERE id='$id'";
        $resulta = $conn->query($sql);
        $rowsome = mysqli_fetch_assoc($resulta);
        
        echo '<td>'.($rowsome["somme"]/$id).'</td>';
        echo '</tr>';
        //var_dump($row);
    }


$conn->close();
?>