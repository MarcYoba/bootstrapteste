<?php 
session_start();
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

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="../../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .drop{
            display: none;
        }
        #TypePaie {
            color: red;
        }

        
    </style>

</head>

<body class="bg-gradient-success">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="form-group row">
                    <div class="col-lg-1 d-none d-lg-block bg-register-image">
                        <?php require_once("../../headercabinet.php")?>
                    </div>
                    <div class="col-lg-11">
                        <div class="p-5">
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-success">Tables des ventes</h6>
                                            <div class="form-group row">
                                            <div class="col-sm-6">
                                            
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
                                            <br>
                                            <div class="row">
                                                <p class="btn btn-success btn-user col-md-2" onclick="ajouterLigne('dataTable', 
                                                5, 10)"><i class="fas fa-check"></i> Ajouter une ligne</p>
                                                <p class="col-md-2" >Quantité Totale  <br> <span id="quantitetotal">0</span></p>
                                                <p class="col-md-2" >Montant Total  <br> <span id="prixtotal">0</span></p>
                                                <p class="col-md-3" >
                                                    Date vente:
                                                    <input type="date" class="form-control form-control-user"
                                                    name="datevente" id="datevente" placeholder="quantite" required>
                                                </p>
                                                <a class="btn btn-success btn-user col-md-1" href="liste.php">Liste</a>
                                                <p class="col-md-2" >
                                                    <span id="TypePaie" class="drop" ></span>
                                                    <span id="teste" class="drop" >0</span>
                                                    Total réduction <input type="number" class="form-control form-control-user"
                                                name="caculelreduction" id="caculelreduction" placeholder="réduction produit" readonly value="0">
                                                </p>
                                            </div>
                                            <br>
                                            <div class="row">
                                                
                                                <p class="col-md-2" >
                                                    MOM/OM
                                                    <input type="number" class="form-control form-control-user"
                                                    name="momo" id="momo" value="0" required>
                                                </p>
                                                <p class="col-md-2" >
                                                    Cash
                                                    <input type="number" class="form-control form-control-user"
                                                    name="cash" id="cash" value="0" required>
                                                </p>
                                                <p class="col-md-2" >
                                                    Crédit
                                                    <input type="number" class="form-control form-control-user"
                                                    name="credit" id="credit" value="0" required>
                                                </p>
                                                <p class="col-md-2" >
                                                    Banque
                                                    <input type="number" class="form-control form-control-user"
                                                    name="Banque" id="Banque" value="0" required>
                                                </p>
                                                <p class="col-md-2" >
                                                    Réduction
                                                    <input type="number" class="form-control form-control-user"
                                                    name="reduction" id="reduction" value="0" required>
                                                </p>
                                                <p class="col-md-2" >
                                                    Net à payer
                                                    <input type="txt" class="form-control form-control-user"
                                                     name="Total" id="Total" placeholder="0 FCFA"  readonly>
                                                </p>
                                                
                                            </div>
                                            <div class="row">
                                                <p class="col-md-2 btn btn-info">
                                                    <input type="search" id="recherche" onkeyup="myFunction()"  class="form-control form-control-user" placeholder="Recherche"><br>
                                                    <input type="tel" id="telephone"   class="form-control form-control-user" placeholder="Téléphone"> <br>
                                                    <button class="btn btn-success btn-user" onclick="enregistremetnclient()">enregistrer client</button>
                                                </p>
                                                <p class="col-md-3" >
                                                    <select id="fournisseur"  name="fournisseur"   class="form-control form-select"  size="10" multiple aria-label="multiple select " onchange="Client()" required>
                                                                    
                                                        <?php 
                                                            global $conn;
                                                            $sql = "SELECT id, firstname, adresse FROM client";
                                                            $result = $conn->query($sql);
                                                            while ($row = mysqli_fetch_assoc($result)){     
                                                                echo "<option value='".$row["firstname"]."'>".$row["firstname"]."</option>";       
                                                                            //var_dump($row);
                                                            }
                                                        ?> 
                                                    </select>
                                                    <span id="idclient" class="drop"></span>
                                                </p>
                                                
                                                <p class="col-md-2" >
                                                    <input type="search" id="rechercheP" onkeyup="myFunctionP()"  class="form-control form-control-user" placeholder="recherche"><br>
                                                    <input type="number" class="form-control form-control-user"
                                                    name="quantite" id="quantite" placeholder="quantité" required><br>
                                                    <input type="number" class="form-control form-control-user"
                                                    name="prixglobal" id="prixglobal" placeholder="Prix du produit" readonly><br>
                                                    <i  id="montanttotal" class="form-control form-control-user"><span id="resultat" ></span></i>
                                                </p>
                                                <p class="col-md-3" >
                                                <select id="nomProduit"  name="nomProduit"  class="form-control form-select" size="10"  multiple aria-label="multiple select " required onclick="recherchePrix()">
                                                                        <option selected> </option>
                                                                        <?php 
                                                                        global $conn;
                                                                        $sql = "SELECT  nom_produit,cathegorie,quantite_produit FROM produitphamacie";
                                                                        $result = $conn->query($sql);
                                                                        while ($row = mysqli_fetch_assoc($result)){
                                                                            if ($row["quantite_produit"]>0) {
                                                                                echo "<option value='".$row["nom_produit"]."'>".$row["nom_produit"]."</option>";

                                                                            }                                                                            
                                                                            //var_dump($row);
                                                                        }
                                                                    ?>
                                                                    </select>
                                                </p>
                                                <p class="col-md-2" >
                                                    <select id="statusvente" name="statusvente" class="form-control form-select">
                                                        <option value="livree">livree</option>
                                                        <option value="non livree">non livree</option>
                                                    </select>
                                                    Réduction produit:
                                                    <input type="number" class="form-control form-control-user"
                                                    name="rp" id="rp" placeholder="reduction produit" required value="0"><br>
                                                    <button class="btn btn-primary btn-user" onclick="caculeReduction()">Calculer</button>
                                                </p>
                                                <p class="col-md-4" >
                                                    <span id="modifiervente"></span>
                                                    <span id="enregistremet"></span>
                                                </p>
                                                <p class="col-md-4" >
                                                    <input type="number" id="quantiteStokage" name="quantiteStokage" class="form-control form-select" readonly>
                                                </p>
                                            </div>
                                            <span id="verificatiobDonne"></span>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                                                    <thead>
                                                    
                                                        <tr>
                                                            <th>Nom Client</th>
                                                            <th>Désignation</th>
                                                            <th>Quantité</th>
                                                            <th>P.U</th>
                                                            <th>P.Total</th>
                                                            <th>Opération</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                       
                                                        
                                                    </tfoot>
                                                    <tbody>
                                                        <tr class="br-primary">
                                                            <th  >
                                                            <div class="form-group ">
                                                                
                                                            </div>
                                                            </th>
                                                            <th>
                                                                <div class="form-group row">
                                                                
                                                                <!-- <input type="text" class="form-control form-control-user" id="Nomproduit"
                                                                    name="Nomproduit" placeholder="Nom produit" required> -->
                                                                    
                                                                
                                                            </div>
                                                        </th>
                                                            <th> 
                                                                
                                                            </th>
                                                            <th>
                                                                   
                                                            </th>
                                                            <th>
                                                                
                                                            </th> 
                                                            <th  >
                                                                <span id="modifierligne"></span>
                                                                <span id="idfacture" class="drop"></span>
                                                                <span id="idvente" class="drop"></span>
                                                            </th> 
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    
                                </div>
                            <!--</form> -->
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
   <script src="nouvellelignevente.js"></script>
    <script src="listeVente.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('sidebarToggle');
            if(button) {
                button.click();
            }
        });
    </script>

</body>

</html>