

var venteData = window.venteData;

var donneproduit = localStorage.getItem("produitData"); 
var produitData = JSON.parse(donneproduit);
if (produitData) {
    document.getElementById("Nomproduit").value = produitData.nom_produit;
    document.getElementById("typeProduit").value = produitData.type_produit;
    document.getElementById("prixvente").value = produitData.prix_produit_vente;
    document.getElementById("prixachat").value = produitData.prix_achat_produit;
    document.getElementById("InputQuantite").value = produitData.quantite_produit;
    document.getElementById("cathegorie").value = produitData.cathegorie;
    document.getElementById("reference").value = produitData.id;

    localStorage.removeItem("produitData");
    document.getElementById("buttonenregistrement").innerHTML = '<p  name="edit" id="edit" class="btn btn-warning btn-user btn-block" Onclick="SaveEdite()">Edite </p>';
}

console.log(venteData);

// fetch('produit.php',{
//     method:'POST',
//     headers:{
//         'Content-Type': 'application/json'
//     },
//     body: JSON.stringify(venteData)
// })
// .then(response => response.json())
// .then(data => { 
//     if (data.success == true) {
//         document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-info"> enregistrement des donne avec success </p>';
//         window.location.href="produit.php";
//         console.log(data);
//     }else if(data.success == false){
//         document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-danger"> Verifier que le produit ne sont conforme </p>';
//     }else{
//         console.log(data);
//     }     
// })
// .catch(error => {
//     console.error(error);
// });

function EditProduit(id) {
    fetch('Edite.php',{
        method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(id)
    })
    .then(response => response.json())
    .then(data => { 
        if (data.success == true) {
            console.log(data);
            
        }else if(data.success == false){
           
        }else{
            console.log(data);
            localStorage.setItem("produitData", JSON.stringify(data));
            window.location.href="produit.php";
        }     
    })
    .catch(error => {
        console.error(error);
    }); 
}

function SaveEdite(){
    let tab = {};

    tab.nom_produit = document.getElementById("Nomproduit").value;
    tab.type_produit = document.getElementById("typeProduit").value;
    tab.prix_produit_vente = document.getElementById("prixvente").value;
    tab.prix_achat_produit = document.getElementById("prixachat").value;
    tab.quantite_produit = document.getElementById("InputQuantite").value;
    tab.cathegorie = document.getElementById("cathegorie").value;
    tab.id = document.getElementById("reference").value;

    fetch('Edite.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(tab)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Réponse du serveur:', data);
        window.location.href= "liste.php";
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}