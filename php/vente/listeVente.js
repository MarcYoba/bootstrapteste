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

function getVenteData(){
    fetch('../bdmutilple/getvente.php', {
        method: 'POST',
        body: JSON.stringify(),
        headers: {
          'Content-Type': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
        value = {};
        for(let propriete in data){
            value = data[propriete];
            //LigneTableau(value);
            console.log('Réponse du serveur :', value);
        }
        $('#dataTable').DataTable({
            data: data
        });
      })
      .catch(error => {
        console.error('Erreur lors de la requête :', error);
      });
};

//getVenteData();