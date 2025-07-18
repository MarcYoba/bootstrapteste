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
                    <h1 class="h3 mb-2 text-gray-800">Achat</h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <div class="form-group row">
                                <div class="col-sm-6">
                                <h6 class="m-0 font-weight-bold text-primary">Liste des Achats</h6>
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-home"></i>
                                    <a href="../../home.php" class="btn btn-primary">Home</a> 
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-plus"></i> 
                                    <a href="teste.php" class="btn btn-success"> Ajouter</a>
                                    
                                </div>
                                <!--<div class="btn btn-warning"><i class="fa fa-arrow-left"></i> Retour</div>  -->  
                            </div>

                            
                            <form  action="../pdf/getvaleurachete.php" method="post" class="user row" >
                                <div class="row">
                                    <p class="col-md-2" >
                                        <input type="date" class="form-control form-control-user"
                                        name="datedette" id="datedette" placeholder="quantité">
                                    </p>
                                    <p class="col-md-2" >
                                        <input type="date" class="form-control form-control-user"
                                        name="datedett2" id="datedett2" placeholder="quantité">
                                    </p>
                                    <p class="col-md-3" >
                                    <input type="text" class="form-control form-control-user" id="produitname"
                                        name="produitname" placeholder="Nom produit" onkeyup="recherproduit()" required> 
                                    <select id="produit"  name="produit"   class="form-control form-select" size="4" multiple aria-label="multiple select">   <!--  -->
                                        <option value="ALL" selected>ALL</option>             
                                            <?php 
                                                global $conn;
                                                $sql = "SELECT  nom_produit,cathegorie FROM produit ORDER BY nom_produit ASC";
                                                $result = $conn->query($sql);
                                                while ($row = mysqli_fetch_assoc($result)){               
                                                    echo "<option value='".$row["nom_produit"]."'>".$row["nom_produit"]."</option>";
                                                }
                                            ?>  
                                    </select>
                                    </p>

                                    <p class="col-md-2" >
                                        <input type="submit" class="btn btn-warning btn-user"  value="Afficher" >  
                                    </p>
                                    <p class="col-md-3" >
                                        <a href="../bond/bon.php" class="btn btn-info btn-user">
                                            Bon de Commande
                                    </a><br>
                                    <label for="annee">Année récherché</label>
                                    <select class="form-control" id="annee" name="annee" onchange="reload()">
                                        <?php
                                        $currentYear = date('Y');
                                        $currentYear += 10;
                                        echo "<option >Recherche a</option>";
                                        for ($year = 2022; $year <= $currentYear; $year++) {
                                            echo "<option value=\"$year\">$year</option>";
                                        }
                                        ?>
                                    </select>
                                    </p> 
                                     
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                    <thead>
                                       
                                        <tr>
                                            <th>id</th>
                                            <th>Nom</th>
                                            <th>Quantité</th>
                                            <th>P.Total</th>
                                            <th>Date</th>
                                            <th>Opération</th>
                                            <th>Bon</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Nom</th>
                                            <th>Quantité</th>
                                            <th>P.Total</th>
                                            <th>Date</th>
                                            <th>Opération</th>
                                            <th>Bon</th>
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
                                        $sql = "SELECT * FROM achat WHERE YEAR(dateachat) = '$date'";
                                        $result = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)){
                                            echo '<tr>';
                                            echo '<td>'.$row["id"].'</td>';
                                            echo '<td>'.$row["Nomproduit"].'</td>';
                                            //echo '<td>'.$row["prixAcaht"].'</td>';
                                            echo '<td>'.$row["quantite"].'</td>';
                                            echo '<td>'.$row["montant"].'</td>';
                                            echo '<td>'.$row["dateachat"].'</td>';
                                            if (($_SESSION['roles'] == "Lecture") || ($_SESSION['roles'] == "Ecriture")) {
                                                echo '<td></td>';
                                                echo "<td><a href='../bond/liste.php?date=" .$row["dateachat"]. "' class='btn btn-primary' id='modification'><i class='far fa-file-image'></i></a>";
                                            }else if(($_SESSION['roles'] == "semiadmin")){
                                                echo "<td><a href='modifie.php?id=" .$row["id"]. "' class='btn btn-primary' id='modification'><i class='fas fa-pencil-alt '></i></a>";
                                                echo "<td><a href='../bond/liste.php?date=" .$row["dateachat"]. "' class='btn btn-primary' id='modification'><i class='far fa-file-image'></i></a>";

                                            }else{
                                                echo "<td><a href='modifie.php?id=" .$row["id"]. "' class='btn btn-primary' id='modification'><i class='fas fa-pencil-alt '></i></a>";
                                                echo "<a href='edite.php?delete=" .$row["id"]. "' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet Achat ? si vous suprimer cet achat elle sera supprimer du stock\");' id='suppresioner'><i class='fas fa-trash-alt'></i></a></td>";
                                                echo "<td><a href='../bond/liste.php?date=" .$row["dateachat"]. "' class='btn btn-primary' id='modification'><i class='far fa-file-image'></i></a>";
                                            }
                                            
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
    <script src="achat.js"></script>
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