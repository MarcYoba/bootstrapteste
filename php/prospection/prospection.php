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

    <div class="container" >
        
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
                                    <h6 class="m-0 font-weight-bold text-primary">Création du Produit</h6>
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
                        </div>
                            <form class="user" action="register.php" method="post" enctype="multipart/form-data">
                                <div class="form-group ">
                                    <div class="col-sm-14 mb-3 mb-sm-0">
                                        Numero Reference du produit :
                                        <input type="text" class="form-control form-control-user drop" id="reference"
                                        name="reference" required readonly> 
                                                
                                    </div>
                                    <hr>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="propect"
                                            name="propect" placeholder="Nom de la personne" >
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="tel" class="form-control form-control-user" id="telephone"
                                            name="telephone" placeholder="Telephone de la personne" >
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user"
                                            name="prixvente" id="prixvente" placeholder="Prix de vente" >
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="number" class="form-control form-control-user"
                                            name="prixachat" id="prixachat" placeholder="Prix achat" > 
                                        </div>
                                    </div>
                                    <hr>
                                    
                                    
                                    <span id="buttonenregistrement" >
                                        <button type="submit" name="enregistrement" id="enregistrement" class="btn btn-primary btn-user btn-block">
                                            Enregistrement
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
    <script src="produit.js"></script> 

</body>

</html>