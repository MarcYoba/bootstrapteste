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

    <div class="container" >
        
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center" >
                                <h1 class="h4 text-gray-900 mb-4">Caisse</h1>
                            </div>
                            <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row ">
                                            <?php

                                                require_once("../connexion.php");
                                                require_once("../bdmutilple/getvente.php");
                                                $vente = new Vente(1);

                                                if ((!empty($_POST["OM"])) && (empty($_POST["datedette"])) && (empty($_POST["datedett2"]))) {
                                                    echo '<p class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-bold text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                    $somOm = 0;
                                                    $somOm = $vente->getSommeOm();
                                                    if (empty($somOm)) {
                                                        $somOm = "00000";
                                                    } 
                                                       echo'<h3> Somme vente OM/MOMO '.$somOm.' FCFA </h3></div>';
                                                    echo '</div></p>';
                                                }elseif ((!empty($_POST["OM"])) && (!empty($_POST["datedette"])) && (empty($_POST["datedett2"]))) {
                                                    echo '<div class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-bold text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                    $somOm = $vente->getSommeOmDate($_POST["datedette"]);
                                                    if (empty($somOm)) {
                                                        $somOm = "00000";
                                                    } 
                                                       echo'<h3> Somme vente OM/MOMO '.ceil($somOm).' FCFA </h3></div>';
                                                    echo '</div></div>';
                                                }elseif ((!empty($_POST["OM"])) && (!empty($_POST["datedette"])) && (!empty($_POST["datedett2"]))) {
                                                    echo '<div class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-bold text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                    $somOm = 0;
                                                    $somOm = $vente->getSommeOmWeek($_POST["datedette"],$_POST["datedett2"]);
                                                    if ( empty($somOm)) {
                                                        $somOm = "00000";
                                                    }
                                                       echo'<h3> Somme vente OM/MOMO : '.ceil($somOm).' FCFA</h3></div>';
                                                    echo '</div></div>';
                                                }

                                                if ((!empty($_POST["credit"])) && (empty($_POST["datedette"])) && (empty($_POST["datedett2"]))) {
                                                    echo '<div class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-bold text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                    $somOm = 0;
                                                    $somOm = $vente->getSommeCredit();
                                                    if (empty($somOm)) {
                                                        $somOm = "00000";
                                                    } 
                                                       echo'<h3> Somme vente Credit '.ceil($somOm).' FCFA </h3></div>';
                                                    echo '</div></div>';
                                                }elseif ((!empty($_POST["credit"])) && (!empty($_POST["datedette"])) && (empty($_POST["datedett2"]))) {
                                                    echo '<div class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-bold text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                       echo'<h3> Somme vente Credit'.$vente->getSommeCashDate($_POST["datedette"]).' FCFA </h3></div>';
                                                    echo '</div></div>';
                                                }elseif ((!empty($_POST["credit"])) && (!empty($_POST["datedette"])) && (!empty($_POST["datedett2"]))) {
                                                    echo '<div class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-bold text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                    $somOm = 0;
                                                    $somOm = $vente->getSommeCreditWeek($_POST["datedette"],$_POST["datedett2"]);
                                                    if ( empty($somOm)) {
                                                        $somOm = "00000";
                                                    }
                                                       echo'<h3> Somme vente Credit : '.ceil($somOm).' FCFA</h3></div>';
                                                    echo '</div></div>';
                                                }

                                                
                                                if ((!empty($_POST["cash"])) && (empty($_POST["datedette"])) && (empty($_POST["datedett2"]))) {
                                                    echo '<div class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-black text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                    $somOm = 0;
                                                    $somOm = $vente->getSommeCash();
                                                    if (empty($somOm)) {
                                                        $somOm = "00000";
                                                    } 
                                                       echo'<h3> Somme vente cash '.ceil($somOm).' FCFA </h3></div>';
                                                    echo '</div></div>';
                                                }elseif ((!empty($_POST["cash"])) && (!empty($_POST["datedette"])) && (empty($_POST["datedett2"]))) {
                                                    echo '<div class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-bold text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                       echo'<h3> Somme vente cash '.$vente->getSommeCashDate($_POST["datedette"]).' FCFA </h3></div>';
                                                    echo '</div></div>';
                                                }elseif ((!empty($_POST["cash"])) && (!empty($_POST["datedette"])) && (!empty($_POST["datedett2"]))) {
                                                    echo '<div class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-black text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                    $somOm = 0;
                                                    $somOm = $vente->getSommeCashWeek($_POST["datedette"],$_POST["datedett2"]);
                                                    if ( empty($somOm)) {
                                                        $somOm = "00000";
                                                    }
                                                       echo'<h3> Somme vente cash : '.ceil($somOm).' FCFA</h3></div>';
                                                    echo '</div></div>';
                                                }

                                                if ((!empty($_POST["vente"])) && (empty($_POST["datedette"])) && (empty($_POST["datedett2"]))) {
                                                    echo '<div class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-black text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                    $somOm = 0;
                                                    $somOm = $vente->getSommeCredit()+$vente->getSommeCash()+$vente->getSommeOm();
                                                    if (empty($somOm)) {
                                                        $somOm = "00000";
                                                    } 
                                                       echo'<h3> Somme vente vente '.ceil($somOm).' FCFA </h3></div>';
                                                    echo '</div></div>';
                                                }elseif ((!empty($_POST["vente"])) && (!empty($_POST["datedette"])) && (empty($_POST["datedett2"]))) {
                                                    echo '<div class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-bold text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                    $somOm = $vente->getSommeVentedate($_POST["datedette"]);
                                                    if (empty($somOm)) {
                                                        $somOm = "00000";
                                                    } 
                                                       echo'<h3> Somme vente cash '.ceil($somOm).' FCFA </h3></div>';
                                                    echo '</div></div>';
                                                }elseif ((!empty($_POST["vente"])) && (!empty($_POST["datedette"])) && (!empty($_POST["datedett2"]))) {
                                                    echo '<div class="col-md-5">';
                                                    echo'<div class="text-xs font-weight-black text-black text-uppercase mb-1 btn btn-success btn-lg bg-gradient-primaire">';
                                                    $somOm = 0;
                                                    $somOm = $vente->getSommeVenteWeek($_POST["datedette"],$_POST["datedett2"]) -$vente->getSommeReductionWeek($_POST["datedette"],$_POST["datedett2"]);
                                                    if ( empty($somOm)) {
                                                        $somOm = "00000";
                                                    }
                                                       echo'<h3> Somme vente vente : '.ceil($somOm).' FCFA</h3></div>';
                                                    echo '</div></div>';
                                                }
                                               
                                            
                                            ?>
                                            
                                        </div>
                                    </div>
                                    </a>
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
    <!--<script src="produit.js"></script> --> 

</body>

</html>