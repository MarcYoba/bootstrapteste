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
        rel="../../stylesheet">

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
                        <div class="form-group row card-header py-3">
                                <div class="col-sm-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Fiche de suivi</h6>     
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-home"></i>
                                    <a href="../../homepahamacie.php" class="btn btn-primary">Home</a> 
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-list"></i> 
                                    <a href="listesuivi.php" class="btn btn-success"> Liste</a>             
                                </div>
                                                <!--<div class="btn btn-warning"><i class="fa fa-arrow-left"></i> Retour</div>  -->  
                            </div> 
                            <form class="user" action="registersuivi.php" method="post">
                                Information sur le sujet
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="Name"
                                           name="Name" placeholder="Nom sujet" required>
                                    </div>
    
                                
                                    
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select id="idclient"  name="idclient"  class="form-control form-select">
                                            <?php 
                                            require_once("../connexion.php");
                                                global $conn;
                                                $sql = "SELECT id, firstname, adresse FROM client";
                                                $result = $conn->query($sql);
                                                while ($row = mysqli_fetch_assoc($result)){               
                                                    echo "<option value='".$row["id"]."'>".$row["firstname"]."</option>";
                                                }
                                            ?>
                                    </select>
                                    </div>
                                </div>
                                Traitement
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Jour de traitement <input type="date" class="form-control form-control-user" id="datetraite"
                                           name="datetraite" placeholder="date achat" required>
                                    </div>
                                    <div class="col-sm-5 mb-3 mb-sm-0">
                                        Observation :<textarea  class="form-control form-control-user" id="secondvacin"
                                           name="Observation" placeholder="Observation" required></textarea>
                                    </div>
                                    <div class="col-sm-5 mb-3 mb-sm-0">
                                        Conduite: <textarea  class="form-control form-control-user" id="secondvacin"
                                           name="Conduite" placeholder="Conduite" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                        Montant <input type="number" class="form-control form-control-user" id="Montant"
                                           name="Montant" placeholder="Montant" required>
                                    
                                </div>
                                <button type="submit" name="submit" id="submit" class="btn btn-success btn-user btn-block">
                                    Enregister
                                </button>
                                
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

</body>

</html>