const salaireClient = JSON.parse(localStorage.getItem('salaire'));
const dadaPersonnel = JSON.parse(localStorage.getItem('personnel'));

if (salaireClient !== null) {
    //document.getElementById('utilisateur').innerText = salaireClient.inuser;
    document.getElementById('montant').value = salaireClient.montant;
    document.getElementById('date').innerText = salaireClient.datepaiement;
    document.getElementById('salaireboutton').innerHTML = ' <button type="submit" name="editsalaire" id="editsalaire" class="btn btn-warning btn-user btn-block" onclick="editSalaire()">Edite </button>';
    document.getElementById('idsalaire').innerHTML ='<input type="text" class="form-control form-control-user" name="iduser" id="iduser" placeholder="Motif" readonly>';
    document.getElementById('iduser').value = salaireClient.id;
    console.log(salaireClient);
    localStorage.clear("salaire");
}

if (dadaPersonnel !== null) {
    //document.getElementById('utilisateur').innerText = salaireClient.inuser;
    document.getElementById('nom').value = dadaPersonnel.nom;
    document.getElementById('date').value = dadaPersonnel.datecreation;
    document.getElementById('telephone').value = dadaPersonnel.telephone;
    document.getElementById('banque').value = dadaPersonnel.compteBanque;
    document.getElementById('enregistrement').innerHTML = ' <button type="submit" name="editpersonnel" id="editpersonnel" class="btn btn-warning btn-user btn-block" onclick="editPersonnel()">Edite </button>';
    document.getElementById('idpersonnel').innerHTML ='<input type="text" class="form-control form-control-user" name="iduser" id="iduser" placeholder="Motif" readonly>';
    document.getElementById('iduser').value = dadaPersonnel.id;
    console.log(dadaPersonnel);
    localStorage.clear("personnel");
}

function salaire(salaire) {
    let info = {};
    info.id = salaire;
    info.salaire = "salaire";
    console.log(salaire);
    
    fetch('edite.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(info)
    })
    .then(response => {
        return response.json();
    })
    .then(data => {
        console.log(data);
        localStorage.setItem('salaire', JSON.stringify(data));
        window.location.href= "employer.php";
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}

function personnel(personnel) {
    let info = {};
    info.id = personnel;
    info.personnel = "personnel";
    console.log(personnel);
    
    fetch('edite.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(info)
    })
    .then(response => {
        return response.json();
    })
    .then(data => {
        console.log(data);
        localStorage.setItem('personnel', JSON.stringify(data));
        window.location.href= "employer.php";
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}