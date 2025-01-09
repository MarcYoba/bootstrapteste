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
                            <div class="card-header py-3">
                                <div class="form-group row">
                                    <div class="col-sm-8 ">
                                        <h1 class="h4 text-gray-900 mb-4 m-0 font-weight-bold">Fiche descente su terrain</h1>
                                    </div>
                                    <div class="col-sm-2 ">
                                        <button  class='btn btn-success' onclick="selection()"><i class='fas fa-pencil-alt'></i></button>
                                    </div>
                                    <div class="col-sm-2 ">
                                    <?php  echo '<a  class="btn btn-success" href="../pdf/getTerrain.php?id='.$id.'"><i class="fas fa-download fa-sm "></i>Telecharger</a>' ?>
                                    </div>
                                </div>
                            </div>
                            
                                
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                          
                                    Fichier Numero : <p class="text-lg font-weight-bold text-center" id="id">  <?php echo $id; ?></p>
                                    <hr> 
                                    </div>
                                    Information du client
                                <hr>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                      Nom:     
                                    <p class="text-lg font-weight-bold" id="nom"><?php echo $client->getByIdClient($row["idclient"]); ?></p> 
                                    </div>
                                    
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        Localisation:
                                    <p class="text-lg font-weight-bold" id="localisation"> <?php echo $row["localisation"] ?></p> 
                                    </div>

                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                    Telephone :<p class="text-lg font-weight-bold" id="telephone"> <?php echo $row["telephone"] ?></p> 
                                    </div>
                                    
                                </div>
                                Information de descente
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        date du jour: <p class="text-lg font-weight-bold" id="datejour"> <?php echo $row["datejour"] ?></p>  
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Motif de la visite :<p class="text-lg font-weight-bold" id="motifvisite"> <?php echo $row["motifvisite"] ?></p> 
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Effectif: <p class="text-lg font-weight-bold" id="efectif"> <?php echo $row["efectif"] ?></p>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Age: <p class="text-lg font-weight-bold" id="age"> <?php echo $row["Age"] ?></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Presence de barrier: 
                                        <p class="text-lg font-weight-bold" id="barrier"> <?php echo $row["barrier"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Pedulive: 
                                        <p class="text-lg font-weight-bold" id="pedulive"> <?php echo $row["pedulive"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Type de construction: 
                                        <p class="text-lg font-weight-bold" id="construction"> <?php echo $row["construction"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Nombre de batiment: 
                                        <p class="text-lg font-weight-bold" id="batiment"> <?php echo $row["batiment"] ?></p>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Superficie du locale: 
                                        <p class="text-lg font-weight-bold" id="superficie"> <?php echo $row["superficie"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Qualite du sole: <p class="text-lg font-weight-bold" id="sole"> <?php echo $row["sole"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Densite: <p class="text-lg font-weight-bold" id="densite"> <?php echo $row["densite"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Environement d'exploitation: <p class="text-lg font-weight-bold" id="environement"> <?php echo $row["environement"] ?></p>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Hygiene du batiment: <p class="text-lg font-weight-bold" id="hygiene"> <?php echo $row["hygiene"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Nombre mangeoire: <p class="text-lg font-weight-bold" id="mangeoire"> <?php echo $row["mangeoire"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Nombre abrevoire: <p class="text-lg font-weight-bold" id="abrevoire"> <?php echo $row["abrevoire"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Type d'alimentation: 
                                    <p class="text-lg font-weight-bold" id="alimentation"> <?php echo $row["alimentation"] ?></p>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Granulometrie: 
                                        <p class="text-lg font-weight-bold" id="granulometrie"> <?php echo $row["granulometrie"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Presence de l'antenou: 
                                        <p class="text-lg font-weight-bold" id="antenou"> <?php echo $row["antenou"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Prophylacie:
                                    <p class="text-lg font-weight-bold" id="prophylacie"> <?php echo $row["prophylacie"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Patologie anterieux: 
                                    <p class="text-lg font-weight-bold" id="patologie"> <?php echo $row["patologie"] ?></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Traitement anterieur: 
                                        <p class="text-lg font-weight-bold" id="traitemenanterieux"> <?php echo $row["traitemenanterieux"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Signe clinique: 
                                    <p class="text-lg font-weight-bold" id="signeclinique"> <?php echo $row["signeclinique"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Traitement Anvisage: 
                                    <p class="text-lg font-weight-bold" id="traia"> <?php echo $row["Traitementanvisage"] ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0"> 
                                    Montant: <p class="text-lg font-weight-bold" id="Montant"> <?php echo $row["Montant"] ?></p>
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
    <script src="service.js"></script>

</body>

</html>