<?php 
require_once("../connexion.php"); 
require_once("../bdmutilple/getclient.php");
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

    <title>Gestion de stock</title>

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
        <?php require_once("../../headerProvenderi.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once("../../Topbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Commande client</h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tables Commande</h6> <br>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                    <thead>
                                       
                                        <tr>
                                            <th>id</th>
                                            <th>vente</th>
                                            <th>Nom</th>
                                            <th>methode paiement</th>
                                            <th>date commande</th>
                                            <th>status commande</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>vente</th>
                                            <th>Nom</th>
                                            <th>methode paiement</th>
                                            <th>date commande</th>
                                            <th>status commande</th>
                                            <th>Operation</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        global $conn;
                                        $sql = "SELECT * FROM commadeclient";
                                        $result = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)){
                                            echo '<tr>';
                                            echo '<td>'.$row["id"].'</td>';
                                            echo '<td>'.$row["idvente"].'</td>';
                                            echo '<td>'.$client->getByIdClient($row["userid"]).'</td>';
                                            echo '<td>'.$row["paiementmethode"].'</td>';
                                            echo '<td>'.$row["datecommande"].'</td>';
                                            echo '<td>'.$row["statuscommande"].'</td>';
                                            echo "<td>";
                                            if (($_SESSION['roles'] == "Lecture") || ($_SESSION['roles'] == "Ecriture")) {
                                                echo "<button class='btn btn-primary' onclick='valider(". $row["id"] .")'>Valider</button>";
                                                echo "<button class='btn btn-danger' onclick='modifierClient(". $row["id"] .")'>ANNUL</button>";
                                            }elseif ($_SESSION['roles'] == "semiadmin"){
                                                echo "<button class='btn btn-primary' onclick='valider(". $row["id"] .")'>Valider</button>";
                                                echo "<button class='btn btn-danger' onclick='modifierClient(". $row["id"] .")'>ANNUL</button>";
                                            }else{
                                            echo "<button class='btn btn-primary' onclick='valider(". $row["id"] .")'>Valider</button>";
                                            echo "<button class='btn btn-danger' onclick='annuler(". $row["id"] .")'>ANNUL</button>";
                                            }
                                            echo "</td>";
                                            echo '</tr>';
                                            //var_dump($row);
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
                        <span>Copyright &copy; Your Website 2020</span>
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

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../header.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>
    <script src="client.js"></script>

</body>

</html>