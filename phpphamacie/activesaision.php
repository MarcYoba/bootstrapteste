<?php

if ((!isset($_SESSION['id'])) && (!isset($_SESSION['roles']))) {
    header("Location: ../../index.php"); 
    $_SESSION['roles'] = "temp";
    $_SESSION['id']= 0;
    exit();
} 

if (!isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time();
    header("Location: ../../index.php"); 
    exit();
}
$time_elapsed = time() - $_SESSION['last_activity'];
    
    if ($time_elapsed > 7200) {
        session_unset();
        session_destroy();
        header("Location: ../../index.php");  
        exit();
    }

?>