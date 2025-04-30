<?php 
require_once("../connexion.php"); 
require_once("../bdmutilple/getclient.php");
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
        <?php require_once("../../headercabinet.php"); ?>
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
                    <h1 class="h3 mb-2 text-gray-800">service</h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="m-0 font-weight-bold text-primary">Tables Terrain</h6>
                                </div>
                                <div class="col-md-2">
                                    <i class="fas fa-list"></i>
                                    <a href="service.php" class="btn btn-primary">Ajouter</a>
                                </div>
                                <div class="col-md-2">
                                    <i class="fas fa-list"></i>
                                    <a href="list.php" class="btn btn-primary">list</a>
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                <label for="annee">Année recherche :</label>
                                    <select class="form-control" id="annee" name="annee" onchange="reload()">
                                        <?php
                                        $currentYear = 2024;
                                        echo "<option >Recherche a</option>";
                                        for ($year = $currentYear; $year <= $currentYear + 10; $year++) {
                                            echo "<option value=\"$year\">$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                    <thead>
                                       
                                        <tr>
                                            <th>id</th>
                                            <th>localisation</th>
                                            <th>motifvisite</th>
                                            <th>efectif</th>
                                            <th>Client</th>
                                            <th>Telephone</th>
                                            <th>Age</th>
                                            <th>Montant</th>
                                            <th>date</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>localisation</th>
                                            <th>motifvisite</th>
                                            <th>efectif</th>
                                            <th>Client</th>
                                            <th>Telephone</th>
                                            <th>Age</th>
                                            <th>Montant</th>
                                            <th>date </th>
                                            <th>Operation</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        global $conn;
                                        $client = new Client(1);
                                        $date = date("Y-m-d");
                                        if (isset($_GET['date'])) {
                                            $date = $_GET['date'];
                                        } else {
                                            $date = date("Y");
                                        }
                                        
                                        $sql = "SELECT * FROM terrain WHERE YEAR(datejour) = '$date'";
                                        $result = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)){
                                            $infoclient = $client->getAllByIdClient($row["idclient"]);
                                            echo '<tr>';
                                            echo '<td>'.$row["id"].'</td>';
                                            echo '<td>'.$row["localisation"].'</td>';
                                            echo '<td>'.$row["motifvisite"].'</td>';
                                            echo '<td>'.$row["efectif"].'</td>';
                                            echo '<td>'.$client->getByIdClient($row["idclient"]).'</td>';
                                            echo '<td>'.$infoclient["telephone"].'</td>';
                                            echo '<td>'.$row["Age"].'</td>';
                                            echo '<td>'.$row["Montant"].'</td>';
                                            echo '<td>'.$row["datejour"].'</td>';
                                            echo "<td>";
                                            if (($_SESSION['roles'] == "Lecture") || ($_SESSION['roles'] == "Ecriture")) {
                                                echo "<a href='detaile.php?id=" . $row["id"] . "' class='btn btn-primary'><i class='fas fa-pencil-alt'></i></a>";
                                            }elseif ($_SESSION['roles'] == "semiadmin"){
                                                echo "<a href='detaile.php?id=" . $row["id"] . "' class='btn btn-primary'><i class='fas fa-pencil-alt'></i></a>";
                                            }else{
                                            echo "<a href='detaile.php?id=" . $row["id"] . "' class='btn btn-primary'><i class='fa fa-bars'></i></a>";
                                            
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
                        <span>vestion test &copy; Your Website <?php echo date("Y-m-d") ?></span>
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
    <script>
        function reload() {
            var annee = document.getElementById("annee").value;
            window.location.href = "liste.php?date=" + annee;
        }
    </script>

</body>

</html>