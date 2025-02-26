<?php 
 session_start();
 require_once("../connexion.php");

 class Personnel{

   public function __construct()
   {
     
   }

   public function getAllByIdPersonnel($id){
     global $conn;
     $sql = "SELECT * FROM personnel WHERE id = $id";
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();
     return $row;
   }

    public function UpdatePersonnel($data){
      global $conn;
      $sql = "UPDATE personnel SET nom = '".$data['nom']."', telephone = '".$data['telephone']."', compteBanque = '".$data['banque']."', datecreation = '".$data['date']."' WHERE id = ".$data['id'];
      $result = $conn->query($sql);
      return $result;
    }

    public function DeletePersonnel($id){
      global $conn;
      $sql = "DELETE FROM personnel WHERE id = $id";
      $result = $conn->query($sql);
      return $result;
    }

    public function getAllPersonnel(){
      global $conn;
      $sql = "SELECT * FROM personnel";
      $result = $conn->query($sql);
      $rows = array();
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }

    public function getAllSalaires(){
      global $conn;
      $sql = "SELECT * FROM salaire";
      $result = $conn->query($sql);
      $rows = array();
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
      return $rows;
    }
    public function UpdateSalaire($data){
        global $conn;
        $iduser = $_SESSION['id'];
        $sql = "UPDATE salaire SET inuser = '".$data['utilisateur']."', montant = '".$data['montant']."', usersave = '".$iduser."', datepaiement = '".$data['date']."' WHERE id = ".$data['id'];
        $result = $conn->query($sql);
        return $result;
    }

    public function DeleteSalaire($id){
        global $conn;
        $sql = "DELETE FROM salaire WHERE id = $id";
        $result = $conn->query($sql);
        return $result;
    }

    public function getAllByIdSalaire($id){
        global $conn;
        $sql = "SELECT * FROM salaire WHERE id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
      }

 }
?>