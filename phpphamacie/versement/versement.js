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

