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

</head>

<body class="bg-gradient-success">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            
                                <div class="form-group row">
                                        <div class="col-sm-10 ">
                                        <h6 class="m-0 font-weight-bold text-success">Rapport</h6>
                                        </div>
                                        <div class="col-sm-2 ">
                                        <a class="m-0 font-weight-bold text-success" href="../../homepahamacie.php">Retour</a>
                                        </div>
                                </div>
                            
                           
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        
                                    </div>
                                    <div class="col-sm-4 ">
                                        <a href="../pdf/getPdftoday.php">
                                            <button type="" name="" id="" class="btn btn-success btn-user btn-block">
                                            Rapport du jour
                                            </button> 
                                        </a>
                                    </div>
                                    
                                </div>
                                
                                <hr>
                            <form class="user" action="../pdf/getRapportDay.php" method="post">
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control form-control-user" id="date"
                                        name="date" placeholder="telephone client">
                                    </div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                    <a href="../pdf/getPdftoday.php">
                                            <button type="" name="" id="" class="btn btn-success btn-user btn-block">
                                            Rapport pour chaque Date
                                            </button> 
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                <hr>  
                            </form>
                            <form class="user" action="../pdf/getRapportSemaine.php" method="post">
                            <div class="form-group row">
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control form-control-user" id="date"
                                        name="datedebutsemain" placeholder="telephone client" >
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control form-control-user" id="date"
                                        name="datefinsemain" placeholder="telephone client" >
                                    </div>
                                    <div class="col-sm-4">
                                    <a href="../pdf/getRapportSemaine.php">
                                            <button type="" name="" id="" class="btn btn-success btn-user btn-block">
                                            Rapport part semain / MOI
                                            </button> 
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                            </form>
                            <hr>

                            <form action="../pdf/getannuel.php" method="post">
                            <div class="form-group row">
                                    <div class="col-sm-3">
                                       <input type="number" class="form-control form-control-user" id="mois"
                                        name="mois" placeholder="numero du moi" require>
                                    </div>
                                    <div class="col-sm-3">
                                       <input type="date" class="form-control form-control-user" id="date"
                                        name="date" placeholder="numero du moi">
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-4">
                                            <button type="" name="" id="" class="btn btn-success btn-user btn-block">
                                            Rapport Mensuelle
                                            </button> 
                                    </div>
                                </div>
                                <hr>
                                <hr>

                            </form>

                            <form class="user" action="../pdf/getsemestre.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control form-control-user" id="anne"
                                        name="anne" placeholder="numéro de l'année" required>
                                    </div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                            <button type="" name="" id="" class="btn btn-success btn-user btn-block">
                                            rapport Trimestriele et Semestrielle 
                                            </button> 
                                    </div>
                                </div>
                                <hr>
                                <hr>
                            </form>
                            <form action="../pdf/getanne.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control form-control-user" id="anne"
                                            name="anne" placeholder="numero du moi" required>
                                    </div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                            <button type="" name="" id="" class="btn btn-success btn-user btn-block">
                                            Rapport Annuel
                                            </button> 
                                    </div>
                                </div>
                                <hr>
                                <hr>
                            </form>
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

</body>

</html>