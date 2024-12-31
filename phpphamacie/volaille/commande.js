function calculerTotal(ligneIndex){
    const quantite = document.getElementById(`cellule_dataTable_${ligneIndex * 3}`).textContent;
    const prix = document.getElementById(`cellule_dataTable_${ligneIndex * 3 + 1}`).textContent;
    const Totalcellule = document.getElementById(`cellule_dataTable_${ligneIndex * 3 + 2}`);

    const total = quantite * prix;

    Totalcellule.textContent = total;
}

const  inputQuantite = document.getElementById("Quantite");
const  inputPrix = document.getElementById("unite");
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
    
    

    quantiteTotal = 0;
    prixtotal = 0;
    calculeprixTotalquantitetotal();
    document.getElementById("quantitetotal").innerHTML = quantiteTotal + parseFloat(document.getElementById("Quantite").value);
    document.getElementById("prixtotal").textContent = prixtotal + parseFloat(document.getElementById("Quantite").value * document.getElementById("unite").value);
    document.getElementById("verificatiobDonne").innerHTML ='';
}
inputQuantite.addEventListener('input',calculeTotal);

inputPrix.addEventListener('input',calculeTotal)


function ajouterLigne(dataTable,...donnees){

    const  inputFournisseur = document.getElementById("fournisseur").value;
    const  inputDescrition = document.getElementById("souche").value;
    const  inputmontant = document.getElementById("montant").value;
    const  inputStatus = document.getElementById("status").value;

    if (inputFournisseur !="" && inputDescrition !="" && inputQuantite !=0) {
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
    p3.innerHTML = inputmontant;
    p3.classList.add('form-control', 'form-control-user');
    nouvellecellule3.appendChild(p3);

    const nouvellecellule4 = nouvelleLigne.insertCell();
    const p4 = document.createElement('p');
    p4.innerHTML = inputStatus;
    p4.classList.add('form-control', 'form-control-user');
    nouvellecellule4.appendChild(p4);

    document.getElementById("fournisseur").value ='';
    cdocument.getElementById("souche").value='';
    document.getElementById("montant").value='';
    document.getElementById("status").value='';
    }
    else{
    document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-danger"> verifiez les donne enregistrer </p>';
    }
}

function ajouter(dataTable,...donnees){

    const  inputFournisseur = document.getElementById("fournisseur1").value;
    const  inputDescrition = document.getElementById("Quantite").value;
    const  inputmontant = document.getElementById("unite").value;
    const  inputStatus = document.getElementById("status1").value;

    if (inputFournisseur !="" && inputDescrition !="" && inputQuantite !=0) {
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
    p3.innerHTML = inputmontant;
    p3.classList.add('form-control', 'form-control-user');
    nouvellecellule3.appendChild(p3);

    const nouvellecellule4 = nouvelleLigne.insertCell();
    const p4 = document.createElement('p');
    p4.innerHTML = inputStatus;
    p4.classList.add('form-control', 'form-control-user');
    nouvellecellule4.appendChild(p4);

    document.getElementById("fournisseur").value ='';
    cdocument.getElementById("souche").value='';
    document.getElementById("unite").value='';
    document.getElementById("status").value='';
    }
    else{
    document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-danger"> verifiez les donne enregistrer </p>';
    }
}



function enregistrementDonnees(){
    const tableau = document.getElementById('dataTable');
    const datevar = document.getElementById('datefacture').value;
    console.log(datevar);

    let donnees = [];
    let data = {};
    if (tableau.rows.length >=3) {
    for (let index = 2; index < tableau.rows.length; index++) {

        const cellule1 = tableau.rows[index].cells[0];
        const cellule2 = tableau.rows[index].cells[1];
        const cellule3 = tableau.rows[index].cells[2];
        const cellule4 = tableau.rows[index].cells[3];
        //const cellule5 = tableau.rows[index].cells[4];

        data.fournisseur = cellule1.textContent;
        data.souche = cellule2.textContent;
        data.montant = cellule3.textContent;
        data.status = cellule4.textContent;
    // data.total = cellule5.textContent;
        data.datevalue = datevar;
        //console.log(data);
        donnees.push({...data});  //on peut aussi  declarer directement let data = {} dans la boucle pour redure le programme
        data.value++;
        //donnees.unshift(data);
        
    }
    //console.log(donnees);

    fetch('registerfourniseur.php',{
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
            window.location.href = "listecommande.php"
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

function enregistrement(){
    const tableau = document.getElementById('dataTable1');
    const datevar = document.getElementById('datefacture').value;
    console.log(datevar);

    let donnees = [];
    let data = {};
    if (tableau.rows.length >=3) {
    for (let index = 2; index < tableau.rows.length; index++) {

        const cellule1 = tableau.rows[index].cells[0];
        const cellule2 = tableau.rows[index].cells[1];
        const cellule3 = tableau.rows[index].cells[2];
        const cellule4 = tableau.rows[index].cells[3];
        //const cellule5 = tableau.rows[index].cells[4];

        data.fournisseur = cellule1.textContent;
        data.souche = cellule2.textContent;
        data.montant = cellule3.textContent;
        data.status = cellule4.textContent;
    // data.total = cellule5.textContent;
        data.datevalue = datevar;
        //console.log(data);
        donnees.push({...data});  //on peut aussi  declarer directement let data = {} dans la boucle pour redure le programme
        data.value++;
        //donnees.unshift(data);
        
    }
    //console.log(donnees);

    fetch('registerfourniseur.php',{
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
            window.location.href = "listecommande.php"
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

function afficherFormulaire() {
document.getElementById("formulaire").style.display = "block";
}

function afficherlivraison(){
document.getElementById("livraison").style.display = "block";
}