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

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Rapport</h1>
                             </div>
                            
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                <div class="form-group row">
                                    <div class="col-sm-10 ">
                                    <h6 class="m-0 font-weight-bold text-primary">Impression des rapports</h6>
                                    </div>
                                    <div class="col-sm-2 ">
                                    <a class="m-0 font-weight-bold text-warning" href="../../home.php">Retour</a>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group row">
                                    <br>
                                    <div class="col-sm-8 mb-3 mb-sm-0">
                                        
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <a href="../pdf/getPdftoday.php">
                                            <button type="" name="" id="" class="btn btn-primary btn-user btn-block">
                                            Rapport du jour
                                            </button> 
                                        </a>
                                    </div>
                                </div>
                                
                                <hr>
                                <form class="user" action="../pdf/getRapportDay.php" method="post">
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="date" class="form-control form-control-user" id="date"
                                            name="date" placeholder="telephone client" required>
                                        </div>
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                        <a href="../pdf/getPdftoday.php">
                                                <button type="" name="" id="" class="btn btn-primary btn-user btn-block">
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
                                                name="datedebutsemain" placeholder="telephone client" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="date" class="form-control form-control-user" id="date"
                                                name="datefinsemain" placeholder="telephone client" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="../pdf/getRapportSemaine.php">
                                                <button type="" name="" id="" class="btn btn-primary btn-user btn-block">
                                                    Rapport part semain / MOI
                                                </button> 
                                            </a>
                                        </div>
                                    </div>
                                        <hr>
                                        <hr>
                                </form>

                            <form action="../pdf/getannuel.php" method="post">
                            <div class="form-group row">
                                    <div class="col-sm-3">
                                       <input type="number" class="form-control form-control-user" id="mois"
                                        name="mois" placeholder="numero du moi" required>
                                    </div>
                                    <div class="col-sm-3">
                                       <input type="date" class="form-control form-control-user" id="date"
                                        name="date" placeholder="Date">
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-4">
                                            <button type="" name="" id="" class="btn btn-primary btn-user btn-block">
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
                                        name="anne" placeholder="Entrez l'année " required>
                                    </div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                            <button type="" name="" id="" class="btn btn-primary btn-user btn-block">
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
                                        name="anne" placeholder="Entrez l'année " required>
                                    </div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                            <button type="" name="" id="" class="btn btn-primary btn-user btn-block">
                                            Rapport Annuel
                                            </button> 
                                    </div>
                                </div>
                                <hr>
                                <hr>
                            </form>
                            <form action="../pdf/rapportclient.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        semestre
                                        <select class="form-control form-control-user" id="semestre" name="semestre">
                                            <option value="">ALL</option>
                                            <option value="1">1er Semestre</option>
                                            <option value="2">2ème Semestre</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        
                                        <select class="form-control form-control-user" id="speculation" name="speculation">
                                            <option value="">ALL</option>
                                            <option value="CHAIRE">CHAIRE</option>
                                            <option value="PONDEUSE">PONDEUSE</option>
                                            <option value="PORC">PORC</option>
                                            <option value="LAPIN">LAPIN</option>
                                            <option value="AUTRE">AUTRE</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        année
                                        <input type="number" class="form-control form-control-user" id="anne" name="anne" required
                                            placeholder="Entrez l'année ">
                                    </div>
                                    
                                    <div class="col-sm-4">
                                            <button type="" name="" id="" class="btn btn-primary btn-user btn-block">
                                            Rapport Dette client
                                            </button> 
                                    </div>
                                </div>
                                <hr>
                                <hr>
                            </form>
                            <form action="../pdf/rapportspeculation.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        semestre
                                        <select class="form-control form-control-user" id="semestre" name="semestre">
                                            <option value="ALL">ALL</option>
                                            <option value="1">1er Semestre</option>
                                            <option value="2">2ème Semestre</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        spéculation
                                        <select class="form-control form-control-user" id="speculation" name="speculation">
                                            <option value="ALL">ALL</option>
                                            <option value="CHAIRE">CHAIRE</option>
                                            <option value="PONDEUSE">PONDEUSE</option>
                                            <option value="PORC">PORC</option>
                                            <option value="LAPIN">LAPIN</option>
                                            <option value="AUTRE">AUTRE</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        année
                                        <input type="number" class="form-control form-control-user" id="anne" name="anne" required
                                            placeholder="Entrez l'année ">
                                    </div>
                                    
                                    <div class="col-sm-4">
                                            <button type="" name="" id="" class="btn btn-primary btn-user btn-block">
                                            Rapport spéculation Client
                                            </button> 
                                    </div>
                                </div>
                                <hr>
                                <hr>
                            </form>
                            <form action="../pdf/depense.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        semestre
                                        <select class="form-control form-control-user" id="semestre" name="semestre">
                                            <option value="">ALL</option>
                                            <option value="1">1er Semestre</option>
                                            <option value="2">2ème Semestre</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        Post
                                        <select class="form-control form-control-user" id="speculation" name="speculation">
                                            <option value="">ALL</option>
                                            <option value="Autres achats"> Autres achats ( Tami, marteau, ralonge, etc.)</option>
                                            <option value="service exterieur"> charges générales ( Loyer, eau, electricite, etc.)</option>
                                            <option value="impots et taxes">  impôts et taxes </option>
                                            <option value="charge personnel">  charges de personnel(Salaires)  </option>
                                            <option value="autre charge"> (Heures supplémentaires, primes,Motivation,Miting etc.) </option>
                                            <option value="Voyages">  Voyages et déplacements, deplacement pour versement,seminaire, autre depense </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        année
                                        <input type="number" class="form-control form-control-user" id="anne" name="anne" required
                                            placeholder="Entrez l'année ">
                                    </div>
                                    
                                    <div class="col-sm-4">
                                            <button type="" name="" id="" class="btn btn-success btn-user btn-block">
                                            Depense part post
                                            </button> 
                                    </div>
                                </div>
                                <hr>
                                <hr>
                            </form>
                            </div>
                            
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
    <script src="../../js/sb-admin-2.min.js"></script>

</body>

</html>