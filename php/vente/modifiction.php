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

    <title>GESTION DE STOCK</title>

    <!-- Custom fonts for this template -->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="../../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                    <h1 class="h3 mb-2 text-gray-800">Modification facture : <?php 
                    if (isset($_GET["id"])) {
                        echo $_GET["id"];
                    } else {
                        echo $_GET["edite"];
                    }
                    
                    
                    
                    ?> </h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3"> 
                                <div class="row">
                                    <p class="col-md-0"><h6 class="m-0 font-weight-bold text-primary">facture</h6></p>
                                    <p class="col-md-0"> </p>;
                                    <form method="post" action="editefacture.php">
                                    <?php
                                    $id = 0;
                                    if (isset($_GET["id"])) {
                                        echo $_GET["id"];
                                        $id = $_GET["id"];
                                    } else {
                                        echo $_GET["edite"];
                                        $id = $_GET["edite"];
                                    }
                                        // $client = new Client(1);
                                        // $value = $client->getClientByIdVente($_GET["id"]);
                                        echo ' <p class="col-md-8"><input type="search" id="recherche" onkeyup="myFunction()"  class="form-control form-control-user" placeholder="recherche"><br>
                                        <input type="search" id="idvente" name="idvente"  class="form-control form-control-user" placeholder="recherche" value="'.$id.'" readonly>
                                        </p>';
                                        echo ' <p class="col-md-8"><select id="fournisseur"  name="fournisseur"   class="form-control form-select"  size="5" multiple aria-label="multiple select "required>';
                                                            global $conn;
                                                            $sql = "SELECT id, firstname, adresse FROM client";
                                                            $result = $conn->query($sql);
                                                            while ($row = mysqli_fetch_assoc($result)){     
                                                                echo "<option value='".$row["firstname"]."'>".$row["firstname"]."</option>";       
                                                                            //var_dump($row);
                                                            }
                                                        
                                        echo ' </p></select>';
                                    
                                    
                                     
                                    if (($_SESSION['roles'] == "Lecture") || ($_SESSION['roles'] == "Ecriture")) {
                                        # code...
                                    }else if(($_SESSION['roles'] == "semiadmin")){
                                        echo "<p class='col-md-1 '> <buttom  class='btn btn-warning btn-user' onclick='editefacture()'>Edite</buttom></p>";
                                    }else{  
                                    
                                    echo "<p class='col-md-2 '><button  class='btn btn-secondary btn-user'>changer client</button></p>";
                                    }
                                      

                                    ?>
                                </form>
                                </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <!---  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                        <tr>
                                            <th>id</th>
                                            <th>Nom</th>
                                            <th>quantite</th>
                                            <th>prix</th>
                                            <th>montant</th>
                                            <th>Typepaiement</th>
                                        </tr>
                                        
                                    </tfoot>
                                    <tbody>
                                    
                                    </tbody>
                                </table>--->
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

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>
    <script src="listeVente.js"></script>
    <script src="../../header.js"></script>

</body>

</html>