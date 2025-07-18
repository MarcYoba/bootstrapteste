<?php require_once("../connexion.php"); 
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
                <?php require_once("../../Topbar.php");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Quantité en Stock</h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <div class="form-group row">
                                <div class="col-sm-6">
                                <h6 class="m-0 font-weight-bold text-success">Quantité en Stock</h6>
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-home"></i>
                                    <a href="../../home.php" class="btn btn-success">Home</a> 
                                </div>
                                <div class="col-sm-2">
                                    <label for="annee">récherché par Année </label>
                                    <select class="form-control" id="annee" onchange="reload()">
                                        <?php 
                                            $currentYear = date("Y");
                                            $currentYear += 10;
                                            for ($i = 2022; $i <= $currentYear; $i++) {
                                                echo "<option value='$i' ".($i == $currentYear ? "selected" : "").">$i</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <span id="quantitetotale" onclick="QuantiteTotal()" class="btn btn-success"> Calculer Quantité Totale</span>
                                </div>
                                <!--<div class="btn btn-warning"><i class="fa fa-arrow-left"></i> Retour</div>  -->  
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                    <thead>
                                       
                                        <tr>
                                            <th> Nom produit</th>
                                            <th>Stock du (02/01/<?php echo $_GET["date"]; ?>)</th>
                                            <th>Quantité Achetée</th>
                                            <th>Quantité Facturée</th>
                                            <th>Quantité en Stock</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th> Nom produit</th>
                                            <th>Stock du (02/01/<?php echo $_GET["date"]; ?>)</th>
                                            <th>Quantité Achetée</th>
                                            <th>Quantité Facturée</th>
                                            <th>Quantité en Stock</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        global $conn;
                                        if (isset($_GET['date'])) {
                                            $date = $_GET["date"];
                                        } else {
                                            $date = date("Y");
                                        }
                                        $total = 0;
                                        $date_debut = $date . "-01-02";
                                        $sql = "SELECT nom_produit,id  FROM produitphamacie ";
                                        $result = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)){
                                            $id = $row["id"];
                                            $sql2 = "SELECT quantite FROM historiquestockphamacie WHERE datet = '$date_debut' AND idproduit = '$id'";
                                            $result2 = $conn->query($sql2);
                                            $historique = mysqli_fetch_assoc($result2);

                                            if (empty($historique)) {
                                                $historique = 0;
                                            } else {
                                                $historique = $historique["quantite"];
                                            }

                                            $sql3 = "SELECT ROUND(SUM(quantite), 2) as total FROM achatphamacie WHERE  idproduit  = '$id' AND YEAR(dateachat) = '$date'";
                                            $result3 = $conn->query($sql3);
                                            $achat = mysqli_fetch_assoc($result3);

                                            if (empty($achat)) {
                                                $achat = 0;
                                            } else {
                                                $achat = $achat["total"];
                                            }

                                            $sql3 = "SELECT ROUND(SUM(quantite), 2) as total FROM facturephamacie WHERE  idproduit  = '$id' AND YEAR(datefacture) = '$date'";
                                            $result3 = $conn->query($sql3);
                                            $facture = mysqli_fetch_assoc($result3);

                                            if (empty($facture)) {
                                                $facture = 0;
                                            } else {
                                                $facture = $facture["total"];
                                            }

                                            echo '<tr>';
                                            echo '<td>'.$row["nom_produit"].'</td>';
                                            echo '<td>'.$historique.'</td>';
                                            echo '<td>'.$achat.'</td>';
                                            echo '<td>'.$facture.'</td>';
                                            echo '<td style="color: '.($historique + $achat - $facture <= 0 ? 'red' : 'green').'">'.$historique + $achat - $facture.'</td>';
                                            echo '</tr>';
                                            $total += $historique + $achat - $facture;
                                        }
                                        
                                    ?>
                                    </tbody>
                                </table>
                                <span style="font-weight: bold;" class="btn btn-primary" id="total" > Quantite Total : <?php echo $total ?></span>
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
    <script src="achat.js"></script>
    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>
    <script>
        function reload() {
            var annee = document.getElementById("annee").value;
            window.location.href = "quantiteStock.php?date=" + annee;
        }
        function QuantiteTotal(){
            var total = document.getElementById("total").innerText;
            document.getElementById("quantitetotale").innerHTML = '<span style="font-weight: bold;" class="btn btn-primary" id="total" > ' + total + '</span>';
        }
    </script>

</body>

</html>