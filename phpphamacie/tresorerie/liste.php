<?php 

require_once("../connexion.php"); 

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>gestion de stock</title>

    <!-- Custom fonts for this template -->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="../../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once("../../headercabinet.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php 
                   
                    global $conn;
                    require_once("../bdmutilple/getTresorerie.php");
                    $Tresorerie = new Tresorerie();

                    if (isset($_GET["anne"])) {
                        //echo $_GET["anne"];
                        $Tresorerie = $Tresorerie->GetTresorerie($_GET["anne"]);
                    } else {
                        $Tresorerie = $Tresorerie->GetTresorerie(date("Y"));
                    }  
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tresorerie</h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Structure de la Tresorerie</h6>
                            <br>
                            <div class=" form-group row">
                            <p class="col-md-2" >
                                <button class="btn btn-info btn-user btn-block" onclick="AnneBilan()">Tresorerie au </button>
                            </p>
                            <p class="col-md-3">
                               Entrez annee <input type="number" name="nombre" id="nombre" value="2022"> 
                            </p>
                            <p class="col-md-5"> 
                            </p>
                            
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableactif" width="100%" cellspacing="0" data-page-length='50' >
                                    <thead>
                                       
                                        <tr>
                                            <th rowspan="2" style="text-align: center;">BESOINS</th>
                                            <?php 
                                             if (isset($_GET["anne"])) {
                                                echo '<th colspan="13" style="text-align: center;">'.$_GET["anne"].'</th>';
                                             } else {
                                                echo '<th colspan="13" style="text-align: center;">2022</th>';
                                             }
                                            ?>
                                        </tr>
                                        <tr>
                                            
                                            <th>MOIS 01</th>
                                            <th>MOIS 02</th>
                                            <th>MOIS 03</th>
                                            <th>MOIS 04</th>
                                            <th>MOIS 05</th>
                                            <th>MOIS 06</th>
                                            <th>MOIS 07</th>
                                            <th>MOIS 08</th>
                                            <th>MOIS 09</th>
                                            <th>MOIS 10</th>
                                            <th>MOIS 11</th>
                                            <th>MOIS 12</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>--</th>
                                            <th>MOIS 01</th>
                                            <th>MOIS 02</th>
                                            <th>MOIS 03</th>
                                            <th>MOIS 04</th>
                                            <th>MOIS 05</th>
                                            <th>MOIS 06</th>
                                            <th>MOIS 07</th>
                                            <th>MOIS 08</th>
                                            <th>MOIS 09</th>
                                            <th>MOIS 10</th>
                                            <th>MOIS 11</th>
                                            <th>MOIS 12</th>
                                        <th>Operation</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                         if(!empty($Tresorerie)){
                                        // var_dump($actif);
                                        foreach ($Tresorerie as $key => $value) {
                                            echo '<tr>';
                                            // var_dump($value);
                                            // exit();
                                           
                                                if (strpos($value[0], "Totale") !== false) {
                                                    foreach ($value as $keys => $element) {
                                                        if($keys != 1){
                                                            echo '<td style="color: red;">'.$element.'</td>';
                                                            echo '<td style="color: blue;">'.$element.'</td>';
                                                        }
                                                    }
                                                } else {
                                                    foreach ($value as $keys => $element) {
                                                        if( $keys != 1){
                                                            echo '<td>'.$element.'</td>';
                                                        }
                                                    }
                                                    if (($_SESSION['roles'] == "Lecture") || ($_SESSION['roles'] == "Ecriture")) {
                                                        # code...
                                                    }else if(($_SESSION['roles'] == "semiadmin")){
                                                        echo "<td><a href='tresorerie.php?id=" .$value[1]. "' class='btn btn-primary' id='modification'><i class='fas fa-pencil-alt '></i></a>";
                                                    }else{
                                                        echo "<td><a href='tresorerie.php?id=" .$value[1]. "' class='btn btn-primary' id='modification'><i class='fas fa-pencil-alt '></i></a>";
                                                    }
                                                }
                                            }
                                            echo '</tr>';
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>vestion test &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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
    <script src="bilan.js"></script>
    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../header.js"></script>
    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>
    

</body>

</html>