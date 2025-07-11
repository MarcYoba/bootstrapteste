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
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center" >
                                <h1 class="h4 text-gray-900 mb-4">Versement</h1>
                            </div>
                            <div class="card-header py-3">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <h6 class="m-0 font-weight-bold text-primary">Tables des Versements</h6>
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-home"></i>
                                    <a href="../../home.php" class="btn btn-primary">Home</a> 
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-list"></i> 
                                    <a href="liste.php" class="btn btn-success"> Liste</a>
                                                
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-list"></i> 
                                    <a href="../dette/dette.php" class="btn btn-info"> Dette</a>              
                                </div>
                                            <!--<div class="btn btn-warning"><i class="fa fa-arrow-left"></i> Retour</div>  -->  
                            </div>
                                <hr>
                                 
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
                                            name="iddette" placeholder="id dette" value="'.$donnees["iddette"].'"  readonly>'; 
                                            if (isset($donnees["idversme"])) {
                                                echo'<input type="number" class="form-control form-control-user" id="idverse"
                                                name="idverse" placeholder="id dette" value="'.$donnees["idversme"].'"  readonly>';
                                            }
                                             
                                        }else{
                                            echo'<input type="number" class="form-control form-control-user" id="iddette"
                                            name="iddette" placeholder="id dette" >';
                                        }
                                        echo'</div>'; 
                                        echo'<div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="search" id="rechecliet" onkeyup="recherclinet()"  class="form-control" placeholder="recherche fournisseur">
                                        ';
                                            echo'<select id="client"  name="client"  class="form-control " required size="4" multiple aria-label="multiple select">';
                                                if(isset($_GET['tableau'])){
                                                    $tabdonne = $_GET['tableau'];
                                                $donnees = json_decode($tabdonne,true);
                                                    echo'<option value="'.$donnees["idclient"].'"  selected>'.$donnees["firstname"].'</option>';
                                                }else{
                                                                        global $conn;
                                                                        $sql = "SELECT id, firstname, adresse FROM client ORDER BY firstname ASC";
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
                                                name="montant" id="montant" placeholder="montant" value="0" required>'; 
                                        echo'</div>';
                                        echo'<div class="col-sm-6 mb-3 mb-sm-0">';
                                            if(isset($_GET['tableau'])){
                                                $tabdonne = $_GET['tableau'];
                                                $donnees = json_decode($tabdonne,true);
                                                echo'<input type="number" class="form-control form-control-user"
                                                name="banque" id="banque"  placeholder="banque" required>';
                                            }else{
                                                echo'<input type="number" class="form-control form-control-user"
                                                name="banque" id="banque" placeholder="banque" required>';
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
                                                name="matif" id="matif" value='.intval($donnees["motif"]).' placeholder="Motif" required>';
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
    <script src="versement.js"></script>

</body>

</html>