
const  inputQuantite = document.getElementById("quantite");
const  inputPrix = document.getElementById("prixglobal");
const  inputproduit = document.getElementById("nomProduit");
const  inputreduction = document.getElementById("reduction");
const data = JSON.parse(localStorage.getItem("myData"));


var quantiteTotal = 0;
var prixtotal = 0;
var reduction = 0;

function resetLigne(){
    calculeprixTotalquantitetotal();
   // calculeTotal();
    document.getElementById("quantite").value='';
        document.getElementById("prixglobal").value='';
       // document.getElementById("prixtotal").textContent = '';
        document.getElementById("resultat").innerHTML='';
        document.getElementById("nomProduit").value='';  
       // document.getElementById("Typepaiement").value='';
}

function getLigne(dataTable, ligne){
    const tableau = document.getElementById('dataTable');
  
    for (let index = 2; index <= tableau.rows.length; index++) {

        if (index == ligne) {
           //const cellule1 = tableau.rows[index-1].cells[0];
            const cellule2 = tableau.rows[index-1].cells[1];
            const cellule3 = tableau.rows[index-1].cells[2];
            const cellule4 = tableau.rows[index-1].cells[3];
            const cellule5 = tableau.rows[index-1].cells[4];
            
            //document.getElementById("fournisseur").value = cellule1.textContent;
            document.getElementById("nomProduit").value = cellule2.textContent;
            document.getElementById("quantite").value = cellule3.textContent;
            document.getElementById("prixglobal").value = cellule4.textContent;
           // document.getElementById("").value = cellule5.textContent;
            document.getElementById("modifierligne").innerHTML = '<p class="btn btn-info btn-user" onclick="Upgateligne('+ligne+')"><i class="fas fa-check"></i></p>';
            cellule4.textContent = 0;
            cellule3.textContent = 0
            cellule5.textContent = 0;
        }
        
        
    }
}

function Upgateligne(ligne){
     const tableau = document.getElementById('dataTable');
  
    for (let index = 2; index <= tableau.rows.length; index++) {

        if (index == ligne) {
           //const cellule1 = tableau.rows[index-1].cells[0];
            const cellule2 = tableau.rows[index-1].cells[1];
            const cellule3 = tableau.rows[index-1].cells[2];
            const cellule4 = tableau.rows[index-1].cells[3];
            const cellule5 = tableau.rows[index-1].cells[4];
            
            //document.getElementById("fournisseur").value = cellule1.textContent;
            cellule2.textContent= document.getElementById("nomProduit").value;
            cellule3.textContent=document.getElementById("quantite").value ;
            cellule4.textContent= document.getElementById("prixglobal").value ;
            cellule5.textContent = document.getElementById("resultat").textContent ;

            document.getElementById("modifierligne").innerHTML = ' ';
        } 
    }
    resetLigne();
}

function calculeReductionProduit(){
    reduction = document.getElementById("prixtotal").textContent; 
    //console.log();

    if((reduction > 0 ) && (document.getElementById("Total").value > 0)){
        document.getElementById("Total").value = (document.getElementById("prixtotal").textContent - document.getElementById("reduction").value);
        document.getElementById("verificatiobDonne").innerHTML ="";
    }else{
        document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-danger"> verifiez les donnees le montant ne peut pas etre negatif </p>';
        document.getElementById("Total").value = Math.ceil(document.getElementById("prixtotal").textContent - document.getElementById("reduction").value);
    }

}

function calculeprixTotalquantitetotal(){
    const tableau = document.getElementById('dataTable');

    quantiteTotal = 0;
    prixtotal = 0;
    for (let index = 2; index < tableau.rows.length; index++) {

        
        const cellule4 = tableau.rows[index].cells[2];
        const cellule5 = tableau.rows[index].cells[4];

        quantiteTotal += parseFloat(cellule4.textContent);
        prixtotal += parseFloat(cellule5.textContent);
        
    }
}

function calculeTotal(){
    let verQuantite = parseInt(document.getElementById("quantite").value);
    let stoQuantite = parseInt(document.getElementById("quantiteStokage").value);

    console.log("valeure : "+verQuantite);
    console.log("valeure : "+stoQuantite);

    if (verQuantite <= stoQuantite) {
        document.getElementById("resultat").textContent = document.getElementById("quantite").value * document.getElementById("prixglobal").value;

        quantiteTotal = 0;
        prixtotal = 0;
        calculeprixTotalquantitetotal();
        document.getElementById("quantitetotal").innerHTML = quantiteTotal + parseFloat(document.getElementById("quantite").value);
        document.getElementById("Total").value = Math.ceil(prixtotal + parseFloat(document.getElementById("quantite").value * document.getElementById("prixglobal").value));
        document.getElementById("prixtotal").textContent = Math.ceil(prixtotal + parseFloat(document.getElementById("quantite").value * document.getElementById("prixglobal").value));
        document.getElementById("verificatiobDonne").innerHTML =''; 
    }else{
        if (verQuantite>=0) {
            alert('Vous voulez faire une action impossible;  cette vente vous crée des  problèmes.  Est-ce que vous êtes sûre pour les problèmes ?'); 
            document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-danger"> Les quantite ne sont pas conforme  </p>';
        }
        
    }
    
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
                   document.getElementById("enregistremet").innerHTML = '<button  class="btn btn-primary btn-user btn-block" onclick="enregistrementDonnees('+'dataTable'+')" id="enregistrementBtn">Enregistrer</button>'
                   document.getElementById("quantiteStokage").value = data.quantite;
                }else if(data.quantite <= 0){
                    document.getElementById("quantiteStokage").value = data.quantite;
                    if (document.getElementById("modifiervente").textContent == "Modifier vente") {
                        
                    } else {
                        document.getElementById("enregistremet").innerHTML = '<button  class="btn btn-primary btn-user btn-block" onclick="enregistrementDonnees('+'dataTable'+')" id="enregistrementBtn">Enregistrer vente</button>';
                    }
                }
            } else {
                document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-info"> stock en cour : '+data.quantite+'</p>';
                document.getElementById("quantiteStokage").value = data.quantite;
                console.log(document.getElementById("modifiervente").textContent);
                document.getElementById("quantiteStokage").value = data.quantite;
                if (document.getElementById("modifiervente").textContent == "Modifier vente") {
                    
                } else {
                    document.getElementById("enregistremet").innerHTML = '<button  class="btn btn-primary btn-user btn-block" onclick="enregistrementDonnees('+'dataTable'+')" id="enregistrementBtn">Enregistrer vente</button>'
                }
            }
            document.getElementById("quantiteStokage").value = data.quantite;
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
inputreduction.addEventListener('input',calculeReductionProduit);

function ajouterLigne(dataTable,...donnees){
    calculeprixTotalquantitetotal();
    calculeTotal();
    const  inputFournisseur = document.getElementById("idclient").innerText;
    const  inputDescrition = document.getElementById("nomProduit").value;
    const  inputQuantite = document.getElementById("quantite").value;
    const  inputPrix = document.getElementById("prixglobal").value;
   // const  Typepaiement = document.getElementById("Typepaiement").value;

    if (inputFournisseur !="" && inputDescrition !="" && inputQuantite !=0 && inputPrix !=0 ) {
        const tableau = document.getElementById(dataTable);
        document.getElementById("verificatiobDonne").innerHTML ='';
        const nbligne = tableau.rows.length;
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
        p6.id = (nbligne +1);
        p6.innerHTML ='<a class="btn btn-primary" onclick="getLigne(dataTable,'+(nbligne +1)+')"><i class="fas fa-pencil-alt"></i></a>  ' + (nbligne +1);
       // p6.classList.add('form-control', 'form-control-user');
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


function recuperationdonneTable() {
    const tableau = document.getElementById('dataTable');
    const datevente = document.getElementById('datevente').value;
    let donnees = [];
    let data = {};
    
    if (tableau.rows.length >= 3 ) {
        for (let index = 2; index < tableau.rows.length; index++) {

            const cellule1 = tableau.rows[index].cells[0];
            const cellule2 = tableau.rows[index].cells[1];
            const cellule3 = tableau.rows[index].cells[2];
            const cellule4 = tableau.rows[index].cells[3];
            const cellule5 = tableau.rows[index].cells[4];
           // const cellule6 = tableau.rows[index].cells[5];
    
            data.fournisseur = cellule1.textContent;
            data.produit = cellule2.textContent;
            data.quantite = cellule3.textContent;
            data.prix = cellule4.textContent;
            data.total = cellule5.textContent;
           // data.typepaie = cellule6.textContent;
            data.date = datevente;
            //console.log(data);
            donnees.push({...data});  //on peut aussi  declarer directement let data = {} dans la boucle pour redure le programme
            data.value++;

        }
        data.momo = document.getElementById("momo").value;
        data.cash = document.getElementById("cash").value;
        data.credit = document.getElementById("credit").value;
        data.reduction = document.getElementById("reduction").value;
        data.Total = document.getElementById("Total").value;
        data.Qttotal = document.getElementById("quantitetotal").textContent;
        data.taille = tableau.rows.length;
        data.Banque = document.getElementById("Banque").value;
        data.esperce = document.getElementById("esperce").value;
        data.aliment = document.getElementById("aliment").value;
        data.statusvente = document.getElementById("statusvente").value;

        donnees.push({...data});  //on peut aussi  declarer directement let data = {} dans la boucle pour redure le programme
        data.value++;
        
        
        
    } else {
        document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-warning">ajouter la ligne en suite cliquer sur enregistrer  </p>';
    }


    return donnees;
}


function enregistrementBD(){
    document.getElementById("enregistrementBtn").style.display = 'none';
    let donnees =[];
    donnees = recuperationdonneTable();
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
            document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-info"> enregistrement des donne avec success</p>';
            window.location.href = 'facture.php?id='+ data.message;
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
    
}

function enregistrementDonnees(){
    let cahs = document.getElementById("cash").value;
    let credit = document.getElementById("credit").value;
    let momo = document.getElementById("momo").value;
    let banque = document.getElementById("Banque").value;
    let teste = document.getElementById("teste").textContent;
    somme = parseInt(momo) + parseInt(cahs)+parseInt(credit) + parseInt(banque) ;
    if ((somme) == (document.getElementById("Total").value)) 
    {
    
        if(document.getElementById("momo").value == 0){
            if (document.getElementById("cash").value == 0) {
                if (document.getElementById("credit").value == 0) {
                    if (document.getElementById("Banque").value ==0) {
                        document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-warning"> vous deviez enregistrer le montant OM/MOMO ou CASH/Banque ou Credit</p>';
                    } else {
                        if (teste == 0) {
                            document.getElementById("teste").innerText = 1;
                        }else{
                            window.location.href = 'liste.php'
                        }
                        enregistrementBD();
                    }
                } else {
                    
                    if (teste == 0) {
                        document.getElementById("teste").innerText = 1;
                    }else{
                        window.location.href = 'liste.php'
                    }
                    enregistrementBD();
                }
            } else {
                
                    if (teste == 0) {
                        document.getElementById("teste").innerText = 1;
                    }else{
                        window.location.href = 'liste.php'
                    }
                enregistrementBD(); 
            }
        }
        else{
                    if (teste == 0) {
                        document.getElementById("teste").innerText = 1;
                    }else{
                        window.location.href = 'liste.php'
                    }
            enregistrementBD();
        }
   
    } else {
        console.log("Om+CREDI+cash : "+somme);
        console.log("total : "+(document.getElementById("Total").value));
        document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-warning"> verifier le total des montants dans differents case</p>';  
    }
    
}

function LigneventeMofiier(donnees){
    const tableau = document.getElementById('dataTable');

   // const  Typepaiement = document.getElementById("Typepaiement").value; 
   // ajutement nom terminer.       

        
        const nbligne = tableau.rows.length;
        //creer une nouvelle ligne
       const nouvelleLigne = tableau.insertRow();
       
        const nouvellecellule = nouvelleLigne.insertCell();
        const input = document.createElement('p');
        input.innerHTML = donnees.idclient ;
        input.classList.add('form-control', 'form-control-user');
        nouvellecellule.appendChild(input);
    
        
        const nouvellecellule2 = nouvelleLigne.insertCell();
        const p2 = document.createElement('p');
        p2.innerHTML = donnees.nomproduit;
        p2.classList.add('form-control', 'form-control-user');
        nouvellecellule2.appendChild(p2);
    
        const nouvellecellule3 = nouvelleLigne.insertCell();
        const p3 = document.createElement('p');
        p3.innerHTML = donnees.quantite;
        p3.classList.add('form-control', 'form-control-user');
        nouvellecellule3.appendChild(p3);
    
        const nouvellecellule4 = nouvelleLigne.insertCell();
        const p4 = document.createElement('p');
        p4.innerHTML = donnees.prix;
        p4.classList.add('form-control', 'form-control-user');
        nouvellecellule4.appendChild(p4);
    
        const nouvellecellule5 = nouvelleLigne.insertCell();
        const p5 = document.createElement('p');
        p5.innerHTML = (donnees.montant);
        p5.classList.add('form-control', 'form-control-user');
        nouvellecellule5.appendChild(p5);
        
        const nouvellecellule6 = nouvelleLigne.insertCell();
        const p6 = document.createElement('p');
        p6.id = (nbligne +1);
        p6.innerHTML ='<a class="btn btn-primary" onclick="getLigne(dataTable,'+(nbligne +1)+')"><i class="fas fa-pencil-alt"></i></a>  ' + (nbligne +1);
       // p6.classList.add('form-control', 'form-control-user');
        nouvellecellule6.appendChild(p6);
        
        quantiteTotal =0;//+= donnees.quantite;
        prixtotal =0;//+= donnees.prix;

         calculeprixTotalquantitetotal();
         document.getElementById("quantitetotal").innerHTML = quantiteTotal;
         document.getElementById("prixtotal").textContent = prixtotal;
         document.getElementById("Total").value=prixtotal;
         document.getElementById("TypePaie").innerText = donnees.Typepaiement
        document.getElementById("TypePaie").style.display="block";
    //    // document.getElementById("prixtotal").textContent = '';
    //     document.getElementById("resultat").innerHTML='';
    //     document.getElementById("nomProduit").value='';  
    //    // document.getElementById("Typepaiement").value='';
    document.getElementById("idfacture").textContent = donnees.id;
    document.getElementById("idvente").textContent = donnees.idvente;
    
    
}
function editevente(){
    if (typeof data === 'undefined' || data === null) {
        console.log("La variable est undefined ou null");
      }else{
        
        data.forEach(element => {
           // console.log(element);
            LigneventeMofiier(element);
        });
        localStorage.removeItem('myData');
        document.getElementById("enregistremet").style.display="none";
      document.getElementById("modifiervente").innerHTML = '<button  class="btn btn-warning btn-user btn-block" onclick="saveedite()" >Modifier vente</button>';
    }
      

}
editevente();// affiche la vente


function enregistrementEdite(){
    let idfacture = document.getElementById("idfacture").textContent;
    let idvente = document.getElementById("idvente").textContent;

    let donnees =[];
    donnees = recuperationdonneTable();
    
    let data = {idvente,idfacture};
    donnees.push(data);  //on peut aussi  declarer directement let data = {} dans la boucle pour redure le programme
    //data.value++;
    //console.log(donnees);
    
    fetch('Edite.php',{
        method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(donnees)
    })
    .then(response => response.json())
    .then(data => { 
        if (data.success == true) {
            document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-info"> Modification des donnes avec success</p>';
            window.location.href = 'facture.php?id='+ data.message;
            console.log("edite : "+data);
        }else if(data.success == false){
            document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-danger"> Verifier que le produit ne sont conforme </p>';
        }else{
            console.log(data);
            window.location.href = 'liste.php';
        }     
    })
    .catch(error => {
        console.error(error);
    });
    
}

function saveedite(){
   let cahs = document.getElementById("cash").value;
    let credit = document.getElementById("credit").value;
    let momo = document.getElementById("momo").value;
    let banque = document.getElementById("Banque").value;
    let teste = document.getElementById("teste").textContent;
    somme = parseInt(momo) + parseInt(cahs)+parseInt(credit)+parseInt(banque) ;
    if ((somme) == (document.getElementById("Total").value)) 
    {
    
        if(document.getElementById("momo").value == 0){
            if (document.getElementById("cash").value == 0) {
                if (document.getElementById("credit").value == 0) {
                    if (document.getElementById("Banque").value==0) {
                        document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-warning"> vous deviez enregistrer le montant OM/MOMO ou CASH ou Credit</p>';
                        if (teste == 0) {
                            document.getElementById("teste").innerText = 1;
                        }else{
                            alert("Voullez - Vous Vraiment modifier cette facture ?");
                            document.getElementById("teste").innerText = 0;
                            enregistrementEdite()
                        }
                    } else {
                        enregistrementEdite()
                    }
                } else {
                    enregistrementEdite()
                }
            } else {
                enregistrementEdite() 
            }
        }
        else{
            enregistrementEdite()
        }
   
    } else {
        console.log("Om+CREDI+cash : "+somme);
        console.log("total : "+(document.getElementById("Total").value));
        document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-warning"> corrigier le total des montants dans differents case OM/MOMO ou CASH ou Credit</p>';  
    }
}

function check(params) {
    
}

function Client(element){
    const nomClient  = document.getElementById("fournisseur").value ;
  
    fetch('getdata.php',{
        method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(nomClient)
    })
    .then(response => response.json())
    .then(data => { 
        document.getElementById("idclient").innerText = data.nom;
    })
    .catch(error => {
        console.error(error);
    });
       
  }

  function enregistremetnclient() {
    var nom = document.getElementById("recherche").value;
    var tel = document.getElementById("telephone").value;
    let infoclient ={};
    infoclient.nom = nom;
    infoclient.tephone = tel;

    fetch('../client/register.php',{
        method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(infoclient)
    })
    .then(response => response.json())
    .then(data => { 
        document.getElementById("verificatiobDonne").innerText = data;
        console.log(data);
        location.reload();
    })
    .catch(error => {
        console.error(error);
    });
  }

  function caculeReduction() {
    let resultreduction= parseFloat(document.getElementById("quantite").value)*parseFloat(document.getElementById("rp").value);
    document.getElementById("caculelreduction").value = parseFloat(document.getElementById("caculelreduction").value) + parseFloat(resultreduction);
    document.getElementById("rp").value = 0;
  }