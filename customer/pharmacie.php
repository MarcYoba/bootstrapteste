<?php
session_start();
    require_once("getclient.php");
    $client = new Client(0);

 ?>

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
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

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
                                    <div class="col-sm-10">
                                        <h1 class="h4 text-gray-900 mb-4">Vue Cleint</h1>
                                    </div>
                                    <div class="col-sm-2">
                                       <a href="../activites.php"> <h1 class="h4 text-gray-900 mb-4">Retour</h1> </a>
                                    </div>
                                </div>
                                <hr>

                                <div class="card shadow mb-4">
                                
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <form  action="selectinfo.php" method="post" >
                                        <div class="form-group row">
                                        
                                            <div class="col-sm-3 mb-3 mb-sm-0">
                                                
                                                <label class="form-check-label" id="">mode de paiement de la facture : </label> 
                                                <input type="text" name="reference" id="reference" value="<?php echo $_GET["id"];?>" readonly>
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0">
                                                <input class="form-check-input" type="checkbox" id="OM" name="OM" value="OM">
                                                <label class="form-check-label" id="OM">OM</label>  
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0">
                                                <input class="form-check-input" type="checkbox" id="MOMO" name="MOMO" value="MOMO">
                                                <label class="form-check-label" id="MOMO">MOMO</label>
                                            </div>

                                            <div class="col-sm-2 mb-3 mb-sm-0">
                                                <input class="form-check-input" type="checkbox" id="BANQUE" name="BANQUE" value="BANQUE">
                                                <label class="form-check-label" id="BANQUE">BANQUE</label>
                                            </div>

                                            <div class="col-sm-2 mb-3 mb-sm-0">
                                                <input class="form-check-input" type="checkbox" id="CASH" name="CASH" value="CASH">
                                                <label class="form-check-label" id="CASH">CASH</label>
                                            </div>
                                  
                                            <button type="submit" id="pharmacie" name="pharmacie" class="btn btn-primary btn-user btn-block">
                                                    enregistrer
                                            </button>
                                        
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                    
                                </div>
                            <!--</form> -->
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="client.js"></script>
    
</body>
</html>