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
    margin: 20px;
    background-image: url('img/poul1.jpg'); 
    background-size: cover; 
    background-position: center; 
    }
    </style>

</head>

<body class="bg-gradient-primary">

    <br><br><br><br><br>
    <div class="container">
        
        <div class="card o-hidden border-0 shadow-lg my-5 image-container">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <br>
                    <div class="col-lg-5 d-none d-lg-block bg-register-image ">
                        
                </div>
                    <div class="col-lg-5">
                            <br>
                            <div class="col-xl-5 col-md-5 mb-4">
                            <?php        
                                                session_start();
                                                
                                                 if (($_SESSION['zonetravail'] == "provenderie") || ($_SESSION["zonetravail"] == "Tous")) {
                                                    echo '<button class="btn btn-primary btn-user btn-block" onclick="Provenderie()">
                                                    <div class="card border-left-primary shadow h-100 py-2">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col mr-2">';
                                                   
                                                    echo '<div class="text-xs font-weight-bold text-white text-uppercase mb-1 btn btn-success btn-lg">';
                                                    echo  '<h3> Provenderie </h3></div>';
                                                 
                                                    echo '</div>
                                                    </div>
                                                </div>
                                            </div>
                                            </button>';
                                            }          
                                    ?>
                                </div>

                                <br>
                                <div class="col-xl-5 col-md-4 mb-4">
                                <?php           
                                    if (($_SESSION["zonetravail"] == "cabinet") || ($_SESSION["zonetravail"] == "Tous")) {
                                    echo '<a href="home.php" onclick="Cabinet()">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-1">';
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
                                <div class="col-xl-5 col-md-4 mb-4">
                                <?php           
                                    if (($_SESSION["zonetravail"] == "spaceclie") || ($_SESSION["zonetravail"] == "Tous")) {
                                    echo '<a href="#">
                                    <div class="card border-left-success shadow h-100 py-4">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-3">';
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
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="header.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>