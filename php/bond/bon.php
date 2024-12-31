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
                                    <div class="col-sm-10 ">
                                    <h6 class="m-0 font-weight-bold text-primary">Enregistrer la facture ( Bon de comande livrer)</h6>
                                    </div>
                                    <div class="col-sm-2 ">
                                    <a class="m-0 font-weight-bold text-warning" href="../achat/liste.php">Retour</a>
                                    </div>
                            </div>
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    Photo de la facture : <input type="file" class="form-control form-control-user" id="image"
                                           name="image" placeholder="Ima de la facture" required>
                                    </div>
                                    <div class="col-sm-6">
                                    date Achat :<input type="date" class="form-control form-control-user" id="date" 
                                           name="date" placeholder="" required>
                                    </div>
                                </div>
                                <div id="imageContainer"></div>
                                <span id="enregistrement">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-user btn-block">
                                    Enregistrer
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

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>
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