<?php
require_once("../connexion.php");
require_once("../bdmutilple/getuser.php");

$user = new User();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../assets/img/ico/favicon.png">
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
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="card-header py-3">
                                <h1 class="m-0 font-weight-bold text-primary">Creation de compte!</h1>
                            </div><br>
                            <form class="user" action="register.php" method="post">
                                <input type="number" class="form-control form-control-user drop" id="iduser"
                                name="iduser" value="0" required>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="FirstName"
                                           name="FirstName" placeholder="First Name" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" id="LastName" 
                                           name="LastName" placeholder="Prenom" required>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user" id="email"
                                           name="email" placeholder="email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="tel" class="form-control form-control-user" id="telephone"
                                            name="telephone" placeholder="Entre le telephone" required>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="speculation"
                                            name="speculation" placeholder="Speculation" required>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" id="ancienete"
                                            name="ancienete" placeholder="ancienete (en nombre anne)" required>
                                    </div>
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
                                
                                <button type="submit" name="create" id="create" class="btn btn-primary btn-user btn-block">
                                    Enregistrer
                                </button>
                                <hr>
                                
                            </form>
                            <hr>
                            
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
   
</body>

</html>