<?php
require_once("../connexion.php");
require_once("../bdmutilple/getuser.php");

$user = new User();

if (isset($_GET["id"])) {
    if (!empty($_GET["id"])) {
        $tableau = ($user->getUserId($_GET["id"]));
        echo '<p id="test" class="drop">1</p>';
        echo '<p id="ftname" class="drop">'.$tableau["firstname"].'</p>';
        echo '<p id="ltname" class="drop">'.$tableau["lastname"].'</p>';
        echo '<p id="email" class="drop">'.$tableau["email"].'</p>';
        echo '<p id="id" class="drop">'.$tableau["id"].'</p>';
        echo '<p id="rol" class="drop">'.$tableau["roles"].'</p>';
        
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gestion de Stock</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="../../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .drop{
            display: none;
        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Creation de compte!</h1>
                            </div>
                            <form class="user" action="register.php" method="post">
                                <input type="number" class="form-control form-control-user drop" id="iduser"
                                name="iduser" value="0" required>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="FirstName"
                                           name="FirstName" placeholder="First Name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="LastName" 
                                           name="LastName" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="InputEmail"
                                       name="InputEmail" placeholder="Email Address" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                           name="InputPassword" id="InputPassword" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                           name="RepeatPassword" id="RepeatPassword" placeholder="Repeat Password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-select" id="roleuser" name="roleuser" required>
                                        <option selected>role utilisateur</option>
                                        <option value="client">clients</option>
                                        <option value="Lecture">lecture</option>
                                        <option value="Ecriture">Lecture ecriture</option>
                                        <option value="semiadmin">Lecture ecriture Modification</option>
                                        <option value="administrateur">Tous les droits</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-user btn-block">
                                    Enregistrer
                                </button>
                                <hr>
                                <a href="index.php" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.php" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./../js/sb-admin-2.min.js"></script>
    <script>
        document.getElementById("FirstName").value = document.getElementById("ftname").textContent;
        document.getElementById("LastName").value = document.getElementById("ltname").textContent;
        document.getElementById("InputEmail").value = document.getElementById("email").textContent;
        document.getElementById("rol").value = document.getElementById("rol").textContent;
        document.getElementById("iduser").value = document.getElementById("id").textContent;
    </script>
</body>

</html>