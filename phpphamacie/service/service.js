const dataservice = JSON.parse(localStorage.getItem("service"));

if (dataservice) {
    
    console.log(dataservice);

        
    document.getElementById("idterain").innerText = dataservice.id;
    document.getElementById("idclient").value = dataservice.nom;
    document.getElementById("Localisation").value = dataservice.localisation;
    document.getElementById("telephone").value = dataservice.telephone;
    document.getElementById("date").value = dataservice.datejour;
    document.getElementById("motifvisite").value = dataservice.motifvisite;
    document.getElementById("Efectif").value = dataservice.efectif;
    document.getElementById("Age").value = dataservice.Age;
    document.getElementById("barrier").value = dataservice.barrier;
    document.getElementById("Pedulive").value = dataservice.pedulive;
    document.getElementById("construction").value = dataservice.construction;
    document.getElementById("batiment").value = dataservice.batiment;
    document.getElementById("superficie").value = dataservice.superficie;
    document.getElementById("sole").value = dataservice.sole;
    document.getElementById("densite").value = dataservice.densite;
    document.getElementById("Environement").value = dataservice.environement;
    document.getElementById("hygiene").value = dataservice.hygien;
    document.getElementById("mangeoire").value = dataservice.mangeoire;
    document.getElementById("abrevoire").value = dataservice.abrevoire;
    document.getElementById("alimentation").value = dataservice.alimentation;
    document.getElementById("granulo").value = dataservice.granulometrie;
    document.getElementById("antenou").value = dataservice.antenou;
    document.getElementById("prophylacie").value = dataservice.prophylacie;
    document.getElementById("patologie").innerText = dataservice.patologie;
    document.getElementById("Traitemenante").innerText = dataservice.traitemenanterieux;
    document.getElementById("siclinique").innerText = dataservice.signeclinique;
    document.getElementById("Traitementan").innerText = dataservice.traia;
    document.getElementById("Montant").value = dataservice.Montant;
    document.getElementById("message").innerHTML= '<button type="submit" name="modifier" id="modifier" class="btn btn-danger btn-user btn-block">'+
                                        'Modifier'+
                                    '</button>';

    localStorage.removeItem("service");

}

function selection() {
    let service = {};
    service.id =   document.getElementById("id").textContent;
    service.nom =   document.getElementById("nom").innerText;
    service.localisation =   document.getElementById("localisation").innerText;
    service.telephone =   document.getElementById("telephone").innerText;
    service.datejour =   document.getElementById("datejour").innerText;
    service.motifvisite =   document.getElementById("motifvisite").innerText;
    service.efectif =   document.getElementById("efectif").innerText;
    service.Age =   document.getElementById("age").innerText;
    service.barrier =   document.getElementById("barrier").innerText;
    service.pedulive =   document.getElementById("pedulive").innerText;
    service.construction =   document.getElementById("construction").innerText;
    service.batiment =   document.getElementById("batiment").innerText;
    service.superficie =   document.getElementById("superficie").innerText;
    service.sole =   document.getElementById("sole").textContent;
    service.densite =   document.getElementById("densite").innerText;
    service.environement =   document.getElementById("environement").innerText;
    service.hygien =   document.getElementById("hygiene").innerText;
    service.mangeoire =   document.getElementById("mangeoire").innerText;
    service.abrevoire =   document.getElementById("abrevoire").innerText;
    service.alimentation =   document.getElementById("alimentation").innerText;
    service.granulometrie =   document.getElementById("granulometrie").innerText;
    service.antenou =   document.getElementById("antenou").innerText;
    service.prophylacie =   document.getElementById("prophylacie").innerText;
    service.patologie =   document.getElementById("patologie").innerText;
    service.traitemenanterieux =   document.getElementById("traitemenanterieux").innerText;
    service.signeclinique =   document.getElementById("signeclinique").innerText;
    service.traia =   document.getElementById("traia").innerText;
    service.Montant =   document.getElementById("Montant").innerText;

    localStorage.setItem("service", JSON.stringify(service));

    window.location.href="service.php";

}