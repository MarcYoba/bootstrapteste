let infouser = JSON.parse(localStorage.getItem("saission"));
    
if (infouser.roles.includes("Lecture")) {
    document.getElementById("ajouterVente").style.display = "none";
    document.getElementById("ajouterAcaht").style.display = "none";
    document.getElementById("ajouterClient").style.display = "none";
    document.getElementById("ajouterProduit").style.display = "none";
    document.getElementById("ajouterFourniseur").style.display = "none";
    document.getElementById("ajouterStock").style.display = "none";
    document.getElementById("ajouterCaise").style.display = "none";
    document.getElementById("ajouterUtilisateur").style.display = "none";
    document.getElementById("ajouterVersement").style.display = "none"; 
    document.getElementById("ajoutCaise").style.display = "none";
    document.getElementById("ajouteruser").style.display = "none";
    // Lecture_ecriture
}else if(infouser.roles.includes("Lecture_ecriture")){

}
 else  {
   
   
}
                   
                