<?php 
    session_start();
    require_once("getclient.php");
    $client = new Client($_SESSION['idclient']);
    $achatClient = $client->SelectAchatDetteProvenderie($_SESSION['idclient']);
    $somme = $client->getSommeProvenderie($_SESSION['idclient']);
    $nbelement = count($achatClient);
    
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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once("navbar.php") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once("topbar.php") ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-10">
                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                <div class="form-group row">
                                        <div class="col-sm-2 ">
                                            <p class="m-0 font-weight-bold text-bold" >Qantite Total : <?php echo $somme["quantite"]; ?></p>
                                        </div>
                                        <div class="col-sm-2 ">
                                            <p class="m-0 font-weight-bold text-bold test-primary" >Montant Total <?php echo $somme["montant"]; ?></p>  
                                        </div>
                                        <div class="col-sm-2 ">
                                            <p class="m-0 font-weight-bold text-bold" >Total CASH <?php echo $somme["cash"]; ?></p>
                                        </div>
                                        <div class="col-sm-2 ">
                                        <p class="m-0 font-weight-bold text-bold" >Total Credit <?php echo $somme["credit"]; ?></p>
                                        </div>
                                        <div class="col-sm-2 ">
                                        <p class="m-0 font-weight-bold text-bold" >Total OM <?php echo $somme["om"]; ?></p>
                                        </div>
                                        <div class="col-sm-2 ">
                                        <p class="m-0 font-weight-bold text-bold" >Total Banque <?php echo $somme["om"]; ?></p>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='100'>
                                            <thead>
                                            
                                                <tr>
                                                    <th>id</th>
                                                    <th>Typepaiement</th>
                                                    <th>quantite</th>
                                                    <th>prix</th>
                                                    <th>montant</th>
                                                    <th>reduction</th>
                                                    
                                                    <th>voire facture</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                 <tr>
                                                    <th>id</th>
                                                    <th>Typepaiement</th>
                                                    <th>quantite</th>
                                                    <th>prix</th>
                                                    <th>montant</th>
                                                    <th>reduction</th>
                                                    <th>voire facture</th>
                                                </tr>
                                                
                                            </tfoot>
                                            <tbody>
                                            <?php 
                                                $index = 0;
                                               foreach ($achatClient as $linefatcture) {
                                                echo '<tr>';
                                                
                                                    echo '<td>' .$linefatcture["id"].'</td>';
                                                    echo '<td>' .$linefatcture["typevente"].'</td>';
                                                    echo '<td>' .$linefatcture["quantite"].'</td>';
                                                    echo '<td>' .$linefatcture["prix"].'</td>';
                                                    echo '<td>' .$linefatcture["datevente"].'</td>';
                                                    echo '<td>' .$linefatcture["reduction"].'</td>';
                                                    echo "<td><a href='pfacture.php?id=" . $index. "' class='btn btn-primary'><i class='fas fa-pencil-alt'>Facture</i></a></td>";
                                                
                                               echo '</tr>';
                                               $index++;
                                            } 
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                
                                    <hr> 
                                    <b> Liste des Achat </b> 
                                </div>
                            </div>

                            <!-- Bar Chart -->
                        </div>

                        <!-- Donut Chart -->
                    </div> 
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span></span>
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
                    <a class="btn btn-primary" href="index.php">Logout</a>
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

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>