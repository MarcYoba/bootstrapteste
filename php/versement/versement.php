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

</head>

<body class="bg-gradient-primary">

    <div class="container" >
        
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center" >
                                <h1 class="h4 text-gray-900 mb-4">Versement</h1>
                            </div>
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Versement</h6>
                                <hr>
                                 <div class="row">
                                    <a href="../dette/dette.php"  class="btn btn-info btn-user col-md-4" >Dette</a>
                                </div>
                                <span id="verificatiobDonne"></span>
                                
                            </div>
                            
                            
                            <form class="user" action="register.php" method="post" >
                            <hr>
                            <input type="date" class="form-control form-control-user" id="dateversement"
                            name="dateversement" placeholder="date achat" required>
                                <?php 
                                    
                                    if(isset($_GET['tableau'])){
                                        $tabdonne = $_GET['tableau'];
                                       $donnees= json_decode($tabdonne,true);
                                       echo '<div class="form-group ">';
                                            
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
                                            
                                            echo'<input type="number" class="form-control form-control-user" id="iddette"
                                            name="iddette" placeholder="id dette" value="'.$donnees["iddette"].'" required readonly>';  
                                        }else{
                                            echo'<input type="number" class="form-control form-control-user" id="iddette"
                                            name="iddette" placeholder="id dette"  required>';
                                        }
                                        echo'</div>'; 
                                        echo'<div class="col-sm-6 mb-3 mb-sm-0">';
                                            echo'<select id="client"  name="client"  class="form-control " required>';
                                                if(isset($_GET['tableau'])){
                                                    $tabdonne = $_GET['tableau'];
                                                $donnees = json_decode($tabdonne,true);
                                                    echo'<option value="'.$donnees["idclient"].'"  selected>'.$donnees["firstname"].'</option>';
                                                }else{
                                                                        global $conn;
                                                                        $sql = "SELECT id, firstname, adresse FROM client";
                                                                        $result = $conn->query($sql);
                                                                        while ($row = mysqli_fetch_assoc($result)){
                                                                            
                                                                            echo "<option value='".$row["id"]."'>".$row["firstname"]." ".$row["adresse"]."</option>";
                                                                            
                                                                            //var_dump($row);
                                                                        } 
                                                                
                                                }
                                                
                                            echo'</select>';
                                        echo'</div>';
                                    echo'</div>';
                                    echo'<div class="form-group row">';
                                        echo'<div class="col-sm-6 mb-3 mb-sm-0">';
                                                echo'<input type="number" class="form-control form-control-user"
                                                name="montant" id="montant" placeholder="montant versement" required>'; 
                                        echo'</div>';
                                        echo'<div class="col-sm-6 mb-3 mb-sm-0">';
                                            if(isset($_GET['tableau'])){
                                                $tabdonne = $_GET['tableau'];
                                                $donnees = json_decode($tabdonne,true);
                                                echo'<input type="number" class="form-control form-control-user"
                                                name="montantdette" id="montantdette" value='.intval($donnees["montant"]).' placeholder="montant" required>';
                                            }else{
                                                echo'<input type="number" class="form-control form-control-user"
                                                name="montantdette" id="montantdette" placeholder="montant dette" required>';
                                            }
                                        echo'</div>';
                                    echo'</div>';
                                    echo'<div class="form-group row">';
                                        echo'<div class="col-sm-6 mb-3 mb-sm-0">';
                                                echo'<input type="number" class="form-control form-control-user"
                                                name="om" id="on" placeholder="OM" required>'; 
                                        echo'</div>';
                                        echo'<div class="col-sm-6 mb-3 mb-sm-0">';
                                            if(isset($_GET['tableau'])){
                                                $tabdonne = $_GET['tableau'];
                                                $donnees = json_decode($tabdonne,true);
                                                echo'<input type="txt" class="form-control form-control-user"
                                                name="matif" id="matif" value='.intval($donnees["matif"]).' placeholder="montant" required>';
                                            }else{
                                                echo'<input type="txt" class="form-control form-control-user"
                                                name="matif" id="matif" placeholder="motif" required>';
                                            }
                                        echo'</div>';
                                    echo'</div>';
                                
                                    echo'<hr>';
                                    if (isset($_GET['tableau'])) {
                                        $tabdonne = $_GET['tableau'];
                                        $donnees = json_decode($tabdonne,true);
                                        if ($donnees["role"] == "modification") {
                                            echo'<button type="submit" name="modification" id="modification" class="btn btn-primary btn-user btn-block">
                                            Modifier
                                            </button>';
                                        } else {
                                            echo'<button type="submit" name="submit" id="submit" class="btn btn-primary btn-user btn-block">
                                            Enregistrement
                                            </button>';
                                        }
                                        
                                    } else {
                                        echo'<button type="submit" name="submit" id="submit" class="btn btn-primary btn-user btn-block">
                                            Enregistrement
                                        </button>';
                                    } 
                                  
                                ?>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="../../index.html">Already have an account? Login!</a>
                            </div>
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