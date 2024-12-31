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
                            
                            <?php
                                require_once("../connexion.php");
                                require_once("../bdmutilple/getclient.php");
                                
                                global $conn;
                                $id = $_GET["id"];

                                $sql="SELECT * FROM consultation WHERE id='$id'";
                                $result = $conn->query($sql);
                                $row=mysqli_fetch_assoc($result);
                                $client = new Client($row["idclient"]);
                            ?>
                            <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    </div>
                                    <div class="col-sm-6">
                                    Date: <p><?php echo $row["dateArrive"]?></p>
                                    </div>
                                    
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        Nom : <p class="text-lg font-weight-bold"><strong><?php echo $row["Nom"]?></strong></p>
                                    </div>
                                    <div class="col-sm-6">
                                      Vaccin:  <p class="text-lg font-weight-bold"><?php echo $row["vaccin"]?></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    Age:  <p class="text-lg font-weight-bold"><?php echo $row["age"]?></p>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    Vermifuge:  <p class="text-lg font-weight-bold"><?php echo $row["vermufuge"]?></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Sexe: <p class="text-lg font-weight-bold"><?php echo $row["sexe"]?></p>
                                    </div> 
                                    <div class="col-sm-2 mb-3 mb-sm-0">   
                                        Poid: <p class="text-lg font-weight-bold"><?php echo $row["poid"]?></p>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">    
                                        Esperce: <p class="text-lg font-weight-bold"><?php echo $row["esperce"]?></p>
                                    </div>
                                    
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        Regime Alimentaire:<p class="text-lg font-weight-bold"><?php echo $row["regime"]?></p>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Race: <p class="text-lg font-weight-bold"><?php echo $row["race"]?></p>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Robe <p class="text-lg font-weight-bold"><?php echo $row["robe"]?></p>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Temterature: <p class="text-lg font-weight-bold"><?php echo $row["temperature"]?></p>
                                    </div>
                                    <div class="col-sm-5 mb-3 mb-sm-0">
                                        Nom du propritaire: 
                                        <p class="text-lg font-weight-bold"> <?php echo $client->getByIdClient($row["idclient"])?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group ">
                                    <div class="col-sm-9 mb-3 mb-sm-0">
                                        Motif de la consultation: <p class="text-lg font-weight-bold"><?php echo $row["moticconsultation"] ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row ">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                    Symptomes:<p  class="text-lg font-weight-bold"> <?php echo $row["symtome"] ?></p> 
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Diagnostique:<p class="text-lg font-weight-bold"><?php echo $row["dianostique"] ?></p> 
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Traitement:<p class="text-lg font-weight-bold"> <?php echo $row["traitement"] ?></p> 
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Pronostique:<p class="text-lg font-weight-bold"><?php echo $row["Pronostique"] ?></p> 
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Prophylaxe:<p class="text-lg font-weight-bold"> <?php echo $row["Prophylaxe"] ?></p> 
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Indication:<p class="text-lg font-weight-bold"><?php echo $row["Indication"] ?></p> 
                                    </div>
                                    
                                </div>
                                <hr>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-9 mb-3 mb-sm-0">
                                    Total:<p  class="text-lg font-weight-bold">  <?php echo $row["montant"] ?>FCFA </p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    <p></p>
                                    </div>
                                </div>
                                <hr>
                                
                                
                            
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