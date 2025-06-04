<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GESTION DE STOCK</title>

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
                            <div class="form-group row">
                                            <div class="col-sm-6">
                                            <h6 class="m-0 font-weight-bold text-primary">Création du Compte client</h6>
                                            </div>
                                            <div class="col-sm-2">
                                                <i class="fa fa-home"></i>
                                                <a href="../../home.php" class="btn btn-primary">Home</a> 
                                            </div>
                                            <div class="col-sm-2">
                                                <i class="fa fa-list"></i> 
                                                <a href="liste.php" class="btn btn-success"> Liste</a>
                                                
                                            </div>
                                            <!--<div class="btn btn-warning"><i class="fa fa-arrow-left"></i> Retour</div>  -->  
                                        </div>
                                <span id="idclient" class="drop"></span>
                            </div>
                            <form class="user" action="register.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="FirstName"
                                           name="FirstName" placeholder=" Nom">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="LastName" 
                                           name="LastName" placeholder="adresse" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="InputEmail"
                                       name="InputEmail" placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                           name="InputPassword" id="InputPassword" placeholder="Password" >
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                           name="RepeatPassword" id="RepeatPassword" placeholder="Repeat Password" >
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="tel" class="form-control form-control-user" id="Inputphone"
                                        name="Inputphone" placeholder="téléphone client" >
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="sexe"  name="sexe"  class="form-control form-select" >
                                            <option ></option>
                                           <option id="femme">femme</option> 
                                           <option id="homme">homme</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p>
                                        <h6>Pour enregistrer une liste des clients, vous devez télécharger le template suivant.<br>
                                            1. Enregistrez les informations comme les colonnes l'indiquent.<br>
                                            2. Enregistrez le template sous un nom court sans espace en cas de modification.<br>
                                            3. Importez le modèle dans l'application.<br>
                                            4. Enfin, cliquez sur enregistrer.<br>
                                        </h6>                                        
                                            <button type="template" name="template" id="template" class="btn btn-info btn-user btn-block">
                                                Telecharger le Template
                                            </button>
                                    </p>
                                    <input type="file" class="form-control form-control-user" id="file_excel"
                                       name="file_excel" >
                                </div>
                                <span id="enregistrement">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-user btn-block">
                                    Enregistrer
                                </button>
                                </span>
                            </form>
                            <hr>
                            <!--
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.html">Already have an account? Login!</a>
                            </div> 
-->
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
    <script src="../../js/sb-admin-2.min.js"></script>
    <script src="client.js"></script>
</body>

</html>