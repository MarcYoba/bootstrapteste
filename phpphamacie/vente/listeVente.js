//const { data } = require("jquery");



const inputcash = document.getElementById("cash");
const inputcredit = document.getElementById("credit");
const inputom = document.getElementById("om");

function LigneTableau(data){
    
    const tableau = document.getElementById('dataTable');

    
       const nouvelleLigne = tableau.insertRow(1);
       const nouvellecellule = nouvelleLigne.insertCell();
        nouvellecellule.innerHTML = data.id;
       
    
        
        const nouvellecellule2 = nouvelleLigne.insertCell();
        nouvellecellule2.innerHTML = data.typevente;
        
    
        const nouvellecellule3 = nouvelleLigne.insertCell();
        nouvellecellule3.innerHTML = data.numfacture;
        
    
        const nouvellecellule4 = nouvelleLigne.insertCell();
        nouvellecellule4.innerHTML = data.quantite;
        
    
        const nouvellecellule5 = nouvelleLigne.insertCell();
        nouvellecellule5.innerHTML = data.prix;
     

        const nouvellecellule6 = nouvelleLigne.insertCell();
        nouvellecellule6.innerHTML = data.datevente;
        const nouvellecellule7 = nouvelleLigne.insertCell();
        nouvellecellule7.innerHTML = data.datevente;
       


}

function getVenteData(idvente){
  fetch('Edite.php', {
      method: 'POST',
      body: JSON.stringify(idvente),
      headers: {
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      value = {};
    // console.log(data);
      localStorage.setItem("myData", JSON.stringify(data));
      window.location.href = 'vente.php';

    })
    .catch(error => {
      console.error('Erreur lors de la requête :', error);
    });
};

function editefacture(){
  console.log(document.getElementById("id").innerText);
  getVenteData(document.getElementById("id").innerText);
}

function generatePDF() {
  // Récupérer les données du formulaire
  var formData = new FormData(document.getElementById("myForm"));

  // Envoyer les données au fichier PHP
  fetch('../pdf/getTypeVente.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.blob())
  .then(blob => {
    // Créer un lien de téléchargement
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = 'mon_fichier.pdf';
    link.click();
  })
  .catch(error => {
    console.error('Erreur lors de la génération du PDF:', error);
  });
}

function myFunction() {
  // Récupérer l'input et la liste déroulante
  var input, filter, ul, li, a, i;
  input = document.getElementById("recherche");
  filter = input.value.toUpperCase();
  ul = document.getElementById("fournisseur");
  li = ul.getElementsByTagName("option");

  // Boucler sur toutes les options
  for (i = 0; i < li.length; i++) {
    a = li[i];
    if (a.value.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
  
}

function myFunctionP() {
  // Récupérer l'input et la liste déroulante
  var input, filter, ul, li, a, i;
  input = document.getElementById("rechercheP");
  filter = input.value.toUpperCase();
  ul = document.getElementById("nomProduit");
  li = ul.getElementsByTagName("option");

  // Boucler sur toutes les options
  for (i = 0; i < li.length; i++) {
    a = li[i];
    if (a.value.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
  
}

function recherchduproduit() {
  // Récupérer l'input et la liste déroulante
  var input, filter, ul, li, a, i;
  input = document.getElementById("produitrecher");
  filter = input.value.toUpperCase();
  ul = document.getElementById("nomProduit");
  li = ul.getElementsByTagName("option");

  // Boucler sur toutes les options
  for (i = 0; i < li.length; i++) {
    a = li[i];
    if (a.value.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
  
}

function recherchduclient() {
  // Récupérer l'input et la liste déroulante
  var input, filter, ul, li, a, i;
  input = document.getElementById("clientrecher");
  filter = input.value.toUpperCase();
  ul = document.getElementById("client");
  li = ul.getElementsByTagName("option");
  console.log(li.length);
  // Boucler sur toutes les options
  for (i = 0; i < li.length; i++) {
    a = li[i];
    
    if (a.textContent.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
  
}

//getVenteData();