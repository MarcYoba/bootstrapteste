<?php require_once("../connexion.php"); ?>
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
    <style>
        .drop{
            display: none;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container" >
        
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                        <div class="card-header py-3">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Création du Prospection</h6>
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-home"></i>
                                        <a href="../../home.php" class="btn btn-primary">Home</a> 
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-list"></i> 
                                    <a href="liste.php" class="btn btn-success"> Liste</a>              
                                </div>
                                            <!--<div class="btn btn-warning"><i class="fa fa-arrow-left"></i> Retour</div>  -->  
                            </div>
                        </div><br>
                            <form class="user" action="register.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row ">
                                    <br>
                                    <div class="col-sm-1 mb-3 mb-sm-0">
                                    Porspection Id:
                                        <input type="text" class="form-control form-control-user drop" id="reference"
                                        name="reference" required readonly>     
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="file" class="form-control form-control-user" id="image"
                                            name="image" placeholder="latitude GPS" accept="image/*">
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="date" class="form-control form-control-user" id="dateprospection"
                                            name="dateprospection" placeholder="Date de prospection" required>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        <span id="buttonenregistrement" >
                                            <button type="image" name="image" id="image"  class="btn btn-primary ">
                                                Enregistrement
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                    
                            </form>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" data-page-length='25' data-order='[[0, "desc"]]'>
                                        <thead>
                                            <tr>
                                                <th>image</th>
                                                <th>image</th>
                                                <th>image</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>image</th>
                                                <th>image</th>
                                                <th>image</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php 
                                            global $conn;
                                            $sql = "SELECT * FROM imageprospection ORDER BY id DESC";
                                            $result = $conn->query($sql);
                                            while ($row = mysqli_fetch_assoc($result)){
                                                // Afficher 3 images par ligne
                                                static $col = 0;
                                                if ($col % 3 == 0) {
                                                    echo "<tr>";
                                                }
                                                echo "<td>";
                                                echo "<div class='card' style='width: 220px;'>";
                                                echo "" . str_replace("../../uploads/", "", $row["image"]) . "<br>";
                                                echo "<img src='" . $row["image"] . "' alt='Image' class='card-img-top' style='width: 200px; height: 200px; object-fit: cover; margin: 10px auto;'>";
                                                echo "<div class='card-body p-2 text-center'>";
                                                echo "<a href='deleteimage.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm mb-1' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet image ?\");'><i class='fas fa-trash-alt'></i></a>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</td>";
                                                $col++;
                                                if ($col % 3 == 0) {
                                                    echo "</tr>";
                                                }
                                                //var_dump($row);
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
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
    <!-- <script src="../../header.js"></script>-->
    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>
    <script src="prospection.js"></script>

</body>

</html>