
function myFunction() {
  // Récupérer l'input et la liste déroulante
  var input, filter, ul, li, a, i;
  input = document.getElementById("recherche");
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


function SecondFunction() {
  // Récupérer l'input et la liste déroulante
  var input, filter, ul, li, a, i;
  input = document.getElementById("rechercheP");
  filter = input.value.toUpperCase();
  ul = document.getElementById("nomProduitP");
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

async function fetchStockPDF() {
    try {
      // Envoie de la requête POST vers getstock.php
      const response = await fetch('getstock.php', {
        method: 'POST',
        // IMPORTANT : on envoie des données vides ou un objet vide {}
        body: JSON.stringify({}),  // Envoyez des données pertinentes si nécessaire
        headers: {
          'Content-Type': 'application/json'
        }
      });
  
      // Vérification de la réponse
      if (!response.ok) {
        throw new Error(`Erreur de réseau (${response.status})`);
      }
  
      // Conversion de la réponse en JSON
      const data = await response.json();
  
      // Création du Blob PDF
      const blob = new Blob([data], { type: 'application/pdf' });
      const url = URL.createObjectURL(blob);
  
      // Création du lien et téléchargement du PDF
      const a = document.createElement('a');
      a.href = url;
      a.download = 'mon_fichier.pdf';
      a.click();
      URL.revokeObjectURL(url);
  
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }
  function rediriger() {
    // Vérifie si la checkbox est cochée
    if (document.getElementById('Achat').checked) {
      // Redirige vers la page souhaitée
      window.location.href = "../achat/liste.php";
    }
  }
  
