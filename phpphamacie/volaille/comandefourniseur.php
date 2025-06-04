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

    <title>Gestion de Stock</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="../../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Commande Poussin Fourniseur</h1>
                            </div>
                           <!-- <form class="user"  >-->
                                
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                <h6 class="m-0 font-weight-bold text-primary">Commande fourniseur des poussins </h6>     
                                                </div>
                                                <div class="col-sm-2">
                                                <i class="fa fa-home"></i>
                                                    <a href="../../homepahamacie.php" class="btn btn-primary">Home</a> 
                                                </div>
                                                <div class="col-sm-2">
                                                    <i class="fa fa-list"></i> 
                                                    <a href="listecommande.php" class="btn btn-success"> Liste</a>             
                                                </div>
                                                <!--<div class="btn btn-warning"><i class="fa fa-arrow-left"></i> Retour</div>  -->  
                                            </div>
                                            <br>
                                            <div class="row">
                                                <p class="btn btn-warning btn-user col-md-2" onclick="ajouterLigne('dataTable', 
                                                5, 10)">Ajouter une ligne</p>
                                                <p class="col-md-2" >Quantité : <span id="quantitetotal">0</span></p>
                                                <p class="col-md-2" >Prix : <span id="prixtotal">0</span></p>
                                                <p class="col-md-2" > Dete Commande:<input type="date" class="form-control form-control-user" id="datefacture"
                                                name="datefacture" placeholder="date achat"></p>
                                                
                                            </div>
                                            <span id="verificatiobDonne"></span>
                                        </div>
                                        <button class="btn btn-success btn-user btn-block" onclick="afficherFormulaire()">Enregistrer une commande</button>
                                        <div class="card-body" id="formulaire" style="display: none;">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                                                    <thead>
                                                    
                                                        <tr>
                                                            <th>Fourniseur</th>
                                                            <th>Souche</th>
                                                            <th>Montant</th>
                                                            <th>Statut</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                       
                                                        
                                                    </tfoot>
                                                    <tbody>
                                                        <tr class="br-primary">
                                                            <th class = >
                                                            <div class="form-group ">
                                                                <select id="fournisseur"  name="fournisseur"  class="form-control form-select" required>
                                                                    <option selected> </option>
                                                                    <?php 
                                                                        global $conn;
                                                                        $sql = "SELECT id, nom FROM fournisseurphamacie";
                                                                        $result = $conn->query($sql);
                                                                        while ($row = mysqli_fetch_assoc($result)){
                                                                            echo "<option value='".$row["id"]."'>".$row["nom"]."</option>";
                                                                            //var_dump($row);
                                                                        }
                                                                    ?> 
                                                                </select>
                                                            </div>
                                                            </th>
                                                            <th>
                                                                <div class="form-group row">
                                                                    <input type="text" class="form-control form-control-user" id="souche"
                                                                    name="souche" placeholder="Souche poussin" required>     
                                                                </div>
                                                            </th>
                                                            <th> 
                                                                <input type="number" class="form-control form-control-user"
                                                                    name="montant" id="montant" placeholder="Montant versement" required>
                                                            </th>
                                                            <th> 
                                                                <input type="text" class="form-control form-control-user"
                                                                    name="status" id="status" placeholder="StatuT commande" required>
                                                            </th>  
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <button  class="btn btn-success btn-user btn-block" onclick="enregistrementDonnees('dataTable')">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div><br>

                                        <button class="btn btn-info btn-user btn-block" onclick="afficherlivraison()">Enregistrer une livraison</button>

                                        <div class="card-body" id="livraison" style="display: none;">
                                        <p class="btn btn-warning btn-user col-md-2" onclick="ajouter('dataTable1', 
                                                5, 10)">ajouter achat</p>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable1"  width="100%" cellspacing="0">
                                                    <thead>
                                                    
                                                        <tr>
                                                            <th>Fourniseur</th>
                                                            <th>Quantite</th>
                                                            <th>Prix unitaire</th>
                                                            <th>Statut</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                       
                                                        
                                                    </tfoot>
                                                    <tbody>
                                                        <tr class="br-primary">
                                                            <th class = >
                                                            <div class="form-group ">
                                                                <select id="fournisseur1"  name="fournisseur1"  class="form-control form-select" required>
                                                                    <option selected> </option>
                                                                    <?php 
                                                                        global $conn;
                                                                        $sql = "SELECT id, nom FROM fournisseurphamacie";
                                                                        $result = $conn->query($sql);
                                                                        while ($row = mysqli_fetch_assoc($result)){
                                                                            echo "<option value='".$row["id"]."'>".$row["nom"]."</option>";
                                                                            //var_dump($row);
                                                                        }
                                                                    ?> 
                                                                </select>
                                                            </div>
                                                            </th>
                                                            <th>
                                                                <div class="form-group row">
                                                                    <input type="text" class="form-control form-control-user" id="Quantite"
                                                                    name="Quantite" placeholder="Quantite poussin" required>     
                                                                </div>
                                                            </th>
                                                            <th> 
                                                                <input type="number" class="form-control form-control-user"
                                                                    name="unite" id="unite" placeholder="Prix unitaire " required>
                                                            </th>
                                                            <th> 
                                                                <input type="text" class="form-control form-control-user"
                                                                    name="status1" id="status1" placeholder="Statut commande" required>
                                                            </th>  
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <button  class="btn btn-success btn-user btn-block" onclick="enregistrement('dataTable1')">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                        </div>
                                </div>

                                
                            <!--</form> -->
                            
                            
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
    <!--<script src="achat.js"></script>-->
    <script src="commande.js">
        
    </script>

</body>
</html>