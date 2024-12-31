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
        #imageContainer {
        width: 21cm; /* Largeur d'une feuille A4 */
        height: 19.7cm; /* Hauteur d'une feuille A4 */
        border: 1px solid black;
        align-items: center;
        overflow: hidden;
        }

        #imageContainer img {
        width: 100%;
        height: 90%;
        object-fit: contain;
        }
    </style>

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
                                    <div class="col-sm-8 ">
                                    <h6 class="m-0 font-weight-bold text-success">Facture d'achat</h6>
                                    </div>
                                    <div class="col-sm-2 ">
                                    <a class="m-0 font-weight-bold text-warning" href="../achat/liste.php">Retour</a>
                                    </div>
                            </div>
                            <hr>
                            <div class="col-xl-12 col-lg-7 ">
                            <div class="card shadow mb-4 ">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">Facture fournisseur</h6>
                                    <div class="dropdown no-arrow">
                                    </div><br>
                                </div>
                                <div class="form-group row">
                                        <?php 
                                            require_once("../bdmutilple/getBond.php");
                                            $date =  $_GET["date"];
                                            $bon = new BonCommande();
                                            $boncommande = $bon->getBonDate($date);

                                            foreach ($boncommande as $key => $value) {
                                                echo'<div class="col-sm-8">';
                                                echo'<h1> Numero de reference iamge : '.$value["id"].'</h1>';
                                                echo'</div> <br>';
                                                echo '<div class="col-sm-3">
                                                        <a href="'.$value["chemin"].'" download="bon_commande.jpg" class="btn btn-primary btn-user btn-block">Télécharger image</a>
                                                        </div>';
                                                echo'<div class="col-sm-12">';
                                                echo '<div style="text-align: center;">
                                                        <img src="'.$value["chemin"].'" alt="Mon image" style="display: block;" id="imageContainer">
                                                    </div>';
                                                echo'</div>';
                                            }
                                        ?>
                                        </div> 
                                
                            </div>
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
    <script src="../../js/sb-admin-2.min.js"></script>
    <script src="client.js"></script>
</body>
</html>