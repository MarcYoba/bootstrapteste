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
      .image-container {
    text-align: center;
    margin: 0px;
    background-image: url('img/active.jpeg'); 
    background-size: cover; 
    background-position: center; 
    
    }
    .footer {
  position: absolute;
  bottom: 0;
  width: 100%;
}
    
    </style>

</head>

<body class="bg-gradient-white image-container">
    
    
    <div class="container">  

        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-5 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <div class="row">
                        <li class="nav-item col-sm-3">
                        <a class="nav-link active" aria-current="page" href="#"></a>
                        </li>
                        <li class="nav-item col-sm-2">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item col-sm-2">
                        <a class="nav-link" href="#">Produit</a>
                        </li>

                        <form class="d-flex col-sm-5" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </ul>
                </div>
            </div>
        </nav>
        <br><br><br><br><br>
            <div class=" row">
                <!-- Nested Row within Card Body -->
                    
                    
                            <br>
                            <div class="col-md-3 mb-4 ">
                                <?php        
                                                session_start();

                                                 if (($_SESSION['zonetravail'] == "provenderie") || ($_SESSION["zonetravail"] == "Tous")) {
                                                    echo '<a  href="home.php" class="btn btn-primary btn-user btn-block" >
                                                    <div class="card border-left-primary shadow h-100 py-2 rounded-circle">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">';
                                                   
                                                    echo '<div class="text-xs font-weight-bold text-white text-uppercase mb-1 btn btn-success btn-lg">';
                                                    echo  '<h3> Provenderie </h3></div>';
                                                 
                                                    echo '</div>
                                                    </div>
                                                </div>
                                            </div>
                                            </a>';
                                            }          
                                    ?>
                            </div>
                                <div class="col-md-3 mb-4">
                                <?php           
                                    if (($_SESSION["zonetravail"] == "cabinet") || ($_SESSION["zonetravail"] == "Tous")) {
                                    echo '<a href="homepahamacie.php">
                                    <div class="card border-left-success shadow h-100 py-2 rounded-circle">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">';
                                                    echo '<div class="text-xs font-weight-bold text-white text-uppercase mb-1 btn btn-success btn-lg">';
                                                    echo '<h3>Cabinet</h3></div>';
                                                    echo' </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </a>';
                                                   
                                    }   
                                    ?>
                                </div>

                                <br>
                                <div class="col-md-3 mb-4">
                                <?php           
                                    if (($_SESSION["zonetravail"] == "spaceclie") || ($_SESSION["zonetravail"] == "Tous")) {
                                    echo '<a href="#">
                                    <div class="card border-left-success shadow h-100 py-2 rounded-circle">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">';
                                                    echo '<div class="text-xs font-weight-bold text-white text-uppercase mb-1 btn btn-success btn-lg">';
                                                    echo  '<h3> Space Clients </h3></div>';
                                                    echo' </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </a>';
                                                   
                                    }   
                                    ?>
                                </div>
                            </div> 
                    
                </div>
            </div>
        

    </div>
    
    <footer class="footer bg-dark text-light">
        
            <div class="row">
            <div class="col-md-6">
                <h5>About Us</h5>
                <p>L'entreprise AB GROUP met a votre disposition un cabinet vétérinaire et une provenderie avec les services suivants: <br>
                 - clinique( vaccination, hospitalisation)<br>
                  - pharmacie ( vente en détail et en gros des produits vétérinaires)</p>
            </div>
            <div class="col-md-2">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                <li><i class="fas fa-map-marker-alt"></i> Yaounde</li>
                <li><i class="fas fa-phone"></i> 237 676359056<br>
                655271506<br> YAOUNDE, Soa</li>
                <li><i class="fas fa-envelope"></i> me@gmail.coms</li>
                </ul>
            </div>
            </div>
            <div class="row">
            <!--<div class="col-md-12 text-center">
                
                <ul class="list-inline">
                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div> -->
            </div>
    </footer>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages  homepahamacie.php -->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>