<?php 
    session_start();
    require_once("getclient.php");
    $client = new Client($_SESSION['id']);
    $achatClient = $client->SelectAchatProvenderie($_SESSION['id']);
    
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
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>MENU</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#vente"
                    aria-expanded="true" aria-controls="vente">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Achat Provenderie</span>
                </a>
                <div id="jounale" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Achat Provenderie</h6>
                        <a class="collapse-item" href="client">Achat Provenderie</a> 
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pharmacie"
                    aria-expanded="true" aria-controls="pharmacie">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Achat Pharmacie</span>
                </a>
                <div id="pharmacie" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Achat Pharmacie</h6>
                        <a class="collapse-item" href="#">Achat Pharmacie</a> 
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dette"
                    aria-expanded="true" aria-controls="dette">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Liste Dette</span>
                </a>
                <div id="dette" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Liste Dette</h6>
                        <a class="collapse-item" href="#">Liste Dette</a> 
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Versement"
                    aria-expanded="true" aria-controls="Versement">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Liste Versement</span>
                </a>
                <div id="Versement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Liste Versement:</h6>
                        <a class="collapse-item" href="#">Liste Versement</a>
                        
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->

            <!-- Nav Item - Utilities Collapse Menu -->
           

            <!-- Divider -->
            

            <!-- Nav Item - Tables -->
           

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["name"]; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
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
                                        <div class="col-sm-5 ">
                                            <a class="m-0 font-weight-bold text-success" href="">Precedent</a>
                                        </div>
                                        <div class="col-sm-2 ">
                                            <p class="m-0 font-weight-bold text-bold" >Facture :<?php echo $achatClient["id"]; ?></p>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <p class="m-0 font-weight-bold text-bold" >date<?php echo $achatClient["datevente"]; ?></p>
                                        </div>
                                        <div class="col-sm-2 ">
                                            <a class="m-0 font-weight-bold text-success" href="">Suivant</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25'>
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
                                                global $conn;
                                                $id = $achatClient["id"];
                                                $quantite = 0;
                                                $prix = 0;
                                                $montant = 0;

                                                $sql = "SELECT * FROM facture WHERE idvente = '$id'";
                                                $result = $conn->query($sql);
                                                while ($row = mysqli_fetch_assoc($result)){
                                                    echo '<tr>';
                                                    echo '<td>'.$row["id"].'</td>';
                                                    echo '<td>'.$row["nomproduit"].'</td>';
                                                    echo '<td>'.$row["quantite"].'</td>';
                                                    echo '<td>'.$row["prix"].'</td>';
                                                    echo '<td>'.$row["montant"].'</td>';
                                                    echo '<td>'.$row["Typepaiement"].'</td>';
                                                    echo '</tr>';
                                                    //var_dump($row);

                                                    $quantite += $row["quantite"];
                                                    $prix += $row["prix"];
                                                    $montant += $row["montant"];

                                                }

                                                
                                                echo '<tr>';
                                                    echo '<td>Total</td>';
                                                    echo '<td>-</td>';
                                                    echo '<td>'.$quantite.'</td>';
                                                    echo '<td>'.$prix.'</td>';
                                                    echo '<td>'.$montant.'</td>';
                                                    echo '<td>-</td>';
                                                    echo '</tr>';
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                
                                    <hr> 
                                    <b> Liste des facture </b> 
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
    <script src="../js/demo/chart-area-moi.js"></script>
    
    <script src="../js/demo/chart-bar-moi.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>