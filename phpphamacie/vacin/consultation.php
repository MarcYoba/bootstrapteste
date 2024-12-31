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
    <style>
        .ligne-verticale {
        width: 2px;
        height: 100px;
        border: none; /* Supprime la bordure par défaut */
        border-left: 2px solid black;
        transform: rotate(90deg); /* Rotation de 90 degrés pour créer une ligne verticale */
        }
    </Style>
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
                    <div class="text-center card-header py-3">
                                <h1 class="h4 text-gray-900 mb-4">Fiche de Consultation</h1>
                            </div> 
                        <div class="p-5">
                            
                            <form class="user" action="registerconsultation.php" method="post">
                            <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control form-control-user" id="date" 
                                           name="date" placeholder="date" required>
                                    </div>
                                    
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        Nom : <input type="text" class="form-control form-control-user" id="Name"
                                           name="Name" placeholder="Nom sujet" required>
                                    </div>
                                    <div class="col-sm-6">
                                      Vaccin:  <input type="texte" class="form-control form-control-user" id="age" 
                                           name="vaccin" placeholder="vaccin" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    Age:  <input type="number" class="form-control form-control-user" id="age" 
                                           name="age" placeholder="age" required>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    Vermifuge:  <input type="texte" class="form-control form-control-user" id="Vermifuge" 
                                           name="Vermifuge" placeholder="Vermifuge" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Sexe: <input type="text" class="form-control form-control-user" id="Sexe"
                                        name="Sexe" placeholder="Sexe" required>
                                    </div> 
                                    <div class="col-sm-2 mb-3 mb-sm-0">   
                                        Poid: <input type="number" class="form-control form-control-user" id="Poid"
                                           name="Poid" placeholder="Poid" required>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">    
                                        Espace: <input type="text" class="form-control form-control-user" id="Espace"
                                           name="Espace" placeholder="Espace" required>
                                    </div>
                                    
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        Regime Alimentaire: <textarea rows="2" cols="20" class="form-control form-control-user" id="Regime"
                                        name="Regime" placeholder="Regime Alimentaire" required></textarea>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Race: <input type="text" class="form-control form-control-user" id="Poid"
                                           name="Race" placeholder="Race" required>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Robe <input type="texte" class="form-control form-control-user" id="Robe"
                                           name="Robe" placeholder="ROBE" required>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Temterature: <input type="texte" class="form-control form-control-user" id="Robe"
                                           name="Temterature" placeholder="Temterature" required>
                                    </div>
                                    <div class="col-sm-5 mb-3 mb-sm-0">
                                        Nom du propritaire 
                                        <select id="idclient"  name="idclient"  class="form-control form-select">
                                            <?php 
                                            require_once("../connexion.php");
                                                global $conn;
                                                $sql = "SELECT id, firstname, adresse FROM client";
                                                $result = $conn->query($sql);
                                                while ($row = mysqli_fetch_assoc($result)){               
                                                    echo "<option value='".$row["id"]."'>".$row["firstname"]."</option>";
                                                }
                                            ?>
                                    </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group ">
                                    <div class="col-sm-9 mb-3 mb-sm-0">
                                        Motif de la consultation <textarea type="text" rows="5" cols="20" class="form-control form-control-user" id="Mc"
                                           name="Mc" placeholder="Motif de la consultation" required></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row ">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                         <textarea type="text" rows="5" cols="20" class="form-control " id="symptomes"
                                           name="symptomes" placeholder="symptomes" required></textarea>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                         <textarea type="text" rows="5" cols="20" class="form-control " id="diagnostic"
                                           name="diagnostic" placeholder="diagnostic" required></textarea>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <textarea type="text" rows="5" cols="20" class="form-control " id="traitement"
                                           name="traitement" placeholder="traitement" required></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Pronostique: <textarea type="text" rows="2" cols="20" class="form-control form-control-user" id="Pronostique"
                                           name="Pronostique" placeholder="Pronostique de la consultation" required></textarea>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Prophylaxe: <textarea type="text" rows="2" cols="20" class="form-control form-control-user" id="Prophylaxe"
                                           name="Prophylaxe" placeholder="Prophylaxe de la consultation" required></textarea>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Indication: <textarea type="text" rows="2" cols="20" class="form-control form-control-user" id="Indication"
                                           name="Indication" placeholder="Indication consultation" required></textarea>
                                    </div>
                                    
                                </div>
                                <hr>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-9 mb-3 mb-sm-0">
                                       <p 
                                           placeholder="Motif de la consultation" required> Total: 
                                        </p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="montant"
                                           name="montant" placeholder="montant FCFA" required>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" name="submit" id="submit" class="btn btn-success btn-user btn-block">
                                    Enregister
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

</body>

</html>