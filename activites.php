<?php session_start(); ?>

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
      body {
    margin: 0;
    overflow: hidden; /* Empêche le défilement normal */
    }

    .background-images {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1; /* Place les images en arrière-plan */
    }

    .background-images img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ajuste l'image pour couvrir tout l'espace */
        transition: transform 60s linear; /* Durée et type de transition */
    }
    
    </style>

</head>

<body class="bg-gradient-white background-images">
    

    
    <div class="container ">  

    <img src="img/unpoussinquieclot.jpg" alt="Image 1">
    <img src="img/unpoussinquisepromene.jpg" alt="Image 2">
    <img src="img/cabinet.jpg" alt="Image 3">
    <img src="img/provenderie.jpg" alt="Image 4">
    <img src="img/phamcie.jpg" alt="Image 5">

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
        <br>
            <div class="form-group row">
                <!-- Nested Row within Card Body -->
                <div class="col-xl-8 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <!-- Card Body -->
                            <div class="card-body">
                                    <div class=" pt-1 pb-1">
                                        
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <!-- Card Body -->
                            <div class="card-body">
                                <div class=" pt-1 pb-1">
                                        <?php        
                                            if (($_SESSION['zonetravail'] == "provenderie") || ($_SESSION["zonetravail"] == "Tous")) {
                                                echo '<a  href="home.php" class="btn btn-primary btn-user btn-block" >';
                                                echo  '<h3> Provenderie </h3></div>';
                                                echo '</a>';
                                            }          
                                        ?>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="form-group row">
                <!-- Nested Row within Card Body -->
                <div class="col-xl-8 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <!-- Card Body -->
                            <div class="card-body">
                                    <div class=" pt-4 pb-2">
                                        
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <!-- Card Body -->
                            <div class="card-body">
                                <div class=" pt-1 pb-1">
                                    <?php           
                                        if (($_SESSION["zonetravail"] == "cabinet") || ($_SESSION["zonetravail"] == "Tous")) {
                                            echo '<a href="homepahamacie.php">';
                                            echo '<div class="text-xs font-weight-bold text-white text-uppercase mb-1 btn btn-success btn-lg">';
                                            echo '<h3>Cabinet</h3></div>';
                                            echo' </a>';
                                                    
                                        }   
                                    ?>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Nested Row within Card Body -->
                <div class="col-xl-8 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <!-- Card Body -->
                            <div class="card-body">
                                    <div class=" pt-4 pb-2">
                                        
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <!-- Card Body -->
                            <div class="card-body">
                                <div class=" pt-1 pb-1">
                                <?php           
                                    if (($_SESSION["zonetravail"] == "spaceclie") || ($_SESSION["zonetravail"] == "Tous")) {
                                    echo '<a href="customer/client.php">';
                                    echo '<div class="text-xs font-weight-bold text-white text-uppercase mb-1 btn btn-success btn-lg">';
                                    echo  '<h3> Space Clients </h3></div>';
                                    echo'</a>';               
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
    <!-- Custom scripts for all pages  homepahamacie.php -->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        const images = document.querySelectorAll('.background-images img');
        let index = 0;

        function changeImage() {
            images[index].style.transform = 'translateY(-100%)';
            index++;
            if (index === images.length) {
                index = 0;
                images[index].style.transform = 'translateY(0)';
            }else{
                images[index].style.transform = 'translateY(0)';
                console.log(index);
            }
            
            
        }

        setInterval(changeImage, 60000); // Change d'image toutes les 10 secondes// Change d'image toutes les 2 secondes
    </script>

</body>

</html>