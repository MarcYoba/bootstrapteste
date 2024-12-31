function myFunctionP() {
    // Récupérer l'input et la liste déroulante
    var input, filter, ul, li, a, i;
    input = document.getElementById("rechercheP");
    filter = input.value.toUpperCase();
    ul = document.getElementById("idclient");
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
    const element = document.getElementById("id");
    const elementdelete = document.getElementById("iddelete");
    let evolution={};
    console.log("evolution");
    if (element) {
        evolution.vaccin = element.value;
        console.log(evolution);
        fetch('Edite.php',{
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
            document.getElementById("enregistrement").innerHTML= '<button type="submit" name="modifier" id="modifier" class="btn btn-warning btn-user btn-block">'+
                                        'Modifier'+
                                    '</button>';
            document.getElementById("Name").value = data.nomSujet;
            document.getElementById("age").value = data.age
           // document.getElementById("idclient").value = data.idclient
            document.getElementById("Type").value = data.typesujet
           // document.getElementById("typevaccin").value = data.typeVacin
            document.getElementById("montant").value = data.montant
            document.getElementById("montantpayer").value = data.netpayer
            document.getElementById("Reste").value = data.restemontant
            document.getElementById("premiervacin").value = data.datevacin
            document.getElementById("secondvacin").value = data.daterappel
            
        })
        .catch(error => {
          console.error(error);
      });
    }else{

    }

    if (elementdelete) {
      evolution.vaccindelete = elementdelete.value;
        console.log(evolution);
        fetch('Edite.php',{
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
            if (data == 1) {
              window.location.href = "liste.php"
            }
        })
        .catch(error => {
          console.error(error);
      });
    } else {
      
    }
    
