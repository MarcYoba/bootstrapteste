
const dataclient = JSON.parse(localStorage.getItem("dataclient"));

if (dataclient !== null) {
    

    document.getElementById("idclient").innerText = dataclient.id;
    document.getElementById("FirstName").value = dataclient.firstname;
    document.getElementById("LastName").value = dataclient.adresse;
    document.getElementById("sexe").value = dataclient.sexe;
    document.getElementById("Inputphone").value = dataclient.telephone;
    document.getElementById("enregistrement").innerHTML = ' <button type="submit" name="edit" id="edit" class="btn btn-warning btn-user btn-block" onclick="editClient()">Edite </button>';
    
    document.getElementById("InputEmail").style.visibility='hidden';
    document.getElementById("InputPassword").style.visibility='hidden';
    document.getElementById("RepeatPassword").style.visibility='hidden';
    console.log(dataclient);
    localStorage.clear();
}

function modifierClient(params) {

    console.log(params);

    fetch('edite.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(params)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Réponse du serveur:', data);
        localStorage.setItem("dataclient",JSON.stringify(data)); 
        window.location.href= "client.php";
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}

function editClient(){
    let tab = {};

  tab.nom =   document.getElementById("FirstName").value;
  tab.adress =   document.getElementById("LastName").value;
   tab.sexe =  document.getElementById("sexe").value;
  tab.phone =   document.getElementById("Inputphone").value;
  tab.id=   document.getElementById("idclient").innerText;
  
    fetch('edite.php', {
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
