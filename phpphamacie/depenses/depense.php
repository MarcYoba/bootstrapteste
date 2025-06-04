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

</head>

<body class="bg-gradient-success">

    <div class="container" >
        
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                <h6 class="m-0 font-weight-bold text-primary">Dépenses</h6>     
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
                            <form class="user" action="register.php" method="post" >
                                <hr>
                                <div class="from-group row">
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control form-control-user" id="datedepense"
                                        name="datedepense" placeholder="date achat" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <select id="type" name="type" class="form-control form-select" required>
                                            <option value="Autres achats"> Autres achats ( Tami, marteau, ralonge, etc.)</option>
                                            <option value="service exterieur"> charges générales ( Loyer, eau, electricite, etc.)</option>
                                            <option value="impots et taxes">  impôts et taxes </option>
                                            <option value="charge personnel">  charges de personnel(Salaires)  </option>
                                            <option value="autre charge"> (Heures supplémentaires, primes,Motivation,Miting etc.) </option>
                                            <option value="Voyages">  Voyages et déplacements, deplacement pour versement,seminaire, autre depense </option>
                                        </select>  
                                    </div>
                                    
                                </div>
                                <hr>
                                <?php 
                                    
                                    if(isset($_GET['tableau'])){
                                        $tabdonne = $_GET['tableau'];
                                       $donnees= json_decode($tabdonne,true);
                                       echo '<div class="form-group ">';
                                            echo'<div class="col-sm-14 mb-3 mb-sm-0">';
                                                echo'Numero Reference du produit :'.'<input type="text" class="form-control form-control-user" id="reference"
                                                name="reference"  value="'.$donnees["id"].'" required readonly>';    
                                            echo'</div>';
                                            echo'<hr>';
                                        echo'</div>';
                                    }else{
                                    }
                                    
                                    // var_dump($donnees);
                                    echo '<div class="form-group row">';
                                        echo'<div class="col-sm-6 mb-3 mb-sm-0">';
                                        if(isset($_GET['tableau'])){
                                            $tabdonne = $_GET['tableau'];
                                           $donnees= json_decode($tabdonne,true);
                                            
                                            echo'<input type="text" class="form-control form-control-user" id="description"
                                            name="description" placeholder="Description du mouvement" value="'.$donnees["description"].'" required>';  
                                        }else{
                                            echo'<input type="text" class="form-control form-control-user" id="description"
                                            name="description" placeholder="Description"  required>';
                                        }
                                        echo'</div>'; 
                                            echo'<div class="col-sm-6 mb-3 mb-sm-0">';
                                                
                                                    echo'<input type="file" class="form-control form-control-user" id="facture"
                                                    name="facture" placeholder="Facture"  >';
                                                
                                            echo'</div>';
                                        echo'</div>';
                                        echo'<div class="form-group row">';
                                            echo'<div class="col-sm-12 mb-3 mb-sm-0">';
                                                if(isset($_GET['tableau'])){
                                                    $tabdonne = $_GET['tableau'];
                                                    $donnees = json_decode($tabdonne,true);
                                                    echo'<input type="number" class="form-control form-control-user"
                                                    name="montant" id="montant" value='.intval($donnees["montant"]).' placeholder="Montant du mouvement" required>';
                                                }else{
                                                    echo'<input type="number" class="form-control form-control-user"
                                                    name="montant" id="montant" placeholder="Montant du mouvement" required>';
                                                }
                                            echo'</div>'; 
                                        echo'</div>';
                                    echo'<hr>';
                                     
                                        
                                    if(isset($_GET['tableau'])){
                                        echo'<button type="submit" name="modifier" id="modifier" class="btn btn-primary btn-user btn-block">
                                        Modifier
                                    </button>';
                                    }else{
                                        echo'<button type="submit" name="enregistrement" id="enregistrement" class="btn btn-success btn-user btn-block">
                                        Enregistrement
                                    </button>';
                                    }
                                  
                                ?>
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
    <!--<script src="produit.js"></script> --> 

</body>

</html>