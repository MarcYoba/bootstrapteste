var venteData = window.venteData;
console.log("venteData");
console.log(venteData);

fetch('produit.php',{
    method:'POST',
    headers:{
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(venteData)
})
.then(response => response.json())
.then(data => { 
    if (data.success == true) {
        document.getElementById("verificatiobDonne").innerHTML = '<p class="bg-info"> enregistrement des donne avec success </p>';
        window.location.href="produit.php";
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