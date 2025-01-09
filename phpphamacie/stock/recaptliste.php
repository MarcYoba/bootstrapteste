<?php 
    require_once("../connexion.php");
    require_once("../bdmutilple/getstock.php");
    require_once("../bdmutilple/getfacture.php");
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
                <?php  require_once("../../Topbar.php");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">RECAPITULATIF  GENERALE</h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                    <h6 class="m-0 font-weight-bold text-primary">RECAPITULATIF GENERALE</h6>
                            </div>
                            <br>
                            <form class="user" action="../pdf/Recapitulatif.php" method="post">
                            <div class="row">
                                <p class="col-md-2" >
                                        <input type="date" class="form-control form-control-user"
                                        name="datedebut" id="datedebut" placeholder="quantite" require>
                                    </p>
                                    <p class="col-md-2" >
                                        <input type="date" class="form-control form-control-user"
                                        name="datefin" id="datefin" placeholder="quantite" require>
                                    </p>
                                <p class="col-md-3">
                                <input type="text" id="recherche" onkeyup="myFunction()" class="form-control form-control-user" placeholder="recherche produit"><br>
                                </p>
                                <p class="col-md-3"> 
                                    
                                    <select id="nomProduit"  name="nomProduit"  class="form-control form-select" size="4" multiple aria-label="multiple select ">
                                        <?php 
                                            global $conn;
                                            $sql = "SELECT  nom_produit,cathegorie FROM produitphamacie";
                                            $result = $conn->query($sql);
                                            while ($row = mysqli_fetch_assoc($result)){               
                                                echo "<option value='".$row["nom_produit"]."'>".$row["nom_produit"]."</option>";
                                            }
                                        ?>
                                    </select>
                                </p>
               
                                <p class="col-md-2">
                                    <button class='btn btn-info btn-user'>Imprimer</button>
                                </p>
                            </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='80' data-order='[[0, "desc"]]'>
                                    <thead>  
                                        <tr>
                                            <th>Produit</th>
                                            <th>Stock Initial KG</th>
                                            <th>Som Achat KG</th>
                                            <th>Total KG</th>
                                            <th>vente du jour KG</th>
                                            <th>Total Vente KG</th>
                                            <th>Stock REEL KG</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Produit</th>
                                            <th>Stock Initial KG</th>
                                            <th>Som Achat KG</th>
                                            <th>Total KG</th>
                                            <th>vente du Jour KG</th>
                                            <th>Total Vente KG</th>
                                            <th>Stock REEL KG</th>
                                            <th>Date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="liste">
                                    <?php 
                                        global $conn;
                                        $stock = new Stock(1,1,1);
                                        $facture = new Facture(1);
                                        $date =  date("Y-m-d");
                                        // $sqlp = "SELECT  id,nom_produit,cathegorie FROM produit"; 
                                        // $resultp = $conn->query($sqlp);
                                        // while ($rowt = mysqli_fetch_assoc($resultp)){ 
                                        //     var_dump($facture->setIdFacture($rowt["nom_produit"]." ".$rowt["cathegorie"] ,$rowt["id"]));
                                        // }
                                        $variable = $stock->getLogsDate();
                                        foreach ($variable as $key => $value) {
                                            echo '<tr>';
                                            echo '<th>'.$value["Nomproduit"].'</th>';
                                            echo '<th>'.round($value["stock_start_produit"],2).'</th>';
                                            echo '<th>'.$value["quantite_achetee"].'</th>';
                                            echo '<th>'.round($value["quantite_stock"],2) + $value["quantite_achetee"].'</th>';
                                            if (empty($value["quantite_facturee"])) {
                                                echo '<th>'.$value["quantite_facturee"].'</th>'; 
                                            } else {
                                                echo '<th>'.round($value["quantite_facturee"],2).'</th>'; 
                                            }
                                            if (empty($value["somme_facture"])) {
                                                echo '<th>'.$value["somme_facture"].'</th>'; 
                                            } else {
                                                echo '<th>'.round($value["somme_facture"],2).'</th>'; 
                                            } 
                                            echo '<th>'.$value["quantite_produit"].'</th>';
                                            echo '<th>'.$date.'</th>';
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

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../header.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>
    <script src="../stock/stockVente.js"></script>

</body>

</html>