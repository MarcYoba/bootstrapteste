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

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Modifier le stock</h1>
                             </div>
                           
                                <div class="form-group">
                                
                                <hr>
                                    <h6 >La modification du stock est une activité cruciale. Car elle crée un nouvel historique en écrasant l’ancien historique du produit. La modification du stock initial impactera directement le stock réel. Memorise ou note l’ancien stock initial parce qu’en cas de problème, vous pouvez le remettre en place.  </h6>
                                    <form class="user" action="../stock/register.php" method="post">
                                        <hr>
                                        <div class="form-group row">
                                        <div class="col-sm-3">
                                        <input type="text" id="recherche" onkeyup="myFunction()" class="form-control form-control-user" placeholder="recherche produit"><br>
                                        </div>
                                            <div class="col-sm-3">
                                                <select id="nomProduit"  name="nomProduit"  class="form-control form-select" required size="4" multiple aria-label="multiple select ">
                                                    <option selected></option>
                                                    <?php 
                                                         require_once("../connexion.php"); 
                                                        global $conn;
                                                        $sql = "SELECT  nom_produit FROM produit";
                                                        $result = $conn->query($sql);
                                                            while ($row = mysqli_fetch_assoc($result)){             
                                                                echo "<option value='".$row["nom_produit"]."'>".$row["nom_produit"]."</option>";
                                                            }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                    <input type="number" class="form-control form-control-user"
                                                    name="quantite" id="quantite" placeholder="quantite" required><br>
                                                    <button type="submit" name="enregistrer" id="" class="btn btn-warning btn-user btn-block">
                                                    Modifeir le stock initiale
                                                    </button> 
                                                
                                            </div>
                                        </div>
                                        <hr>
                                        <hr>  
                                    </form>
                            
                            <hr>
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
    <script src="stockVente.js"></script>
</body>

</html>