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
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Fiche descente su terrain</h1>
                            </div>
                            <?php 
                            $id = $_GET["id"];
                                require_once("../connexion.php");
                                require_once("../bdmutilple/getclient.php");
                                global $conn;
                                $client = new Client(1);
                                        $sql = "SELECT * FROM terrain WHERE id='$id'";
                                        $result = $conn->query($sql);
                                        $row = mysqli_fetch_assoc($result);

                                                
                            ?>
                                Information du client
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                      Nom:     
                                    <p class="text-lg font-weight-bold"><?php echo $client->getByIdClient($row["idclient"]); ?></p> 
                                    </div>
                                    
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Localisation:
                                    <p class="text-lg font-weight-bold"> <?php echo $row["localisation"] ?></p> 
                                    </div>

                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                    Telephone :<p class="text-lg font-weight-bold"> <?php echo $row["telephone"] ?></p> 
                                    </div>
                                    
                                </div>
                                Information de descente
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        date du jour: <p class="text-lg font-weight-bold"> <?php echo $row["datejour"] ?></p>  
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Motif de la visite :<p class="text-lg font-weight-bold"> <?php echo $row["motifvisite"] ?></p> 
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Efectif: <p class="text-lg font-weight-bold"> <?php echo $row["efectif"] ?></p>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Age: <p class="text-lg font-weight-bold"> <?php echo $row["Age"] ?></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Presence de barrier: 
                                        <p class="text-lg font-weight-bold"> <?php echo $row["barrier"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Pedulive: 
                                        <p class="text-lg font-weight-bold"> <?php echo $row["pedulive"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Type de construction: 
                                        <p class="text-lg font-weight-bold"> <?php echo $row["construction"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Nombre de batiment: 
                                        <p class="text-lg font-weight-bold"> <?php echo $row["batiment"] ?></p>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Superficie du locale: 
                                        <p class="text-lg font-weight-bold"> <?php echo $row["superficie"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Qualite du sole: <p class="text-lg font-weight-bold"> <?php echo $row["sole"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Densite: <p class="text-lg font-weight-bold"> <?php echo $row["densite"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Environement d'exploitation: <p class="text-lg font-weight-bold"> <?php echo $row["environement"] ?></p>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Hygiene du batiment: <p class="text-lg font-weight-bold"> <?php echo $row["hygiene"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Nombre mangeoire: <p class="text-lg font-weight-bold"> <?php echo $row["mangeoire"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Nombre abrevoire: <p class="text-lg font-weight-bold"> <?php echo $row["abrevoire"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Type d'alimentation: 
                                    <p class="text-lg font-weight-bold"> <?php echo $row["alimentation"] ?></p>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Granulometrie: 
                                        <p class="text-lg font-weight-bold"> <?php echo $row["granulometrie"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Presence de l'antenou: 
                                        <p class="text-lg font-weight-bold"> <?php echo $row["antenou"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Prophylacie:
                                    <p class="text-lg font-weight-bold"> <?php echo $row["prophylacie"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Patologie anterieux: 
                                    <p class="text-lg font-weight-bold"> <?php echo $row["patologie"] ?></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Traitement anterieur: 
                                        <p class="text-lg font-weight-bold"> <?php echo $row["traitemenanterieux"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Signe clinique: 
                                    <p class="text-lg font-weight-bold"> <?php echo $row["signeclinique"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Traitement Anvisage: 
                                    <p class="text-lg font-weight-bold"> <?php echo $row["Traitementanvisage"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0"> 
                                    Montant: <p class="text-lg font-weight-bold"> <?php echo $row["Montant"] ?></p>
                                    </div>
                                </div>
                                
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