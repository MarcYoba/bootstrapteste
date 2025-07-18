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
                            </div>  
                                <div class="form-group row">
                                        <div class="col-sm-6 ">
                                        <h6 class="m-0 font-weight-bold text-success">Enregistrer un sujet</h6>
                                        </div>
                                        <div class="col-sm-2">
                                                <i class="fa fa-home"></i>
                                                <a href="../../homepahamacie.php" class="btn btn-primary">Home</a> 
                                            </div>
                                            <div class="col-sm-2">
                                                <i class="fa fa-list"></i> 
                                                <a href="liste.php" class="btn btn-success"> Liste</a>
                                                
                                            </div>
                                        <div class="col-sm-2 ">
                                        <a class="m-0 font-weight-bold text-success" href="liste.php">Retour</a>
                                        </div>
                                </div>
                            
                            <form class="user" action="register.php" method="post">
                                <?php 
                                 if (isset($_GET["id"])) {
                                    echo '<input type="text" class="form-control form-control-user" id="id"
                                           name="id" placeholder="Nom sujet" required value="'.$_GET["id"].'" readonly> <br>';
                                 }else if(isset($_GET["delete"])){
                                    echo '<input type="text" class="form-control form-control-user" id="iddelete"
                                           name="iddelete" placeholder="Nom sujet" required value="'.$_GET["delete"].'" readonly> <br>';
                                 }

                                ?>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="Name"
                                           name="Name" placeholder="Nom sujet" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user" id="age" 
                                           name="age" placeholder="age" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="search" id="rechercheP" onkeyup="myFunctionP()"  class="form-control form-control-user" placeholder="recherche en utilisant le numero client"><br>
                                    <select id="idclient"  name="idclient"  class="form-control form-select" size="5"  multiple aria-label="multiple select ">
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
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="Type"
                                        name="Type" placeholder="Race de sujet" required>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        Type vaccin :<select class="form-control form-select" id="typevaccin" name="typevaccin" placeholder="Race de sujet" required>
                                            <Option value="Complet">Vaccin Complet</Option>
                                            <Option value="antirabique">Vaccin antirabique</Option>
                                            <Option value="parvovirose">Vaccin parvovirose</Option>
                                            <Option value="eurican">Vaccin eurican LR</Option>
                                            <Option value="L">Vaccin L</Option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Montant <input type="number" class="form-control form-control-user" id="montant"
                                           name="montant" placeholder="Montant" required>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Montant payer<input type="number" class="form-control form-control-user" id="montantpayer"
                                           name="montantpayer" placeholder="Montant payer" required>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        Reste<input type="number" class="form-control form-control-user" id="Reste"
                                           name="Reste" placeholder="Reste" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        Date vacin <input type="date" class="form-control form-control-user" id="premiervacin"
                                           name="premiervacin" placeholder="Date achat" required>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        Date rapelle <input type="date" class="form-control form-control-user" id="secondvacin"
                                           name="secondvacin" placeholder="Date achat" required>
                                    </div>

                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        Lieu vaccin :<select class="form-control form-select" id="lieu" name="lieu" placeholder="Race de sujet" required>
                                            <Option value="Entreprise">Entreprise</Option>
                                            <Option value="Domicille">Domicille</Option>
                                        </select>
                                    </div>
                                </div>

                                <span id="enregistrement">
                                    <button type="submit" name="submit" id="submit" class="btn btn-success btn-user btn-block">
                                        Enregister
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
    <script src="suivie.js"></script>                                        
    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>
    

</body>

</html>