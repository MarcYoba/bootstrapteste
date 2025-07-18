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
                    <h1 class="h3 mb-2 text-gray-800">Vaccin</h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Liste des Vaccins</h6>
                            <div class="row">
                                <div class="col-md-2">
                                    <h6 class="m-0 font-weight-bold text-primary">Tables Vaccin</h6>
                                </div>
                                <div class="col-md-3">
                                    <a href="vacin.php" class="btn btn-primary" >Ajouter un Vaccin</a>
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-home"></i>
                                        <a href="../../homepahamacie.php" class="btn btn-primary">Home</a> 
                                    </div>
                                            <div class="col-sm-2">
                                                <i class="fa fa-plus"></i> 
                                                <a href="vacin.php" class="btn btn-success"> Ajouter</a>
                                                
                                            </div>
                                <div class="col-md-3" style="float:right;">
                                <label for="annee">Année recherche :</label>
                                    <select class="form-control" id="annee" name="annee" onchange="reload()">
                                        <?php
                                        $currentYear = date("Y");
                                        $currentYear +=10;
                                        echo "<option >Recherche a</option>";
                                        for ($year = 2022; $year <= $currentYear; $year++) {
                                            echo "<option value=\"$year\">$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <form  action="../pdf/getvaccin.php" method="post" class="user row" >
                                        <div class="row">
                                            <p class="col-md-3" >
                                                <input type="date" class="form-control form-control-user"
                                                name="datedette" id="datedette" placeholder="quantité">
                                            </p>
                                            <p class="col-md-3" >
                                                <input type="date" class="form-control form-control-user"
                                                name="datedett2" id="datedett2" placeholder="quantité">
                                            </p>

                                            <p class="col-md-2" >
                                                <input type="submit" class="btn btn-warning btn-user"  value="Afficher" >  
                                            </p>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                    <thead>
                                       
                                        <tr>
                                            <th>id</th>
                                            <th>Nom Sujet</th>
                                            <th>Age</th>
                                            <th>Race</th>
                                            <th>Client</th>
                                            <th>telephone</th>
                                            <th>montant</th>
                                            <th>Avance</th>
                                            <th>Type vacin</th>
                                            <th>Lieu</th>
                                            <th>date Vacin</th>
                                            <th>date rappel</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Nom Sujet</th>
                                            <th>Age</th>
                                            <th>Race</th>
                                            <th>Client</th>
                                            <th>telephone</th>
                                            <th>montant</th>
                                            <th>Avance</th>
                                            <th>Type vacin</th>
                                            <th>Lieu</th>
                                            <th>date Vacin</th>
                                            <th>date rappel</th>
                                            <th>Operation</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        global $conn;
                                        $date = date("Y-m-d");
                                        if(isset($_GET['date'])){
                                            $date = $_GET['date'];
                                        }else{
                                            $date = date("Y");
                                        }
                                        $client = new Client(1);
                                        $sql = "SELECT * FROM animale WHERE YEAR(datevacin) = '$date'";
                                        $result = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)){
                                            $dataclient = $client->getAllByIdClient($row["idclient"]);
                                            echo '<tr>';
                                            echo '<td>'.$row["id"].'</td>';
                                            echo '<td>'.$row["nomSujet"].'</td>';
                                            echo '<td>'.$row["age"].'</td>';
                                            echo '<td>'.$row["typesujet"].'</td>';
                                            echo '<td>'.$dataclient["firstname"].'</td>';
                                            echo '<td>'.$dataclient["telephone"].'</td>';
                                            echo '<td>'.$row["montant"].'</td>';
                                            echo '<td>'.$row["netpayer"].'</td>';
                                            echo '<td>'.$row["typeVacin"].'</td>';
                                            echo '<td>'.$row["lieux"].'</td>';
                                            echo '<td>'.$row["datevacin"].'</td>';
                                            echo '<td>'.$row["daterappel"].'</td>';
                                            echo "<td>";
                                            if (($_SESSION['roles'] == "Lecture") || ($_SESSION['roles'] == "Ecriture")) {
                                                # code...
                                            }elseif ($_SESSION['roles'] == "semiadmin"){
                                                echo "<a href='Edite.php?id=" . $row["id"] . "' class='btn btn-primary'><i class='fas fa-pencil-alt'></i></a>";
                                            }else{
                                            echo "<a href='vacin.php?id=" . $row["id"] . "' class='btn btn-primary'><i class='fas fa-pencil-alt'></i></a>";
                                            echo "<a href='vacin.php?delete=" . $row["id"] . "' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce Vaccin ?\");'><i class='fas fa-trash-alt'></i></a>";
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
                        <span>Production &copy;</span>
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