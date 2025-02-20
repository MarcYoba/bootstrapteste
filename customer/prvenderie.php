<?php
session_start();
    require_once("getclient.php");
    $client = new Client(0);

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
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .drop{
            display: none;
        }
        #imageContainer {
        width: 21cm; /* Largeur d'une feuille A4 */
        height: 29.7cm; /* Hauteur d'une feuille A4 */
        border: 1px solid black;
        overflow: hidden;
        }

        #imageContainer img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        }
    </style>


</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">    
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <h1 class="h4 text-gray-900 mb-4">Vue Cleint</h1>
                                    </div>
                                    <div class="col-sm-2">
                                       <a href="../activites.php"> <h1 class="h4 text-gray-900 mb-4">Retour</h1> </a>
                                    </div>
                                </div>
                                <hr>

                                <div class="card shadow mb-4">
                                
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <form  action="selectinfo.php" method="post" class="user">
                                            <div class="form-group row">
                                            
                                                <div class="col-sm-5 mb-3 mb-sm-0">
                                                    
                                                    <label class="form-check-label" id="">mode de paiement de la facture : </label> 
                                                    <input type="text" name="reference" id="reference" value="<?php echo $_GET["id"];?>" readonly>
                                                </div>
                                                <div class="col-sm-2 mb-3 mb-sm-0">
                                                    <input class="form-check-input" type="checkbox" id="OM" name="OM" value="OM">
                                                    <label class="form-check-label" id="OM">OM</label>  
                                                </div>
                                                <div class="col-sm-2 mb-3 mb-sm-0">
                                                    <input class="form-check-input" type="checkbox" id="MOMO" name="MOMO" value="MOMO">
                                                    <label class="form-check-label" id="MOMO">MOMO</label>
                                                </div>

                                                <div class="col-sm-2 mb-3 mb-sm-0">
                                                    <input class="form-check-input" type="checkbox" id="BANQUE" name="BANQUE" value="BANQUE">
                                                    <label class="form-check-label" id="BANQUE">BANQUE</label>
                                                </div>
                                    
                                                
                                            </div>
                                            <div class="form-group row">
                                            
                                            <div class="col-sm-3 mb-3 mb-sm-0">
                                                <label class="form-check-label" id="">Numro telephone </label> 
                                                <input type="tel" name="reference" id="reference" value="0" class="form-control form-control-user" >
                                            </div>
                                            <div class="col-sm-3 mb-3 mb-sm-0">
                                                <label class="form-check-label" id="image">Photo de la facture </label> 
                                                 <input type="file" class="form-control form-control-user" id="image"
                                                    name="image" placeholder="Image de la facture" required>
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0">
                                                <label class="form-check-label" id="livre">Status Livraison</label>
                                                <select class="form-control form-control-user" id="livre" name="livre" required>
                                                    <option value="livre">Valider livre</option>
                                                    <option value="non livre" selected>Valider no livre</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-3 mb-3 mb-sm-0">
                                                <label class="form-check-label" id="aliment">Type d'aliment</label>
                                                <select class="form-control form-select" name="aliment" id="aliment" required>
                                                        <option value="PREDEMARRAGE">PREDEMARRAGE</option>
                                                        <option value="DEMARRAGE">DEMARRAGE</option>
                                                        <option value="CROISSANCE">CROISSANCE</option>
                                                        <option value="FINITION">FINITION</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <div class="col-sm-3 mb-3 mb-sm-0">
                                                <label class="form-check-label" id="">Quantite en KG </label> 
                                                <input type="number" name="kg" id="kg" value="0" class="form-control form-control-user" >
                                            </div>
                                            <div class="col-sm-3 mb-3 mb-sm-0">
                                                <label class="form-check-label" id="image">Quantite en SAC </label> 
                                                 <input type="number" class="form-control form-control-user" id="sac"
                                                    name="sac" placeholder="Image de la facture" value="0">
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0">
                                                <label class="form-check-label" id="livre">Status Livraison</label>
                                                <select class="form-control form-control-user" id="livre" name="livre" required>
                                                    <option value="livre">Valider livre</option>
                                                    <option value="non livre" selected>Valider no livre</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-3 mb-3 mb-sm-0">
                                                <label class="form-check-label" id="aliment">Type d'aliment</label>
                                                <select class="form-control form-select" name="aliment" id="aliment" required>
                                                        <option value="PREDEMARRAGE">PREDEMARRAGE</option>
                                                        <option value="DEMARRAGE">DEMARRAGE</option>
                                                        <option value="CROISSANCE">CROISSANCE</option>
                                                        <option value="FINITION">FINITION</option>
                                                    </select>
                                            </div>
                                
                                            
                                        </div>
                                        <button type="submit" id="enregistrer" name="enregistrer" class="btn btn-primary btn-user btn-block">
                                                    enregistrer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div id="imageContainer"></div>
                                <span id="enregistrement">
                                </div>
                            <!--</form> -->
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="client.js"></script>
    <script>
        const imageUpload = document.getElementById('image');
        const imageContainer = document.getElementById('imageContainer');

        imageUpload.addEventListener('change', () => {
        const file = imageUpload.files[0];
        const reader = new FileReader();

        reader.onload = (e) => {
            const img = new Image();
            img.src = e.target.result;
            imageContainer.appendChild(img);
        };

        reader.readAsDataURL(file);
        });
    </script>
    
</body>
</html>