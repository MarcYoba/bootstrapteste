function isEmpty(str) {
    return str.valueOf() === '';
  }

function rechercheEmailUser(){
    let email = document.getElementById("exampleInputEmail").value;
    let passe1 = document.getElementById("password").value;
    let passe2 = document.getElementById("rpassword").value;

    if ((passe1 == passe2) && (!isEmpty(passe1)) && (!isEmpty(passe1)) &&(!isEmpty(email))) {
        let tdonne = {};
        tdonne.emai = email
        tdonne.password = passe1;

        fetch('modifipasse.php',{
            method:'POST',
            headers:{
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(tdonne)
        })
        .then(response => response.json())
        .then(data => { 
            if(data == true){
                document.getElementById("errormail").innerHTML = '';
                window.location.href = "../../index.php";
            }else{
                document.getElementById("errormail").innerHTML = '<p class="texte-rouge"> Email nom trouver dans la base</p>';
            }
            console.log(data);
        })
        .catch(error => {
            console.error(error);
        }); 
    }else{
        fetch('modifipasse.php',{
            method:'POST',
            headers:{
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(email)
        })
        .then(response => response.json())
        .then(data => { 
            if(data == true){
                document.getElementById("errormail").innerHTML = '';
                document.getElementById("password").style.display ="block";
                document.getElementById("rpassword").style.display ="block";
            }else{
                document.getElementById("errormail").innerHTML = '<p class="texte-rouge"> Email nom trouver dans la base</p>';
            }
            console.log(data);
        })
        .catch(error => {
            console.error(error);
        });
    }

   
}