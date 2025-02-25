<?php 
    require_once("connexion.php");

class BonCommande
{
  public function __construct()
  {
    
  } 
  
  public function getBonDate($date)
  {
    global $conn;
        $data = [];
        $sql = "SELECT * FROM boncommande WHERE datecommade= '$date'";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
       return $data ;
  }
}

?>