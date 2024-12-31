<?php
     require_once("../connexion.php"); 
     require_once("../bdmutilple/getachat.php");
     require_once("../bdmutilple/getproduit.php");
     $achat = new Achat(1);
     if (isset($_GET['id'])) {
        $tableau =($achat->getAchatById($_GET['id']));

    $tableau = array_shift($tableau);
    echo '<p id="nom" class="drop">'.$tableau["Nomproduit"].'</p>';
    echo '<p id="qt" class="drop">'.$tableau["quantite"].'</p>';
    echo '<p id="id" class="drop">'.$tableau["id"].'</p>';
    echo '<p id="fourni" class="drop">'.$tableau["idfournisseur"].'</p>';
    echo '<p id="pri" class="drop">'.$tableau["prixAcaht"].'</p>';
    
     } 
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

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="form-group row">
                                    <div class="col-sm-10 ">
                                    <h6 class="m-0 font-weight-bold text-primary">Modifier Achat</h6>
                                    </div>
                                    <div class="col-sm-2 ">
                                    <a class="m-0 font-weight-bold text-warning" href="../achat/liste.php">Retour</a>
                                    </div>
                            </div>
                           
                                <div class="form-group">
                                
                                <hr>
                                    <form class="user" action="edite.php" method="post">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <p>Fournisseur</p>
                                                <select id="fournisseur"  name="fournisseur"  class="form-control form-select"  required size="4" multiple aria-label="multiple select">
                                                    <option selected> </option>
                                                    <?php 
                                                    global $conn;
                                                    $sql = "SELECT id, nom FROM fournisseur";
                                                    $result = $conn->query($sql);
                                                        while ($row = mysqli_fetch_assoc($result)){
                                                            echo "<option value='".$row["id"]."'>".$row["nom"]."</option>";
                                                                                //var_dump($row);
                                                        }
                                                        ?> 
                                                </select>  
                                            </div>

                                            <div class="col-sm-3">
                                                <p> Produit</p>
                                                <select id="nomProduit"  name="nomProduit"  class="form-control form-select" required size="6" multiple aria-label="multiple select ">
                                                    <option selected>foutniseur</option>
                                                    <?php 
                                                        global $conn;
                                                        $sql = "SELECT  nom_produit FROM produit";
                                                        $result = $conn->query($sql);
                                                            while ($row = mysqli_fetch_assoc($result)){             
                                                                echo "<option value='".$row["nom_produit"]."'>".$row["nom_produit"]."</option>";
                                                            }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-sm-2">
                                                <input type="text" id="recherche" onkeyup="myFunction()" class="form-control form-control-user" placeholder="recherche produit"><br>
                                                Quantite <input type="text" id="quantiteStock" name="quantiteStock" readonly class="form-control form-control-user">
                                                identifant achat :<input type="text"  id="idachat" name="idachat" readonly class="form-control form-control-user"> 
                                            </div>

                                            <div class="col-sm-2">
                                                    <input type="number" class="form-control form-control-user"
                                                    name="quantite" id="quantite" placeholder="quantite" required><br>
                                                    <input type="number" class="form-control form-control-user"
                                                    name="prix" id="prix" placeholder="prix unitaire" required><br>
                                            </div>
                                        </div> 
                                        <button type="submit" name="enregistrer" id="enregistrer" class="btn btn-warning btn-user btn-block">
                                            Modifeir
                                        </button>
                                    </form>
                                    <hr><hr>
                                        <p>
                                            Modification de facture
                                        </p>
                                    <hr>
                                    <form action="../bond/upload.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-4 mb-3 mb-sm-0">
                                            Photo de la facture : <input type="file" class="form-control form-control-user" id="images"
                                                name="images" placeholder="Ima de la facture" required>
                                            </div>
                                            <div class="col-sm-4">
                                            date Achat :<input type="date" class="form-control form-control-user" id="date" 
                                                name="date" placeholder="" required>
                                            </div>
                                            <div class="col-sm-4">
                                            Numero iamge :<input type="number" class="form-control form-control-user" id="idimage" 
                                                name="idimage" placeholder="numero reference image" required>
                                            </div>
                                        </div>
                                        <span id="enregistrement">
                                        <button type="submit" name="edite" id="edite" class="btn btn-info btn-user btn-block">
                                           Modifier facture
                                        </button>
                                        </span>
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
    <script src="../stock/stockVente.js"></script>
     <script>
        document.getElementById("fournisseur").value = document.getElementById("fourni").textContent;
        document.getElementById("prix").value = document.getElementById("pri").textContent;
        document.getElementById("nomProduit").value = document.getElementById("nom").textContent;
        document.getElementById("quantite").value = document.getElementById("qt").textContent;
        document.getElementById("idachat").value = document.getElementById("id").textContent;
        document.getElementById("quantiteStock").value = document.getElementById("qt").textContent;
    </script>
</body>

</html>