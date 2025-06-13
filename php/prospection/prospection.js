
const form = window.localStorage.getItem('prospection');
if (form) {
    const data = JSON.parse(form);
    document.getElementById('reference').value = data.id;
    document.getElementById('propect').value = data.nom;
    document.getElementById('telephone').value = data.telephone;
    document.getElementById('localisation').value = data.localisation;
    document.getElementById('speculation').value = data.speculation;
    document.getElementById('nbsujet').value = data.nbsujet;
    document.getElementById('souche').value = data.souche;
    document.getElementById('ravitaillement').value = data.ravitaillement;
    document.getElementById('commentaire').value = data.commentaire;
    document.getElementById('dateprospection').value = data.dateprospection;
    document.getElementById('longitude').value = data.longitude;
    document.getElementById('latitude').value = data.latitude;
    window.localStorage.removeItem('prospection');
    document.getElementById('buttonenregistrement').innerHTML = '<button type="edite" name="edite" id="edite"  class="btn btn-warning " onclick="getLocation()">Edite </button>';
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
            alert("Vérifiez si votre code GPS est correct: " + latitude + ", " + longitude);
            document.forms[0].submit(); // Soumission automatique
        }, () => {
            alert("Impossible d'obtenir la géolocalisation.");
        });
    } else {
        alert("Géolocalisation non supportée par votre navigateur.");
    }
}

function EditProspection(id) {
    // Récupérer les données de la prospection à modifier

    // Envoyer les données au serveur pour mise à jour
    fetch('update.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: id,
        })
    })
    .then(response => response.json())
    .then(data => {
        window.localStorage.setItem('prospection', JSON.stringify(data));
        window.location.href = 'prospection.php';
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}
