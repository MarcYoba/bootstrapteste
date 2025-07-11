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
                        <div class="form-group row">
                                <div class="col-sm-6">
                                <h6 class="m-0 font-weight-bold text-primary">Enregistrement des Employés</h6>     
                                </div>
                                <div class="col-sm-2">
                                <i class="fa fa-home"></i>
                                    <a href="../../homepahamacie.php" class="btn btn-primary">Home</a> 
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-list"></i> 
                                    <a href="liste.php" class="btn btn-success"> Liste</a>
                                                
                                </div>
                                <!--<div class="btn btn-warning"><i class="fa fa-arrow-left"></i> Retour</div>  -->  
                            </div>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"></h1>
                                <span id="idutilisateur" class="drop"></span>
                            </div>

                            <form class="user" action="register.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                           name="nom" id="nom" placeholder="Entrer le nom du client" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user"
                                           name="telephone" id="telephone" placeholder="Entrer le numero de telephone" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                           name="banque" id="banque" placeholder="Numero compte bancaire" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control form-control-user"
                                           name="date" id="date" placeholder="Date engregistrement cleint" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <span id="idpersonnel"> </span>
                                    </div>
                                </div>
                                <hr>
                                <span id="enregistrement">
                                <button type="submit" name="personnel" id="personnel" class="btn btn-warning btn-user btn-block">
                                    Enregistrer un nouveau employer
                                </button>
                                </span>
                            </form>
                            <hr>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4 text-green">Paiement salaire</h1>
                                <span id="idutilisateur" class="drop"></span>
                            </div>
                            <form class="user" action="register.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                    <select id="utilisateur"  name="utilisateur"  class="form-control form-select" size="5"  multiple aria-label="multiple select " required>
                                        <?php
                                            global $conn;
                                            require_once("../connexion.php");
                                            $sql = "SELECT * FROM personnel ";
                                            $result = $conn->query($sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value='.$row["id"].'>'.$row["nom"].'</option>';
                                            }
                                        ?>
                                    </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="number" class="form-control form-control-user"
                                           name="montant" id="montant" placeholder="Salaire brut" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control form-control-user"
                                           name="date" id="date" placeholder="Date engregistrement cleint" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <span id="idsalaire"> </span>
                                    </div>
                                </div>
                                <hr>
                                <span id="salaireboutton">
                                <button type="submit" name="enregistrement" id="enregistrement" class="btn btn-info btn-user btn-block">
                                    Enregistrer
                                </button>
                                </span>
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
    <script src="../../js/sb-admin-2.min.js"></script>
    <script src="personnel.js"></script>
</body>
</html>