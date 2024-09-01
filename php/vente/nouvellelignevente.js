
const  inputQuantite = document.getElementById("quantite");
const  inputPrix = document.getElementById("prixglobal");
const  inputproduit = document.getElementById("nomProduit");
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
function recherchePrix(){
    
    let data = {};
    const nomproduit  = document.getElementById("nomProduit").value ;
    //console.log(nomproduit);
    data.nom = nomproduit;
    //console.log(data);

    fetch('getdata.php',{
        method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => { 
        if (data.success == true) {
            if (data.quantite <= 10) {
                document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-warning"> Rupture de stock en cour : '+data.quantite+'</p>';
                if (data.quantite >= 1 && data.quantite <= 5) {
                   document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-danger"> fin de stock pour ce produit: '+data.quantite+'</p>';  
                   //document.getElementById("enregistremet").innerHTML = '<button  class="btn btn-primary btn-user btn-block" onclick="enregistrementDonnees('+'dataTable'+')" disabled>Enregistrer</button>'
                }else if(data.quantite <= 0){
                    document.getElementById("enregistremet").innerHTML = '<button  class="btn btn-primary btn-user btn-block" onclick="enregistrementDonnees('+'dataTable'+')" >Enregistrer</button>'
                }
            } else {
                document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-info"> stock en cour : '+data.quantite+'</p>';
                document.getElementById("enregistremet").innerHTML = '<button  class="btn btn-primary btn-user btn-block" onclick="enregistrementDonnees('+'dataTable'+')" >Enregistrer</button>'
            }
            document.getElementById("prixglobal").value = data.message;
            console.log(data);
        }else if(data.success == false){
        }else{
            console.log(data);
        }     
    })
    .catch(error => {
        console.error(error);
    });
       
}

inputQuantite.addEventListener('input',calculeTotal);
inputPrix.addEventListener('input',calculeTotal);
//inputproduit.addEventListener('select',recherchePrix)

function ajouterLigne(dataTable,...donnees){

    const  inputFournisseur = document.getElementById("fournisseur").value;
    const  inputDescrition = document.getElementById("nomProduit").value;
    const  inputQuantite = document.getElementById("quantite").value;
    const  inputPrix = document.getElementById("prixglobal").value;
    const  Typepaiement = document.getElementById("Typepaiement").value;

    if (inputFournisseur !="" && inputDescrition !="" && inputQuantite !=0 && inputPrix !=0 && Typepaiement !="") {
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

        const nouvellecellule6 = nouvelleLigne.insertCell();
        const p6 = document.createElement('p');
        p6.innerHTML = Typepaiement;
        p6.classList.add('form-control', 'form-control-user');
        nouvellecellule6.appendChild(p6);
    
        quantiteTotal = 0;
        prixtotal = 0;
        calculeprixTotalquantitetotal();
        document.getElementById("quantitetotal").innerHTML = quantiteTotal;
        document.getElementById("prixtotal").textContent = prixtotal;
        document.getElementById("quantite").value='';
        document.getElementById("prixglobal").value='';
       // document.getElementById("prixtotal").textContent = '';
        document.getElementById("resultat").innerHTML='';
        document.getElementById("nomProduit").value='';  
       // document.getElementById("Typepaiement").value='';
    }
    else{
        document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-danger"> verifiez les donne enregistrer </p>';
    }
    
    
}



function enregistrementDonnees(){
    const tableau = document.getElementById('dataTable');
    const datevente = document.getElementById('datevente').value;
    let donnees = [];
    let data = {};
    
    if (tableau.rows.length>=3) {
        for (let index = 2; index < tableau.rows.length; index++) {

            const cellule1 = tableau.rows[index].cells[0];
            const cellule2 = tableau.rows[index].cells[1];
            const cellule3 = tableau.rows[index].cells[2];
            const cellule4 = tableau.rows[index].cells[3];
            const cellule5 = tableau.rows[index].cells[4];
            const cellule6 = tableau.rows[index].cells[5];
    
            data.fournisseur = cellule1.textContent;
            data.produit = cellule2.textContent;
            data.quantite = cellule3.textContent;
            data.prix = cellule4.textContent;
            data.total = cellule5.textContent;
            data.typepaie = cellule6.textContent;
            data.date = datevente;
            //console.log(data);
            donnees.push({...data});  //on peut aussi  declarer directement let data = {} dans la boucle pour redure le programme
            data.value++;
            //donnees.unshift(data);
            
        }
       // console.log(datevente);
        
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
                window.location.href = "vente.php";
                console.log(data);
            }else if(data.success == false){
                document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-danger"> Verifier que le produit ne sont conforme </p>';
            }else{
                console.log(data);
            }     
        })
        .catch(error => {
            console.error(error);
        });
        
       /*
       //console.log(donnees);
       $.ajax({
        url:'register.php',
        type:'POST',
        data: JSON.stringify(donnees),
        contentType: 'application/json',
        success: function(data){
            console.log("success");
            console.log(data);
            //window.location.href="register.php";
        },
        error: function(error){
            console.error(error);
        }
       });
       */
    } else {
        document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-warning">ajouter la ligne en suite cliquer sur enregistrer  </p>';
    }
    
}