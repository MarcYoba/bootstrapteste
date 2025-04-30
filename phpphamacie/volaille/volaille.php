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

<body class="bg-gradient-success">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                <h6 class="m-0 font-weight-bold text-primary">Créer une Commande</h6>     
                                </div>
                                <div class="col-sm-2">
                                <i class="fa fa-home"></i>
                                    <a href="../../homepahamacie.php" class="btn btn-primary">Home</a> 
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-list"></i> 
                                    <a href="liste.php" class="btn btn-success"> Liste</a>             
                                </div>
                                <!--<div class="btn btn-warning"><i class="fa fa-arrow-left"></i> Retour</div>  -->  
                            </div>
                            <form class="user" action="register.php" method="post">
                                <hr>
                                <h6 class="text-center">Enregistrer un nouveau Client</h6>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="Nomclient"
                                           name="Nomclient" placeholder="Nom du client" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="tel" class="form-control form-control-user" id="telephone" 
                                           name="telephone" placeholder="Téléphone" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="client" id="client" class="btn btn-success btn-user btn-block">
                                        Enregistrer
                                    </button>
                                </div>
                            </form>
                            <form class="user" action="register.php" method="post">
                                <hr><hr>
                                <h10 class="text-center">Enregistrer Commande</h10>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="recherche"
                                        name="recherche" placeholder="Recherche client" onkeyup="myFunctionP()">
                                    Date commande:<input type="date" class="form-control form-control-user" id="dateCommande"
                                           name="dateCommande" placeholder="Date d'achat" required>
                                           
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <select id="fournisseur"  name="fournisseur"   class="form-control form-select"  size="4" multiple aria-label="multiple select " onchange="Client()" required>
                                            <?php
                                                require_once("../connexion.php");
                                                global $conn;
                                                $sql = "SELECT id, firstname, adresse FROM client";
                                                $result = $conn->query($sql);
                                                    while ($row = mysqli_fetch_assoc($result)){     
                                                        echo "<option value='".$row["firstname"]."'>".$row["firstname"]."</option>";       
                                                    }
                                            ?>
                                        </select>
                                    </div>    
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control form-control-user" id="quantite" 
                                           name="quantite" placeholder="Quantité poussin" required><br>

                                        <input type="text" class="form-control form-control-user" id="souche" 
                                           name="souche" placeholder="Souche" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control form-control-user" id="prixunite" 
                                           name="prixunite" placeholder="Prix unitaire" required>
                                        
                                           Date livraison<input type="date" class="form-control form-control-user" id="datelivraison"
                                           name="datelivraison" placeholder="Date d'achat" required> 
                                            
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control form-control-user" id="quantitetotale" 
                                           name="quantitetotale" placeholder="Montant" readonly>
                                           Date rappel <input type="date" class="form-control form-control-user" id="daterapel"
                                           name="daterapel" placeholder="Date d'achat" required value="0001-01-01">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control form-control-user" id="OM"
                                       name="OM" placeholder="Montant OM"  required>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control form-control-user" id="CREDIT"
                                       name="CREDIT" placeholder="Montant Crédit"  required>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control form-control-user" id="CASH"
                                       name="CASH" placeholder="Montant Cash"  required>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control form-control-user" id="RESTE"
                                       name="RESTE" placeholder="Montant Reste"  required>
                                    </div>
                                </div>
                                
                                <button type="submit" name="submit" id="submit" class="btn btn-success btn-user btn-block">
                                    Enregistrer
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

function myFunctionP() {
  // Récupérer l'input et la liste déroulante
  var input, filter, ul, li, a, i;
  input = document.getElementById("recherche");
  filter = input.value.toUpperCase();
  ul = document.getElementById("fournisseur");
  li = ul.getElementsByTagName("option");

  // Boucler sur toutes les options
  for (i = 0; i < li.length; i++) {
    a = li[i];
    if (a.value.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
  
}


    </script>

</body>

</html>