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
                            <form class="user" action="register.php" method="post">
                                Information du client
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
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
                                    
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="Localisation"
                                           name="Localisation" placeholder="Localisation" required>
                                    </div>

                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" id="telephone"
                                           name="telephone" placeholder="telephone" required>
                                    </div>
                                    
                                </div>
                                Information de descente
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        date du jour <input type="date" class="form-control form-control-user" id="date"
                                           name="date" placeholder="date achat" required>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Motif de la visite :<textarea  id="motifvisite" name="motifvisite" placeholder="Motif Visite" required>
                                        </textarea>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Efectif: <input type="number"  class="form-control form-control-user" id="Efectif"
                                           name="Efectif" placeholder="Efectif" required>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Age: <input type="number"  class="form-control form-control-user" id="Age"
                                           name="Age" placeholder="Age" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Presence de barrier: 
                                        <select  class="form-control form-select" id="barrier" name="barrier"  required>
                                        <option value="OUI" >OUI</option>
                                        <option value="NON">NON</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Pedulive: 
                                        <select  class="form-control form-select" id="Pedulive" name="Pedulive"  required>
                                        <option value="OUI" >OUI</option>
                                        <option value="NON">NON</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Type de construction: 
                                        <select  class="form-control form-select" id="construction" name="construction"  required>
                                            <option value="definitif" >definitif</option>
                                            <option value="semi definitif">semi definitif</option>
                                            <option value="materiau provisoire">materiau provisoire</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Nombre de batiment: <input type="number"  class="form-control form-control-user" id="batiment"
                                           name="batiment" placeholder="Nombre de batiment" required>
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Superficie du locale: <input type="numbers"  class="form-control form-control-user" id="superficie"
                                           name="superficie" placeholder="Superficie" required>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Qualite du sole: <input type="texte"  class="form-control form-control-user" id="sole"
                                           name="sole" placeholder="Qualite du sole" required>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Densite: <input type="texte"  class="form-control form-control-user" id="densite"
                                           name="densite" placeholder="Densite au sole" required>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Environement d'exploitation: <input type="text"  class="form-control form-control-user" id="Environement"
                                           name="Environement" placeholder="Environement d'exploitation" required>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Hygiene du batiment: <input type="text"  class="form-control form-control-user" id="Hygiene"
                                           name="hygiene" placeholder="Hygiene du batiment" required>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Nombre mangeoire: <input type="number"  class="form-control form-control-user" id="mangeoire"
                                           name="mangeoire" placeholder="Nombre mangeoire" required>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Nombre abrevoire: <input type="number"  class="form-control form-control-user" id="abrevoire"
                                           name="abrevoire" placeholder="Nombre abrevoire" required>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Type d'alimentation: 
                                        <select  class="form-control form-select" id="alimentation" name="alimentation"  required>
                                            <option value="predemarrage" >predemarrage</option>
                                            <option value="demarrage">demarrage</option>
                                            <option value="croissance">croissance</option>
                                            <option value="finition">finition</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Granulometrie: 
                                        <select  class="form-control form-select" id="granulo" name="granulo"  required>
                                            <option value="BONNE" >BONNE</option>
                                            <option value="MOVAIRSE">MOVAIRSE</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Presence de l'antenou: 
                                        <select  class="form-control form-select" id="antenou" name="antenou"  required>
                                            <option value="OUI" >OUI</option>
                                            <option value="NON">NON</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Prophylacie:
                                        <select  class="form-control form-select" id="prophylacie" name="prophylacie"  required>
                                            <option value="respecte" >respecte</option>
                                            <option value="non respecte">non respecte</option>
                                            <option value="non connu">non connu</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Patologie anterieux: 
                                    <textarea  id="patologie" name="patologie" placeholder="Patologie anterieux" required>
                                    </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        Traitement anterieur: 
                                        <textarea  id="Traitemenante" name="Traitemenante" placeholder="Traitement anterieur" required>
                                    </textarea>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Signe clinique: 
                                        <textarea  id="siclinique" name="siclinique" placeholder="Signe clinique" required>
                                    </textarea>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                    Traitement Anvisage: 
                                        <textarea  id="Traitementan" name="Traitementan" placeholder="Traitement Anvisage" required>
                                    </textarea>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0"> 
                                    Montant <input type="number" class="form-control form-control-user" id="Montant"
                                    name="Montant" placeholder="Montant" required>
                                    </div>
                                </div>
                                
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