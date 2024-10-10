<?php

class User{

    public function getUser($email){
        global $conn;
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            return true;
        } else {
            return false;
        }
        
    }

    public function getUserId($id){
        global $conn;
        $sql = "SELECT * FROM user WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows>0) {
            return mysqli_fetch_assoc($result);
        } else {
            return false;
        }
        
    }

    public function UpdatePassWord($email,$password){
        global $conn;
        $hash= password_hash($password, PASSWORD_DEFAULT, [
            'cost' => 12, // Ajuster le coût selon vos besoins
        ]);
        $sql = "UPDATE user SET password ='$hash' WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result ==true) {
            return true;
        } else {
            return false;
        }  
    }

    public function UpdateUser($nom,$prenom,$email,$password,$role,$id){
        global $conn;
        $hash= password_hash($password, PASSWORD_DEFAULT, [
            'cost' => 12, // Ajuster le coût selon vos besoins
        ]);
        $sql = "UPDATE user SET email='$email',roles='$role',password ='$hash',firstname='$nom',lastname='$prenom' WHERE id = '$id'";
        $result = $conn->query($sql);
        if ($result ==true) {
            return true;
        } else {
            return false;
        }  
    }
}