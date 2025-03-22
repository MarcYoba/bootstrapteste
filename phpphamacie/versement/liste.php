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
                 <?php require_once("../../Topbar.php");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Versement</h1>
                    <p class="mb-4">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                
                                <div class="col-md-10">
                                    <form method="post" action="../pdf/getversement.php">
                                    <div class="col-md-0">
                                        <h6 class="m-0 font-weight-bold text-primary">Tables Versement</h6>
                                    </div>
                                    <div class="form-group row">
                                    <div class="col-md-2" >
                                        <input type="date" class="form-control form-control-user"
                                            name="date1" id="date1" placeholder="quantite">
                                    </div>
                                    <div class="col-md-2" >
                                        <input type="date" class="form-control form-control-user"
                                            name="date2" id="date2" placeholder="quantite">
                                    </div>
                                        
                                    <div class="col-md-3" >
                                        <input type="search" id="recherche" onkeyup="recherduclient()"  class="form-control form-control-user" placeholder="recherche"><br>
                                        <select id="client"  name="client"   class="form-control form-select" size="4" multiple aria-label="multiple select">   <!--  -->
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
                                    </div>
                                    
                                    <div class="col-md-1" >
                                        <a href="../versement/liste.php"  class="btn btn-info btn-user" >Liste</a>
                                    </div>

                                    
                                    <div class="col-md-3" >
                                    <input type="submit" class="btn btn-warning btn-user"  value="Affichier" >  
                                    </div>
                                    </div>
                                    <div class="col-md-2" >
                                        <label for="annee">Année recherche</label>
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
                                <div class="col-md-2">
                                <br>
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
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                    <thead>
                                       
                                        <tr>
                                            <th>id</th>
                                            <th>montant</th>
                                            <th>client</th>
                                            
                                            <th>date versement</th>
                                            <th>operation</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>montant</th>
                                            <th>client</th>
                                            
                                            <th>date versement</th>
                                            <th>operation</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        global $conn;
                                        $date = date("Y-m-d");
                                        if (isset($_GET['date'])) {
                                            $date = $_GET['date'];
                                        } else {
                                            $date = date("Y");
                                        }
                                        $sql = "SELECT * FROM versementphamacie WHERE YEAR(dateversement) = '$date'";
                                        $result = $conn->query($sql);
                                        while ($row = mysqli_fetch_assoc($result)){
                                            $montant = $row["montant"] +$row["Om"]+$row["banque"];
                                            echo '<tr>';
                                            echo '<td>'.$row["id"].'</td>';
                                            echo '<td>'.$montant.'</td>';
                                            $idclient = $row["idclient"];
                                            $sqlclient = "SELECT firstname FROM client WHERE id = '$idclient'";
                                            $value = $conn->query($sqlclient);
                                            $nom = mysqli_fetch_assoc($value);

                                            echo '<td>'.$nom["firstname"].'</td>';
                                            
                                            echo '<td>'.$row["dateversement"].'</td>';
                                            echo "<td>";
                                            if (($_SESSION['roles'] == "Lecture") || ($_SESSION['roles'] == "Ecriture")) {
                                                echo "<a href='imprimer.php?id=" . $row["id"] . "' class='btn btn-warning'><i class='fas fa-print'></i></a>";
                                            }elseif ($_SESSION['roles'] == "semiadmin"){
                                                echo "<a href='edite.php?id=" . $row["id"] . "' class='btn btn-primary'><i class='fas fa-pencil-alt'></i></a>";
                                                echo "<a href='imprimer.php?id=" . $row["id"] . "' class='btn btn-warning'><i class='fas fa-print'></i></a>";
                                            }else{
                                            echo "<a href='edite.php?id=" . $row["id"] . "' class='btn btn-primary'><i class='fas fa-pencil-alt'></i></a>";
                                            echo "<a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette vente ?\");'><i class='fas fa-trash-alt'></i></a>";
                                            echo "<a href='imprimer.php?id=" . $row["id"] . "' class='btn btn-warning'><i class='fas fa-print'></i></a>";
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
                        <span>Copyright &copy; Your Website 2020</span>
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

        function recherduclient() {
        // Récupérer l'input et la liste déroulante
        var input, filter, ul, li, a, i;
        input = document.getElementById("recherche");
        filter = input.value.toUpperCase();
        ul = document.getElementById("client");
        li = ul.getElementsByTagName("option");
        console.log(li.length);
        // Boucler sur toutes les options
        for (i = 0; i < li.length; i++) {
            a = li[i];
            
            if (a.textContent.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
            } else {
            li[i].style.display = "none";
            }
        }
        
        }
    </script>

</body>

</html>