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
        <?php require_once("../../headerProvenderi.php"); ?>
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
                    <h1 class="h3 mb-2 text-gray-800">Prix d'achat par produits</h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <div class="form-group row">
                                <div class="col-sm-6">
                                <h6 class="m-0 font-weight-bold text-primary">Prix d'achat par produits</h6>
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-home"></i>
                                    <a href="../../home.php" class="btn btn-primary">Home</a> 
                                </div>
                                <div class="col-sm-2">
                                    <label for="annee">Année récherché</label>
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
                                    <span id="prixtotale" onclick="QuantiteTotal()" class="btn btn-warning"> Calculer prix Totale</span>
                                </div>   
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                    <thead>
                                       
                                        <tr>
                                            <th>Nom produit</th>
                                            <th>Quantité Total achatée</th>
                                            <th>Prix Total achaté </th>
                                            <th>Prix global d'achat</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nom produit</th>
                                            <th>Quantité Total achatée</th>
                                            <th>Prix Total achaté </th>
                                            <th>Prix global d'achat</th>
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
                                        $sql = "SELECT ROUND(SUM(quantite),2) as quantite,ROUND(SUM(montant),2) as montant,Nomproduit  FROM achat WHERE YEAR(dateachat) = '$date' GROUP BY Nomproduit";
                                        $result = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)){
                                            echo '<tr>';
                                            echo '<td>'.$row["Nomproduit"].'</td>';
                                            echo '<td>'.$row["quantite"].'</td>';
                                            echo '<td>'.$row["montant"].'</td>';
                                            echo '<td>'.number_format($row["montant"] / $row["quantite"], 2).'</td>';
                                            echo '</tr>';
                                            $total += number_format($row["montant"] / $row["quantite"], 2);
                                        }
                                    ?>
                                    </tbody>
                                </table>
                                <span style="font-weight: bold;" class="btn btn-primary" id="total" > Prix Total : <?php echo $total ?></span>
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
                        <span>Production &copy;   <?php echo date("Y-m-d") ?></span>
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
            window.location.href = "prixachat.php?date=" + annee;
        }
        function QuantiteTotal(){
            var total = document.getElementById("total").innerText;
            document.getElementById("prixtotale").innerHTML = '<span style="font-weight: bold;" class="btn btn-primary" id="total" > ' + total + '</span>';
        }
    </script>

</body>

</html>