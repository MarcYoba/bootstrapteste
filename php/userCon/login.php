
<?php
session_start();
require_once("../connexion.php");

// Validate login credentials

/*

AND password = '$password'
*/
if (isset($_POST['emailcon']) && isset($_POST['Passwordcon'])) {
    $username = $_POST['emailcon'];
    $password = $_POST['Passwordcon'];
    

    $sql = "SELECT * FROM user WHERE email = '$username'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        
        $sql = "SELECT id,password FROM user WHERE email = '$username'";
        $result = $conn->query($sql);
       
        if ($result === false) {
            echo "Error executing query: " . mysqli_error($conn);
            exit;
        }else{
            $row = mysqli_fetch_assoc($result);
                
                if (password_verify($password , $row["password"])) {
                    
                    // Login successful
                    $_SESSION['name'] = $username;
                    $_SESSION['id'] = $row["id"];

                    //echo $_SESSION["id"];
                    header("Location: ../../home.php");
                    exit();
                }else{
                    header("Location: ../../404.html");
                    exit();
                     
                }     
        }
        
    } else {
        // Login failed
        header("Location: ../../404.html");
        exit();
    }
}
else{
    echo 'variable non de fiini'; 
}

// Close database connection
$conn->close();
?>