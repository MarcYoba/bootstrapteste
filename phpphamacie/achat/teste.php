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

    <title>Gestion de Stock</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="../../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Achat</h1>
                            </div>
                           <!-- <form class="user"  >-->
                                
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Tables des Achats</h6>
                                            <br>
                                            <div class="row">
                                                <p class="btn btn-warning btn-user col-md-2" onclick="ajouterLigne('dataTable', 
                                                5, 10)">ajouter achat</p>
                                                <p class="col-md-2" >quantite : <span id="quantitetotal">0</span></p>
                                                <p class="col-md-2" >prix : <span id="prixtotal">0</span></p>
                                                <p class="col-md-2" > Achat:<input type="date" class="form-control form-control-user" id="datefacture"
                                                name="datefacture" placeholder="date achat"></p>
                                                <p class="col-md-2" >Perantion:<input type="date" class="form-control form-control-user" id="peramtion"
                                                name="peramtion" placeholder="date achat"></p>
                                            </div>
                                            <span id="verificatiobDonne"></span>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                                                    <thead>
                                                    
                                                        <tr>
                                                            <th>Fourniseur</th>
                                                            <th>description</th>
                                                            <th>quantite</th>
                                                            <th>prix_unite</th>
                                                            <th>Mantant</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                       
                                                        
                                                    </tfoot>
                                                    <tbody>
                                                        <tr class="br-primary">
                                                            <th class = >
                                                            <div class="form-group ">
                                                                <select id="fournisseur"  name="fournisseur"  class="form-control form-select" required>
                                                                    <option selected> </option>
                                                                    <?php 
                                                                        global $conn;
                                                                        $sql = "SELECT id, nom FROM fournisseurphamacie";
                                                                        $result = $conn->query($sql);
                                                                        while ($row = mysqli_fetch_assoc($result)){
                                                                            echo "<option value='".$row["id"]."'>".$row["nom"]."</option>";
                                                                            //var_dump($row);
                                                                        }
                                                                    ?> 
                                                                </select>
                                                            </div>
                                                            </th>
                                                            <th>
                                                                <div class="form-group row">
                                                                
                                                                <!-- <input type="text" class="form-control form-control-user" id="Nomproduit"
                                                                    name="Nomproduit" placeholder="Nom produit" required> -->
                                                                    <select id="nomProduit"  name="nomProduit"  class="form-control form-select" required>
                                                                    <option selected></option>
                                                                    <?php 
                                                                        global $conn;
                                                                        $sql = "SELECT  nom_produit FROM produitphamacie ORDER BY nom_produit ASC";
                                                                        $result = $conn->query($sql);
                                                                        while ($row = mysqli_fetch_assoc($result)){
                                                                            
                                                                            echo "<option value='".$row["nom_produit"]."'>".$row["nom_produit"]."</option>";
                                                                            
                                                                            //var_dump($row);
                                                                        }
                                                                    ?>
                                                                    </select>
                                                                
                                                            </div>
                                                        </th>
                                                            <th> 
                                                                <input type="number" class="form-control form-control-user"
                                                                    name="quantite" id="quantite" placeholder="quantite" required>
                                                            </th>
                                                            <th>
                                                                <input type="number" class="form-control form-control-user"
                                                                name="prixglobal" id="prixglobal" placeholder="Prix du produit">   
                                                            </th>
                                                            <th>
                                                            <p class="form-control form-control-user" id="montanttotal">
                                                               <span id="resultat"></span> cfa
                                                            </p>   
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <button  class="btn btn-success btn-user btn-block" onclick="enregistrementDonnees('dataTable')">
                                                    Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    
                                </div>
                            <!--</form> -->
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
    <!--<script src="achat.js"></script>-->
    <script>
        function calculerTotal(ligneIndex){
            const quantite = document.getElementById(`cellule_dataTable_${ligneIndex * 3}`).textContent;
            const prix = document.getElementById(`cellule_dataTable_${ligneIndex * 3 + 1}`).textContent;
            const Totalcellule = document.getElementById(`cellule_dataTable_${ligneIndex * 3 + 2}`);

            const total = quantite * prix;

            Totalcellule.textContent = total;
        }
        
const  inputQuantite = document.getElementById("quantite");
const  inputPrix = document.getElementById("prixglobal");
var quantiteTotal = 0;
var prixtotal = 0;

function calculeprixTotalquantitetotal(){
    const tableau = document.getElementById('dataTable');
  
    for (let index = 2; index < tableau.rows.length; index++) {

        
        const cellule4 = tableau.rows[index].cells[2];
        const cellule5 = tableau.rows[index].cells[4];

        quantiteTotal += parseFloat(cellule4.textContent);
        prixtotal += parseFloat(cellule5.textContent);
        
    }
}

function calculeTotal(){
    
    document.getElementById("resultat").textContent = document.getElementById("quantite").value * document.getElementById("prixglobal").value;

    quantiteTotal = 0;
    prixtotal = 0;
    calculeprixTotalquantitetotal();
    document.getElementById("quantitetotal").innerHTML = quantiteTotal + parseFloat(document.getElementById("quantite").value);
    document.getElementById("prixtotal").textContent = prixtotal + parseFloat(document.getElementById("quantite").value * document.getElementById("prixglobal").value);
    document.getElementById("verificatiobDonne").innerHTML ='';
}
inputQuantite.addEventListener('input',calculeTotal);

inputPrix.addEventListener('input',calculeTotal)


function ajouterLigne(dataTable,...donnees){

    const  inputFournisseur = document.getElementById("fournisseur").value;
    const  inputDescrition = document.getElementById("nomProduit").value;
    const  inputQuantite = document.getElementById("quantite").value;
    const  inputPrix = document.getElementById("prixglobal").value;
    
    if (inputFournisseur !="" && inputDescrition !="" && inputQuantite !=0 && inputPrix !=0) {
        const tableau = document.getElementById(dataTable);
        document.getElementById("verificatiobDonne").innerHTML ='';
        //creer une nouvelle ligne
       const nouvelleLigne = tableau.insertRow();
       
        const nouvellecellule = nouvelleLigne.insertCell();
        const input = document.createElement('p');
        input.innerHTML = inputFournisseur;
        input.classList.add('form-control', 'form-control-user');
        nouvellecellule.appendChild(input);
    
        
        const nouvellecellule2 = nouvelleLigne.insertCell();
        const p2 = document.createElement('p');
        p2.innerHTML = inputDescrition;
        p2.classList.add('form-control', 'form-control-user');
        nouvellecellule2.appendChild(p2);
    
        const nouvellecellule3 = nouvelleLigne.insertCell();
        const p3 = document.createElement('p');
        p3.innerHTML = inputQuantite;
        p3.classList.add('form-control', 'form-control-user');
        nouvellecellule3.appendChild(p3);
    
        const nouvellecellule4 = nouvelleLigne.insertCell();
        const p4 = document.createElement('p');
        p4.innerHTML = inputPrix;
        p4.classList.add('form-control', 'form-control-user');
        nouvellecellule4.appendChild(p4);
    
        const nouvellecellule5 = nouvelleLigne.insertCell();
        const p5 = document.createElement('p');
        p5.innerHTML = (inputQuantite * inputPrix);
        p5.classList.add('form-control', 'form-control-user');
        nouvellecellule5.appendChild(p5);
    
        quantiteTotal = 0;
        prixtotal = 0;
        calculeprixTotalquantitetotal();
        document.getElementById("quantitetotal").innerHTML = quantiteTotal;
        document.getElementById("prixtotal").textContent = prixtotal;
        document.getElementById("quantite").value='';
        document.getElementById("prixglobal").value='';
       // document.getElementById("prixtotal").textContent = '';
        document.getElementById("fournisseur").value='';
        document.getElementById("nomProduit").value='';  
    }
    else{
        document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-danger"> verifiez les donne enregistrer </p>';
    }
    
    
}



function enregistrementDonnees(){
    const tableau = document.getElementById('dataTable');
    const datevar = document.getElementById('datefacture').value;
    const datepremtion = document.getElementById('peramtion').value;
    console.log(datevar);

    let donnees = [];
    let data = {};
    if (tableau.rows.length >=3) {
        for (let index = 2; index < tableau.rows.length; index++) {

            const cellule1 = tableau.rows[index].cells[0];
            const cellule2 = tableau.rows[index].cells[1];
            const cellule3 = tableau.rows[index].cells[2];
            const cellule4 = tableau.rows[index].cells[3];
            const cellule5 = tableau.rows[index].cells[4];
    
            data.fournisseur = cellule1.textContent;
            data.produit = cellule2.textContent;
            data.quantite = cellule3.textContent;
            data.prix = cellule4.textContent;
            data.total = cellule5.textContent;
            data.datevalue = datevar;
            data.datepera = datepremtion;
            //console.log(data);
            donnees.push({...data});  //on peut aussi  declarer directement let data = {} dans la boucle pour redure le programme
            data.value++;
            //donnees.unshift(data);
            
        }
        //console.log(donnees);
        
        fetch('register.php',{
            method:'POST',
            headers:{
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(donnees)
        })
        .then(response => response.json())
        .then(data => { 
            if (data.success == true) {
                document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-info"> enregistrement des donne avec success </p>';
                window.location.href = "liste.php"
            }else{
                console.log(data);
            }
            
        })
        .catch(error => {
            console.error(error);
        });
        
      
    } else {
        document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-warning"> ajouter une ligne pour vendre </p>'; 
    }
    
}

        
        
function calculerTotal(ligneIndex){
    const quantite = document.getElementById(`cellule_dataTable_${ligneIndex * 3}`).textContent;
    const prix = document.getElementById(`cellule_dataTable_${ligneIndex * 3 + 1}`).textContent;
    const Totalcellule = document.getElementById(`cellule_dataTable_${ligneIndex * 3 + 2}`);

    const total = quantite * prix;

    Totalcellule.textContent = total;
}
    </script>

</body>
</html>