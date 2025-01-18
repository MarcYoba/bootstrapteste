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
                                        <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="clientselec">Selectionner le client</label>
                                        <input type="text" class="form-control form-control-user" id="FirstName"
                                            name="FirstName" placeholder="Recherche client" required onkeyup="myFunction()">
                                        <form class="user" action="selectinfo.php" method="post" >
                                        <select class="form-control form-select" id="clientselec" name="clientselec"  size="4" multiple aria-label="multiple select" onchange="rechercheclient()" >
                                            <option>Selectionner le client</option>
                                            <?php
                                                $data = $client->getClient();
                                                foreach ($data as $key => $value) {
                                                    echo '<option value="'.$value["id"].'">'.$value["firstname"].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="refecrence">Reference du client</label>
                                        <input type="text" class="form-control form-control-user" id="refecrence"
                                            name="refecrence" placeholder="refecrence client" required readonly>
                                            <br>
                                   <!-- <label for="telephone">Telephone client</label>
                                        <input type="text" class="form-control form-control-user" id="telephone"
                                            name="telephone" placeholder="telephone client" required readonly>
                                            <br>
                                    <label for="achat">Somme Achat</label>
                                            <input type="text" class="form-control form-control-user" id="achat"
                                            name="achat" placeholder="achat client" required readonly>
                                            <br>
                                    <label for="cash">Achat en Cash </label>
                                        <input type="text" class="form-control form-control-user" id="cash"
                                            name="cash" placeholder="cash client" required readonly>  
                                        <br>
                                    <label for="credit">Achat en Credit </label>
                                        <input type="text" class="form-control form-control-user" id="credit"
                                            name="credit" placeholder="credit client" required readonly>
                                            <br>
                                    <label for="OM">Achat en OM/MOMO </label>
                                        <input type="text" class="form-control form-control-user" id="OM"
                                            name="OM" placeholder="credit OM/MOMO" required readonly>
                                    <label for="banque">Achat bancaire </label>
                                        <input type="text" class="form-control form-control-user" id="OM"
                                            name="OM" placeholder="Achat bancaire" required readonly>
                                    </div>
                                </div>-->
                                <button type="submit" id="suivre" name="suivre" class="btn btn-primary btn-user btn-block">
                                        Suivre le client
                                </button>
                                </form>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                    
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
    
</body>
</html>