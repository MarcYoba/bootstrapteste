function Getversement(){
    fetch('edite.php', {
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
}


function recherclinet() {
  // Récupérer l'input et la liste déroulante
  var input, filter, ul, li, a, i;
  input = document.getElementById("rechecliet");
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
