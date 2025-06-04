// const  clientselec = document.getElementById("clientselec");

function myFunction() {
    // Récupérer l'input et la liste déroulante
    var input, filter, ul, li, a, i;
    input = document.getElementById("FirstName");
    filter = input.value.toUpperCase();
    ul = document.getElementById("clientselec");
    li = ul.getElementsByTagName("option");
  
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

function rechercheclient() {
    let clientnom = document.getElementById("clientselec").value;
    document.getElementById("refecrence").value = clientnom;
    console.log(clientnom);
}

// clientselec.addEventListener('select',rechercheclient);