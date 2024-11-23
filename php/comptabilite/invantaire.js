function invantaire() {
    let evolution = document.getElementById("nombre").value;

    console.log("Evolution : ");
  
  fetch('../graphe/getevolution.php',{
      method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(evolution)
  })
    .then(response => {
      return response.json();
    })
    .then(data => {
      console.log(data); 
      
      document.getElementById("montant1").innerText = data.montantN
      document.getElementById("client1").innerText = data.ClientN
      document.getElementById("montant2").innerText = data.montantN1
      document.getElementById("client2").innerText = data.ClientN1
      document.getElementById("nouclient").innerText = data.Nbuclient
      document.getElementById("monnoucli").innerText = data.Moclient
      document.getElementById("ancienclient1").innerText = data.Nbaclient
      document.getElementById("montantancien").innerText = data.MoAclient
      document.getElementById("Total").innerText = Math.round((data.montantN1 - data.montantN));
      document.getElementById("Totalprospet").innerText = Math.round((data.Moclient - data.MoAclient));
      document.getElementById("Poucentage").innerText = (Math.round((data.montantN1 - data.montantN)/data.montantN))*100;
      document.getElementById("Poucentageprospect").innerText = (Math.round((data.Moclient - data.MoAclient)/data.MoAclient))*100;
      document.getElementById("Totalclient").innerText = Math.round((data.ClientN1 - data.ClientN));
      document.getElementById("Poucentageclient").innerText = (Math.round((data.ClientN1 - data.ClientN)/data.ClientN))*100;
      document.getElementById("Totalclient1").innerText = Math.round((data.Nbuclient - data.Nbaclient));
      document.getElementById("Poucentageclient1").innerText = (Math.round((data.Nbuclient - data.Nbaclient)/data.Nbaclient))*100;
      
    })
    .catch(error => {
      console.error(error);
  });

}

function semaine() {
  let evolution = document.getElementById("nombre").value;
  let evoluseme = {};

  console.log("Evolution semaine: ");
  evoluseme.datatrie = "semain"
  evoluseme.datavalue = evolution;

  window.location.href = 'invantairesemaine.php?id='+ evolution;
}