

function Provenderie() {
    console.log("send");
    fetch('route/route.php',{
        method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify("provenderie")
    })
    .then(response => response.json())
    .then(data => { 
        console.log(data); 
        window.location.href= 'home.php';
    })
    .catch(error => {
        console.error(error);
    });
}
function Cabinet() {
    fetch('route/route.php',{
        method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify("cabinet")
    })
    .then(response => response.json())
    .then(data => { 
        console.log(data); 
    })
    .catch(error => {
        console.error(error);
    });
}

let infouser = JSON.parse(localStorage.getItem("saission"));
    

if (infouser.roles.includes("Lecture")) {
    document.getElementById("ajouterVente").style.display = "none";
    document.getElementById("ajouterAcaht").style.display = "none";
    document.getElementById("ajouterClient").style.display = "none";
    document.getElementById("ajouterProduit").style.display = "none";
    document.getElementById("ajouterFourniseur").style.display = "none";
    document.getElementById("ajouterStock").style.display = "none";
    document.getElementById("ajouterCaise").style.display = "none";
    document.getElementById("ajouterUtilisateur").style.display = "none";
    document.getElementById("ajouterVersement").style.display = "none"; 
    document.getElementById("ajoutCaise").style.display = "none";
    document.getElementById("ajouteruser").style.display = "none";
    // Lecture_ecriture
}else if(infouser.roles.includes("Lecture_ecriture")){

}
 else  {
   
   
}
$(document).ready(function() {
    console.log("recherche commande");
    fetch('php/client/commande.php',{
        method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify("commande")
    })
    .then(response => response.json())
    .then(data => { 
        console.log(data);
        if (data == "success") { 
            $('#monModal').modal('show');  
            exit;
        }
    })
    .catch(error => {
        console.error(error);
    });
    
});                   
                