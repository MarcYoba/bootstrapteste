<?php 
session_start();
require_once("getclient.php");
    $client = new Client($_SESSION['idclient']);
    $achatClient = $client->SelectAchatCabinet($_SESSION['idclient']);
    $nbelement = count($achatClient);

    if (!empty($_GET["id"])) {
        if (($_GET["id"]>= 0)  && ($_GET["id"]< $nbelement-1)) {
            $element = $achatClient[$_GET["id"]];
        }else{
            $element = $achatClient[0];
        }
        
    } else {
        $element = $achatClient[0];
    }
    $facture = $client->selectFactureCabinet($element["id"]);
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

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .cacher{
            display: none;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once("navbar.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once("topbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">facture Numero : <?php echo $element["id"];?> </h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3"> 
                                <div class="form-group row">
                                    <div class="col-md-3"><h6 class="m-0 font-weight-bold text-primary">facture</h6></div>
                                    <?php 
                                        if (($_GET["id"]>=1) && ($_GET["id"]<=$nbelement)) {
                                            $index = $_GET["id"];
                                            $index -= 1;
                                            echo "<div class='col-sm-3'>
                                            <td>
                                            <a href='cfacture.php?id=" . $index. "' class='btn btn-info btn-user'>Precedente 
                                            </a>
                                            </td>
                                            </div>";
                                        }else {
                                            echo "<div class='col-sm-3'></div>";
                                        } 
                                        
                                    ?>
                                    
                                   <div class='col-md-4 '> <a <?php echo "href='pharmacie.php?id=" . $element["id"]. "'"; ?>  class='btn btn-primary btn-user' >Passer commande</a></div>
                                    
                                    <?php 
                                        if (($_GET["id"]>=0) && ($_GET["id"]<$nbelement-1)) {
                                            $index = $_GET["id"];
                                            $index += 1;
                                            echo "<div class='col-sm-2'>
                                            <td>
                                            <a href='cfacture.php?id=" . $index. "' class='btn btn-info btn-user'>Suivant 
                                            </a>
                                            </td>
                                            </div>";
                                        }else {
                                            echo "<div class='col-sm-2'></div>";
                                        } 
                                        
                                    ?>
                                </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                       
                                        <tr>
                                            <th>id</th>
                                            <th>Nom</th>
                                            <th>quantite</th>
                                            <th>prix unitaire</th>
                                            <th>montant</th>
                                            <th>Typepaiement</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <!--- <tr>
                                            <th>id</th>
                                            <th>Nom</th>
                                            <th>quantite</th>
                                            <th>prix</th>
                                            <th>montant</th>
                                            <th>Typepaiement</th>
                                        </tr>
                                        --->
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        
                                    
                                        foreach ($facture as $key ) {
                                            echo '<tr>';
                                            echo '<td>'.$key["id"].'</td>';
                                            echo '<td>'.$key["nomproduit"].'</td>';
                                            echo '<td>'.$key["quantite"].'</td>';
                                            echo '<td>'.$key["prix"].'</td>';
                                            echo '<td>'.$key["montant"].'</td>';
                                            echo '<td>'.$key["Typepaiement"].'</td>';
                                            echo '</tr>';
                                        }

                                        
                                        echo '<tr>';
                                            echo '<td>Total</td>';
                                            echo '<td>-</td>';
                                            echo '<td>'.$element["quantite"].'</td>';
                                            echo '<td> reduction : '.$element["reduction"].'</td>';
                                            echo '<td>'.$element["prix"].'</td>';
                                            echo '<td>-</td>';
                                            echo '</tr>';
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
                        <span>vestion test &copy;<?php echo date("Y-m-d") ?></span>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    

</body>

</html>