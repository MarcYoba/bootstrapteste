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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Situation Comptable </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../../home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jounale"
                    aria-expanded="true" aria-controls="jounale">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Journal Comptable</span>
                </a>
                <div id="jounale" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Journal Comptable:</h6>
                        <a class="collapse-item" href="../comptabilite/Journale.php">Jounal</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inventaire"
                    aria-expanded="true" aria-controls="inventaire">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Inventaite</span>
                </a>
                <div id="inventaire" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Inventaite:</h6>
                        <a class="collapse-item" href="../comptabilite/inventaire.php">inventaite</a> 
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#etatresultat"
                    aria-expanded="true" aria-controls="etatresultat">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Etat des resultats</span>
                </a>
                <div id="etatresultat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Etat des resultats:</h6>
                        <a class="collapse-item" href="../comptabilite/etatresultat.php">marge beneficiere</a> 
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Composant Vente</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="../vente/liste.php">Vente</a>
                        <a class="collapse-item" href="../achat/liste.php">Achat</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="../versement/liste.php">versement</a>
                        <a class="collapse-item" href="../dette/dette.php">Dette</a>
                        <a class="collapse-item" href="../depenses/liste.php">Depense</a>
                        <a class="collapse-item" href="../produit/liste.php">Produit</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administrateur
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            <!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="../../charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Statistique</span></a>
            </li>

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

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Journal comptable</h1>
                    <hr>
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-10">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Journal des Achats</h6>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                                <thead>
                                                    <tr>
                                                        <th>Janvier</th>
                                                        <th>Fevrier</th>
                                                        <th>Mars</th>
                                                        <th>Avril</th>
                                                        <th>Mai</th>
                                                        <th>Jun</th>
                                                        <th>Juillet</th>
                                                        <th>Aout</th>
                                                        <th>Septembre</th>
                                                        <th>Octobre</th>
                                                        <th>Novembre</th>
                                                        <th>Decembre</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Janvier</th>
                                                        <th>Fevrier</th>
                                                        <th>Mars</th>
                                                        <th>Avril</th>
                                                        <th>Mai</th>
                                                        <th>Jun</th>
                                                        <th>Juillet</th>
                                                        <th>Aout</th>
                                                        <th>Septembre</th>
                                                        <th>Octobre</th>
                                                        <th>Novembre</th>
                                                        <th>Decembre</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <tr>
                                                    <?php 
                                                        require_once("../bdmutilple/comptabilite.php");
                                                        $compta = new Comptabilite();
                                                        $somme = $compta->AcahAnuelle();
                                                        
                                                        foreach ($somme as $key=> $element) {
                                                            foreach ($element as $ke => $value) {
                                                                if (empty($value)) {
                                                                    echo '<td>0</td>';
                                                                } else {
                                                                    echo '<td>'.$value.'</td>';
                                                                }
                                                                
                                                                
                                                            }
                                                           
                                                        }
                                                    ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                                <thead>
                                                    <tr>
                                                        <th>Trimestre 1</th>
                                                        <th>Trimestre 2</th>
                                                        <th>Trimestre 3</th>
                                                        <th>Trimestre 4</th>
                                                        <th>Semestre 1</th>
                                                        <th>Semestre 2</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Trimestre 1</th>
                                                        <th>Trimestre 2</th>
                                                        <th>Trimestre 3</th>
                                                        <th>Trimestre 4</th>
                                                        <th>Semestre 1</th>
                                                        <th>Semestre 2</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                        $compta = new Comptabilite();
                                                        $Trimestre = $compta->TrimestreSemestre();

                                                        foreach ($Trimestre as $key => $value) {
                                                            echo '<td>'.$value.'</td>';
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div> 
                                        </div> 
                                    </div>
                                    <hr> 
                                
                            </div>

                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Journal des Vents</h6>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                                <thead>
                                                    <tr>
                                                        <th>Janvier</th>
                                                        <th>Fevrier</th>
                                                        <th>Mars</th>
                                                        <th>Avril</th>
                                                        <th>Mai</th>
                                                        <th>Jun</th>
                                                        <th>Juillet</th>
                                                        <th>Aout</th>
                                                        <th>Septembre</th>
                                                        <th>Octobre</th>
                                                        <th>Novembre</th>
                                                        <th>Decembre</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Janvier</th>
                                                        <th>Fevrier</th>
                                                        <th>Mars</th>
                                                        <th>Avril</th>
                                                        <th>Mai</th>
                                                        <th>Jun</th>
                                                        <th>Juillet</th>
                                                        <th>Aout</th>
                                                        <th>Septembre</th>
                                                        <th>Octobre</th>
                                                        <th>Novembre</th>
                                                        <th>Decembre</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <tr>
                                                    <?php 
                                                        require_once("../bdmutilple/comptabilite.php");
                                                        $compta = new Comptabilite();
                                                        $somme = $compta->VentesAnuelle();
                                                        
                                                        foreach ($somme as $key=> $element) {
                                                            foreach ($element as $ke => $value) {
                                                                if (empty($value)) {
                                                                    echo '<td>0</td>';
                                                                } else {
                                                                    echo '<td>'.$value.'</td>';
                                                                }
                                                                
                                                                
                                                            }
                                                           
                                                        }
                                                    ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                                <thead>
                                                    <tr>
                                                        <th>Trimestre 1</th>
                                                        <th>Trimestre 2</th>
                                                        <th>Trimestre 3</th>
                                                        <th>Trimestre 4</th>
                                                        <th>Semestre 1</th>
                                                        <th>Semestre 2</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Trimestre 1</th>
                                                        <th>Trimestre 2</th>
                                                        <th>Trimestre 3</th>
                                                        <th>Trimestre 4</th>
                                                        <th>Semestre 1</th>
                                                        <th>Semestre 2</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                        $compta = new Comptabilite();
                                                        $Trimestre = $compta->TrimestreSemestreVente();

                                                        foreach ($Trimestre as $key => $value) {
                                                            echo '<td>'.$value.'</td>';
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <hr>
                                </div>
                            </div>

                            <!--<div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Etude Evolutive</h6>
                                    <div class="row">
                            
                                        <p class="col-md-5 btn btn-user btn-block">
                                           Entrez le numero du moi <input type="number" name="nombre3" id="nombre3" value="1"> 
                                        </p>
                                        <p class="col-md-2" >
                                            Analyse Evolutive :<input type="checkbox" name="Evolution" id="Evolution" class="btn btn-primary btn-user btn-block" onclick="EtudeEvolutive()">
                                        </p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <div class="card shadow mb-1">
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Valeur du moi N</h6>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            Montant du moi N :
                                                            <span id="montant1"> </span>
                                                        </div>

                                                        <div class="col-lg-5">
                                                            Nombre client du moi N :
                                                            <span id="client1"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="card shadow mb-1">
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Valeur du moi N+1</h6>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            Montant du moi N :
                                                            <span id="montant2"> </span>
                                                        </div>

                                                        <div class="col-lg-5">
                                                            Nombre client du moi N :
                                                            <span id="client2"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="card shadow mb-1">
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Calcule Generale Moi</h6>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            Total en FCFA:
                                                            <span id="Total"> </span>
                                                        </div>

                                                        <div class="col-lg-5">
                                                            Total en % :
                                                            <span id="Poucentage"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="card shadow mb-1">
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Calcule Generale Client</h6>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            Total en Client:
                                                            <span id="Totalclient"> </span>
                                                        </div>

                                                        <div class="col-lg-5">
                                                            Total en % :
                                                            <span id="Poucentageclient"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <hr>
                                    
                                    <code>Evolution</code>.
                                </div>
                            </div>-->

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
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../header.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>

</body>

</html>