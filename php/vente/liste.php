<?php 
require_once("../connexion.php"); 
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
                    <h1 class="h3 mb-2 text-gray-800">Liste vente</h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
                            <div class="form-group row">
                                <div class="col-sm-6">
                                <h6 class="m-0 font-weight-bold text-primary">Liste des ventes</h6>
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-home"></i>
                                    <a href="../../home.php" class="btn btn-primary">Home</a> 
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-plus"></i> 
                                    <a href="vente.php" class="btn btn-success"> Ajouter</a>
                                    
                                </div>
                                <!--<div class="btn btn-warning"><i class="fa fa-arrow-left"></i> Retour</div>  -->  
                            </div>
                            
                            <form  action="../pdf/getTypeVente.php" method="post" class="user row" >

                                <p class="col-md-6">
                                <label class="form-check-label" id="nomProduit">Produit</label>
                                <input type="search" id="produitrecher" onkeyup="recherchduproduit()"  class="form-control" placeholder="récherché produit">
                                    <select id="nomProduite"  name="nomProduit"  class="form-control form-select" size="4" multiple aria-label="multiple select">
                                        <option value="ALL" selected>ALL</option>
                                            <?php 
                                                global $conn;
                                                $sql = "SELECT  nom_produit,cathegorie FROM produit";
                                                $result = $conn->query($sql);
                                                while ($row = mysqli_fetch_assoc($result)){               
                                                    echo "<option value='".$row["nom_produit"]."'>".$row["nom_produit"]."</option>";
                                                }
                                            ?>
                                    </select>
                                </p>
                                <p class="col-md-6">
                                    <br>
                                    <input type="search" id="clientrecher" onkeyup="recherchduclient()"  class="form-control" placeholder="récherché client">
                                    <select id="clientt"  name="client"   class="form-control form-select" size="4" multiple aria-label="multiple select">   <!-- size="10" multiple aria-label="multiple select " -->
                                    <option value="ALL" selected>ALL</option>             
                                        <?php 
                                            global $conn;
                                            $sql = "SELECT id, firstname, adresse FROM client";
                                            $result = $conn->query($sql);
                                                while ($row = mysqli_fetch_assoc($result)){     
                                                    echo "<option value='".$row["id"]."'>".$row["firstname"]."</option>";       
                                                                            //var_dump($row);
                                                }
                                        ?> 
                                    </select>
                                    <label class="form-check-label" id="client">Cleint</label>
                                </p>
                                <p class="col-md-2"> 
                                        <input class="form-check-input" type="checkbox" id="OM" name="OM" value="OM">
                                        <label class="form-check-label" id="OM">OM</label>
                                        <br><br><br>
                                        <input class="form-check-input" type="checkbox" id="facture" name="facture" value="facture">
                                        <label class="form-check-label" id="facture">Facture</label>
                                </p>
                                <p class="col-md-2">
                                        <input class="form-check-input" type="checkbox" id="credit" name="credit" value="credit">
                                        <label class="form-check-label" id="credit">Crédit</label>
                                        <br><br><br>
                                        <input class="form-check-input" type="checkbox" id="quantite" name="quantite" value="quantite">
                                        <label class="form-check-label" id="quantite">Qauntité</label>
                                </p>
                                <p class="col-md-2">
                                        <input class="form-check-input" type="checkbox" id="cash" name="cash" value="cash">
                                        <label class="form-check-label" id="cash">Cash</label>
                                </p>
                                <p class="col-md-2">
                                        <input class="form-control form-control-user" type="date" id="date" name="date" require><br>
                                        <input class="form-control form-control-user" type="date" id="date2" name="date2" require>     
                                </p>
                                <p class="col-md-2">
                                    <input type="submit" class="btn btn-warning btn-user"  value="Afficher" >  
                                </p>
                                <div class="col-md-2">
                                    <label for="annee">Année rècherché :</label>
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
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='70' data-order='[[0, "desc"]]'>
                                    <thead>
                                       
                                        <tr>
                                            <th>id</th>
                                            <th>Client</th>
                                            <th>Type paiement </th>
                                            <th>Numero facture</th>
                                            <th>Quantité total</th>
                                            <th>P.Total</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th>Opération</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Client</th>
                                            <th>Nom</th>
                                            <th>Numero facture</th>
                                            <th>Quantité total</th>
                                            <th>P.Total</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                            <th>Opération</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="liste">
                                    <?php 
                                        global $conn;
                                        if (isset($_GET['date'])) {
                                            $date = $_GET["date"];
                                        } else {
                                            $date = date("Y");
                                        }
                                        $sql = "SELECT * FROM vente WHERE YEAR(datevente) = '$date'";
                                        $result = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)){
                                            echo '<tr>';
                                            echo '<th>'.$row["id"].'</th>';
                                            $client = $row["idclient"];
                                            $sqlclient = "SELECT firstname FROM client WHERE id= '$client'";
                                            $resultclient = $conn->query($sqlclient);
                                            $rowclient = mysqli_fetch_assoc($resultclient);
                                            echo '<th>'.$rowclient["firstname"].'</th>';
                                            echo '<th>'.$row["typevente"].'</th>';
                                            echo '<th>'.$row["id"].'</th>';
                                            echo '<th>'.$row["quantite"].'</th>';
                                            echo '<th>'.$row["prix"].'</th>';
                                            echo '<th>'.$row["statusvente"].'</th>';
                                            echo '<th>'.$row["datevente"].'</th>';
                                            echo '<th>';
                                            echo "<a href='facture.php?id=" . $row["id"] . "' class='btn btn-primary'><i class='fa fa-bars'></i></a>";
                                            echo'</th>';
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
    <script src="../../header.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>
   <script src="listeVente.js"></script>
    <script>
        function reload() {
            var annee = document.getElementById("annee").value;
            window.location.href = "liste.php?date=" + annee;
        }
    </script>
</body>

</html>