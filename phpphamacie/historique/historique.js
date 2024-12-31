
function Historique() {
 var id =1;
 //historiqueStock.php

 fetch('/php/historique/historiqueStock.php',{
    method:'POST',
    headers:{
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(id)
})
.then(response => response.json())
.then(data => { 
    console.log(data);
})
.catch(error => {
    console.error(error);
});
    
}
Historique();

