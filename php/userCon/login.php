
<?php
session_start();
$_SESSION['last_activity'] = time();
$_SESSION['id']= 0;
require_once("../connexion.php");
// ini_set('session.gc_maxlifetime', 1800);
// ini_set('session.cookie_lifetime', 1800);

// // Ou bien, en utilisant session_set_cookie_params()
// session_set_cookie_params(1800);

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
        
        $sql = "SELECT id,password,roles,zonetravail,cathegorie,datecreate,firstname,idclient FROM user WHERE email = '$username'";
        $result = $conn->query($sql);
       
        if ($result === false) {
            echo "Error executing query: " . mysqli_error($conn);
            exit;
        }else{
            $row = mysqli_fetch_assoc($result);
                
                if (password_verify($password , $row["password"])) {
                    
                    // Login successful
                    $_SESSION['username'] = $row["firstname"];
                    $_SESSION['name'] = $username;
                    $_SESSION['id'] = $row["id"];
                    $_SESSION['roles'] = $row["roles"];
                    $_SESSION['zonetravail'] = $row["zonetravail"];
                    $_SESSION['cathegorie'] = $row["cathegorie"];
                    $_SESSION['datecreate'] = $row["datecreate"];
                    $_SESSION['updated_at'] = $row["updated_at"];
                    $_SESSION['last_activity'] = time();

                    if (isset($_SESSION['id']) && isset($_SESSION['roles'])) {
                        if ($row["roles"] == "client") {
                            $_SESSION['id'] = $row["idclient"];
                        }
                        header("Location: ../../home.php"); 
                        exit();
                    } else {
                        header("Location: ../../index.php"); 
                        exit();
                    }
                    
                    
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