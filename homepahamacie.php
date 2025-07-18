<?php 
    require_once("php/connexion.php");
    session_start(); 
    require_once("phpphamacie/historique/historiqueStock.php");
    require_once("phpphamacie/historique/getproduit.php");
    $_SESSION["route"] = "cabinet";
   if (!isset($_SESSION['modal_affiche'])) {
        $_SESSION['modal_affiche'] = true;
    }
   $produit = new Produit();
    $peremption = $produit->ProduitSansDatePremption();
   $doublonproduit = $produit->DoublonProduit();
    $moiperemtion = $produit->ProduitEnCourPeremtionPrelote();
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .start{
            color: gold;
        }
        .amount{
            display: none;
        }
    </style>
    
</head>

<body id="page-top">

    <div class="modal fade" id="monModal" tabindex="-1" aria-labelledby="monModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header text-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <h5 class="modal-title" id="monModalLabel">Informations de rappel d'urgence</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <div class="col-sm-4">
                    Nombre de produits sans date de péremption : <?php echo count($peremption); ?>
                    
                </div>
                <div class="col-sm-4">
                    Doublons de produits : <?php echo count($doublonproduit) ?>
                    
                </div>
                <div class="col-sm-4">
                    Produits périmés ou proches de la péremption lot 1 (intervalle de 6 mois) : <?php echo count($moiperemtion) ?>
                    
                </div>
                <div class="col-sm-4">
                    Commande Poussin Non Livrée : <?php echo count($produit->CommandePoussinNonLivrer()) ?>
                </div>
                <div class="col-sm-4">
                    Commande Client : <?php echo count($produit->CommandePoussinNonLivrer()); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
           <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> -->
            <a href="phpphamacie/pdf/getinforapelle.php" type="button" class="btn btn-success" ><i class="fa fa-download" aria-hidden="true"></i>Produit sans date</a>
            <a href="phpphamacie/pdf/getperemption.php" type="button" class="btn btn-success" ><i class="fa fa-download" aria-hidden="true"></i>Péremption ou Proche</a>
            <a href="phpphamacie/pdf/getcondpoussin.php" type="button" class="btn btn-success" ><i class="fa fa-download" aria-hidden="true"></i>Poussins non livrés</a>
            <a href="phpphamacie/client/commandeliste.php" type="button" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i> Liste des commandes clients</a>
        </div>
        </div>
    </div>
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
         
        <?php 
            require_once("headerphamacie.php"); 
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column ">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                  <?php require_once("Topbar.php"); ?>  
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="phpphamacie/rapport/rapport.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <a href="home.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                 Provenderie</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="phpphamacie/achat/liste.php">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    ACHAT (MONTANT)</div>
                                                <?php 
                                                    global $conn;
                                                    if (($_SESSION["route"] == "cabinet")) {
                                                        $sql = "SELECT SUM(montant) as montant FROM achatphamacie WHERE MONTH(dateachat) = MONTH(NOW())";
                                                    } else {
                                                        $sql = "SELECT SUM(montant) as montant FROM achat WHERE MONTH(dateachat) = MONTH(NOW())";
                                                    }
                                                    
                                                    $result = $conn->query($sql);
                                                    $row = mysqli_fetch_assoc($result);
                                                    
                                                    $nbetoile = 10;
                                                    $etoile = "*";
                                                    for ($i=0; $i <$nbetoile ; $i++) { 
                                                        $etoile .= "*";
                                                    }
                                                    $montant = 0;
                                                    if (!empty($row["montant"])) {
                                                        $montant = $row["montant"];
                                                    }
                                                    echo '<span  id="achat">'.$etoile.'</span>';
                                                    echo '<div class="h5 mb-0 font-weight-bold text-gray-800 amount" id="montantachat">'.ceil($montant).' FCFA'.'</div>'; 
                                                        
                                                ?>
                                            </div>
                                        </a>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <a href="phpphamacie/vente/liste.php" >
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                VENTE (MONTANT)</div>
                                                    <?php 
                                                    global $conn;
                                                        $sql = "SELECT SUM(prix) as montant FROM ventephamacie  WHERE MONTH(datevente) = MONTH(NOW()) AND typevente ='CASH'"; 
                                                    $result = $conn->query($sql);
                                                    $row = mysqli_fetch_assoc($result);
                                                    $nbetoile = 10;
                                                    $etoile = "*";
                                                    for ($i=0; $i <$nbetoile ; $i++) { 
                                                        $etoile .= "*";
                                                    }
                                                    $montant = 0;
                                                    if (!empty($row["montant"])) {
                                                        $montant = $row["montant"];
                                                    }
                                                    echo '<span  id="vente">'.$etoile.'</span>';
                                                    echo '<div class="h5 mb-0 font-weight-bold text-gray-800 amount" id="montantvente">'.ceil($montant).' FCFA'.'</div>'; 
                                                    
                                                    ?>
                                            </div>
                                        </a>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Earnings (Monthly) Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <a href="phpphamacie/dette/dette.php">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                DETTE (MONTANT)</div>
                                                <?php 
                                                global $conn;
                                                if (($_SESSION["route"] == "cabinet")) {
                                                    $sql = "SELECT SUM(prix) as montant FROM ventephamacie WHERE MONTH(datevente) = MONTH(NOW()) AND typevente ='CREDIT'";

                                                } else {
                                                    $sql = "SELECT SUM(prix) as montant FROM vente WHERE MONTH(datevente) = MONTH(NOW()) AND typevente ='CREDIT'";

                                                }
                                                $result = $conn->query($sql);
                                                $row = mysqli_fetch_assoc($result);
                                                $nbetoile = 10;
                                                    $etoile = "*";
                                                    for ($i=0; $i <$nbetoile ; $i++) { 
                                                        $etoile .= "*";
                                                    }
                                                    
                                                    echo '<span  id="dette">'.$etoile.'</span>';
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800 text-danger amount " id="montantdette">'.$row["montant"].' FCFA'.'</div>'; 
                                                
                                            ?>
                                        </div>
                                        </a>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <a href="phpphamacie/dette/dette.php">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                VERSEMENT (MONTANT)</div>
                                                <?php 
                                                global $conn;
                                                if (($_SESSION["route"] == "cabinet")) {
                                                    $sql = "SELECT SUM(montant) as montant FROM versementphamacie  WHERE MONTH(dateversement) = MONTH(NOW())";

                                                } else {
                                                    $sql = "SELECT SUM(montant) as montant FROM versement WHERE MONTH(dateversement) = MONTH(NOW())";

                                                }
                                                $result = $conn->query($sql);
                                                $row = mysqli_fetch_assoc($result);
                                                $nbetoile = 10;
                                                    $etoile = "*";
                                                    for ($i=0; $i <$nbetoile ; $i++) { 
                                                        $etoile .= "*";
                                                    }
                                                    $montant = 0;
                                                    if (!empty($row["montant"])) {
                                                        $montant = $row["montant"];
                                                    }
                                                    echo '<span  id="verse">'.$etoile.'</span>';
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800 text-danger amount" id="monversement">'.ceil($montant).' FCFA'.'</div>'; 
                                                
                                            ?>
                                        </div>
                                        </a>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="phpphamacie/caisse/liste.php">
                                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                    CAISSE (MONTANT)</div>
                                                    <?php 
                                                        global $conn;
                                                        if (($_SESSION["route"] == "cabinet")) {
                                                            $sql = "SELECT SUM(montant) as montant FROM caissePhamacie WHERE MONTH(dateoperation) = MONTH(NOW())";

                                                        } else {
                                                            $sql = "SELECT SUM(montant) as montant FROM caisse WHERE MONTH(dateoperation) = MONTH(NOW())";

                                                        }
                                                        $result = $conn->query($sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        $nbetoile = 10;
                                                        $etoile = "*";
                                                        for ($i=0; $i <$nbetoile ; $i++) { 
                                                            $etoile .= "*";
                                                        }
                                                        $montant = 0;
                                                    if (!empty($row["montant"])) {
                                                        $montant = $row["montant"];
                                                    }
                                                        echo '<span  id="caise">'.$etoile.'</span>';
                                                        echo '<div class="h5 mb-0 font-weight-bold text-gray-800 text-danger amount"  id="montcaise">'.ceil($montant).' FCFA'.'</div>'; 
                                                    
                                                    ?>
                                                </div>
                                            </a>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="phpphamacie/depenses/liste.php">
                                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                    DÉPENSE (MONTANT)</div>
                                                    <?php 
                                                        global $conn;
                                                        if (($_SESSION["route"] == "cabinet")) {
                                                            $sql = "SELECT SUM(montant) as montant FROM depensephamacie  WHERE MONTH(datedepense) = MONTH(NOW())";

                                                        } else {
                                                            $sql = "SELECT SUM(montant) as montant FROM depenses WHERE MONTH(datedepense) = MONTH(NOW())";

                                                        }
                                                        $result = $conn->query($sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        $nbetoile = 10;
                                                        $etoile = "*";
                                                        for ($i=0; $i <$nbetoile ; $i++) { 
                                                            $etoile .= "*";
                                                        }
                                                         echo '<span  id="depense">'.$etoile.'</span>';
                                                        echo '<div class="h5 mb-0 font-weight-bold text-gray-800 text-danger amount" id="montdepense">'.$row["montant"].' FCFA'.'</div>'; 
                                                        
                                                    ?>
                                                </div>
                                            </a>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                       
                        <!-- Earnings (Monthly) Card Example -->
                          

                      
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Statistique semaine</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <button class="dropdown-item" onclick="affichemontant()">affiche</button>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider" ></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenues Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Achat
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> vente
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> dette
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> versement
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Stock de produit</h6>
                                </div>
                                <div class="card-body">
                                    <?php 
                                        global $conn;
                                        
                                        
                                        $tab = array("rouge"=>"",
                                            "jaune"=>"",
                                            "info"=>"",
                                            "success"=>""

                                        );
                                         
                                            $sql = "SELECT id,nom_produit as nom, quantite_produit as quantite FROM produitphamacie ORDER BY nom_produit ASC";

                                        $result = $conn->query($sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                            if($row["quantite"]<2){
                                                echo '<h4 class="small font-weight-bold">'.$row["nom"].'<span class="float-right">'.$row["quantite"].'</span></h4>';
                                                echo '<div class="progress mb-4">';
                                                echo '<div class="progress-bar bg-danger" role="progressbar" style="width:'.$row["quantite"].'%"
                                                aria-valuenow="3" aria-valuemin="0" aria-valuemax="100">'.'</div>';
                                                echo '</div>';
                                                
                                                
                                                echo "<hr>"; 
                                            }
                                            
                                        }
                                                    //var_dump($row);
                                    ?>
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Liste des 20 premiers clients</h6>
                                </div>
                                <div class="card-body">
                                <?php 
                                        global $conn;
                                        
                                        $tab = array("rouge"=>"",
                                            "jaune"=>"",
                                            "info"=>"",
                                            "success"=>""

                                        );
                                        
                                            $sql = "SELECT c.firstname, SUM(v.prix) AS somme, COUNT(v.id) as sommeFacture FROM ventephamacie v
                                                INNER JOIN client c WHERE c.id = v.idclient and MONTH(v.datevente) = MONTH(NOW()) 
                                                GROUP BY c.firstname 
                                                ORDER by SUM(v.prix) DESC 
                                                LIMIT 20";

                                         
                                        $result = $conn->query($sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                            
                                                echo '<h4 class="small font-weight-bold me-5"><hr></h4>';
                                                echo '<div class="row">';
                                                    echo '<div class="col-lg-3 mb-2">';
                                                    echo $row["firstname"];
                                                    echo '</div>';
                                                    echo '<div class="col-lg-5 mb-3">';
                                                    echo 'Montant : '.$row["somme"].'FCFA';
                                                    echo '</div>';

                                                    echo '<div class="col-lg-4 mb-4">';
                                                    echo 'NB Achat : '.$row["sommeFacture"];
                                                    echo '</div>';
                                                echo '</div>';
                                            
                                        }
                                                    //var_dump($row);
                                    ?>
                                    
                                </div>
                            </div>

                        </div>    
                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="text-center">
                                    <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Quantité Vendue</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                    <hr>
                                    
                                </div>
                            </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Top 20 des Produits les plus Venduent</h6>
                                </div>
                                <div class="card-body">
                                    <?php 
                                        global $conn;
                                        
                                        $tab = array("rouge"=>"",
                                            "jaune"=>"",
                                            "info"=>"",
                                            "success"=>""

                                        );
                                        
                                            $sql = "SELECT COUNT(f.idproduit) , f.nomproduit, p.quantite_produit,SUM(f.quantite) as quantite_vendu 
                                                    FROM facturephamacie f 
                                                    INNER JOIN produitphamacie p
                                                    WHERE month(f.datefacture) = month(now()) AND f.idproduit = p.id
                                                    GROUP BY f.nomproduit 
                                                    ORDER BY COUNT(f.idproduit) DESC 
                                                    LIMIT 20";

                                        
                                        $result = $conn->query($sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                            
                                                echo '<h4 class="small font-weight-bold">'.$row["nomproduit"].'<span class="float-right">'.$row["quantite_vendu"].'</span></h4>';
                                                echo '<div class="progress mb-4">';
                                                echo '<div class="progress-bar bg-danger" role="progressbar" style="width:'.$row["quantite_vendu"].'%"
                                                aria-valuenow="3" aria-valuemin="0" aria-valuemax="100">'.'</div>';
                                                echo '</div>';
                                            
                                        }
                                                    //var_dump($row);
                                    ?>
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Date de péremption des produits</h6>
                                </div>
                                <div class="card-body">
                                    <?php 
                                        global $conn;
                                        
                                        $tab = array("rouge"=>"",
                                            "jaune"=>"",
                                            "info"=>"",
                                            "success"=>""

                                        );
                                        
                                            $sql = "SELECT p.nom_produit, p.datePeramtion as lot1, l.date_expiration AS lot2 
                                            FROM produitphamacie p 
                                            LEFT JOIN lots l ON p.id = l.idproduit 
                                            WHERE p.quantite_produit>0 
                                            GROUP BY p.nom_produit 
                                            ORDER BY p.nom_produit ASC";
                                        
                                        $result = $conn->query($sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                            
                                                echo '<h4 class="small font-weight-bold">'.$row["nom_produit"].'<span class="float-right">('
                                                .$row["lot1"].')</span>'.'<span class="float-right"><---></span>'.'<span class="float-right">('.'  '.$row["lot2"].')</span></h4>';
                                                echo '<hr>';
                                               
                                                
                                            
                                        }
                                                    //var_dump($row);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website <?php echo date('Y-m-d'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demophamacie/chart-area-semaine.js"></script>
    <script src="js/demophamacie/chart-bar-semain.js"></script>
    <script src="js/demophamacie/chart-pie-semain.js"></script>
    <script src="header.js"></script>
   
    <script>
        function affichemontant(params) {
            document.getElementById('achat').innerHTML= document.getElementById('montantachat').innerText;
            document.getElementById('depense').innerHTML= document.getElementById('montdepense').innerText;
            document.getElementById('dette').innerHTML= document.getElementById('montantdette').innerText;
            document.getElementById('caise').innerHTML= document.getElementById('montcaise').innerText;
            document.getElementById('verse').innerHTML= document.getElementById('monversement').innerText;
            document.getElementById('vente').innerHTML= document.getElementById('montantvente').innerText;//.style.display='block';
        }
        $(document).ready(function() {
            $('#monModal').modal('show');
        });
    </script>
    <?php ;?>
</body>
</html>