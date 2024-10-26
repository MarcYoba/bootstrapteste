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
        rel="../../stylesheet">

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
                                <h1 class="h4 text-gray-900 mb-4">Valider la Commande </h1>
                            </div>
                           
                            <form class="user" action="register.php" method="post">
                                <hr><hr><hr>
                                <div class="form-group row">
                                <?php
                                    require_once("../connexion.php");
                                    global $conn;
                                    $id = $_GET["id"];
                                    $sql = "SELECT * FROM poussin WHERE id='$id'";
                                    $result = $conn->query($sql);
                                    $row = mysqli_fetch_assoc($result);

                                   echo '<div class="col-sm-3 mb-3 mb-sm-0">
                                        date commande<input type="date" class="form-control form-control-user" id="dateCommande"
                                           name="dateCommande" placeholder="date achat" readonly value="'.$row["dateCommande"].'">
                                        Fererence <input type="text" class="form-control form-control-user" id="reference"
                                           name="reference" placeholder="date achat" readonly value="'.$row["id"].'">
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <select id="fournisseur"  name="fournisseur"   class="form-control form-select"  size="4" multiple aria-label="multiple select " onchange="Client()" readonly>   
                                                        <option value="'.$row["Nomclient"].'">'.$row["Nomclient"].'</option>        
                                        </select>
                                    </div>    
                                    <div class="col-sm-2">
                                       Quantite <input type="number" class="form-control form-control-user" id="quantite" 
                                           name="quantite" placeholder="quantite poussin" required value="'.$row["quantite"].'"><br>

                                        souche<input type="texte" class="form-control form-control-user" id="souche" 
                                           name="souche" placeholder="souche" required value="'.$row["souche"].'" readonly >
                                    </div>
                                    <div class="col-sm-2">
                                        Prix unite<input type="number" class="form-control form-control-user" id="prixunite" 
                                           name="prixunite" placeholder="Prix unitaire" required value="'.$row["prixUnite"].'"><br>
                                        
                                     date livraison   <input type="date" class="form-control form-control-user" id="datelivraison"
                                           name="datelivraison" placeholder="date achat" required value="'.$row["dateLivraison"].'" readonly> 
                                    </div>
                                    <div class="col-sm-2">
                                        Montant <input type="number" class="form-control form-control-user" id="quantitetotale" 
                                           name="quantitetotale" placeholder="Montant" readonly value="'.$row["montant"].'">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                       OM <input type="number" class="form-control form-control-user" id="OM"
                                       name="OM" placeholder="OM Montant"  required value="'.$row["montantOm"].'">
                                    </div>
                                    <div class="col-sm-3">
                                       credit <input type="number" class="form-control form-control-user" id="CREDIT"
                                       name="CREDIT" placeholder="CREDIT Montant"  required value="'.$row["montantCredit"].'">
                                    </div>
                                    <div class="col-sm-3">
                                       cash <input type="number" class="form-control form-control-user" id="CASH"
                                       name="CASH" placeholder="CASH Montant"  required value="'.$row["montantCash"].'">
                                    </div>
                                    <div class="col-sm-3">
                                        reste<input type="number" class="form-control form-control-user" id="RESTE"
                                       name="RESTE" placeholder="RESTE Montant"  required value="'.$row["reste"].'">
                                    </div>
                                </div>';
                                ?>
                                <button type="submit" name="livraison" id="livraison" class="btn btn-warning btn-user btn-block">
                                    Livraison effectuer
                                </button>  
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
    <script>
        const  inputQuantite = document.getElementById("quantite");
        const  inputPrix = document.getElementById("prixunite");

        function calculeTotal(params) {
           document.getElementById("quantitetotale").value=  document.getElementById("quantite").value* document.getElementById("prixunite").value;
        }

        inputQuantite.addEventListener('input',calculeTotal);
        inputPrix.addEventListener('input',calculeTotal);


    </script>

</body>

</html>