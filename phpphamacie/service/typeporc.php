
<form class="user" action="register.php" method="post">
Information du client
<textarea id="idterain" name="idterain" style="display: none;"></textarea>
<hr>
<div class="form-group row">
    <div class="col-sm-4 mb-3 mb-sm-0">
    <input type="text" class="form-control form-control-user" id="produitname"
    name="produitname" placeholder="Nom produit" onkeyup="recherclient()" >   
    <select id="idclient"  name="idclient"  class="form-control form-select" required size="4" multiple aria-label="multiple select" required>
            <?php 
            require_once("../connexion.php");
                global $conn;
                $sql = "SELECT id, firstname, adresse FROM client ORDER BY firstname ASC";
                $result = $conn->query($sql);
                while ($row = mysqli_fetch_assoc($result)){               
                    echo "<option value='".$row["id"]."'>".$row["firstname"]."</option>";
                }
            ?>
    </select>
    </div>
    
    <div class="col-sm-4 mb-3 mb-sm-0">
        <input type="text" class="form-control form-control-user" id="Localisation"
           name="Localisation" placeholder="Localisation" required>
        <br>
        <input type="text" class="form-control form-control-user" id="speculation"
           name="speculation" placeholder="Spéculation" required>
    </div>

    <div class="col-sm-4 mb-3 mb-sm-0">
        <input type="number" class="form-control form-control-user" id="telephone"
           name="telephone" placeholder="Téléphone" required>
    </div>
    
</div>
Information de descente
<hr>
<div class="form-group row">
    <div class="col-sm-4 mb-3 mb-sm-0">
        date du jour <input type="date" class="form-control form-control-user" id="date"
           name="date" placeholder="Date achat" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Motif de la visite :<textarea  id="motifvisite" name="motifvisite" placeholder="Motif Visite" required>
        </textarea>
    </div>
    <div class="col-sm-2 mb-3 mb-sm-0">
        Effectif: <input type="number"  class="form-control form-control-user" id="effectif"
           name="effectif" placeholder="Effectif" value="0" onchange="calculedensite()" required>
    </div>
    <div class="col-sm-2 mb-3 mb-sm-0">
    Âge: <input type="number"  class="form-control form-control-user" id="Age"
           name="Age" placeholder="Âge" required>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-3 mb-3 mb-sm-0">
        Présence de barrière: 
        <select  class="form-control form-select" id="barrier" name="barrier"  required>
        <option value="OUI" >OUI</option>
        <option value="NON">NON</option>
        </select>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Pédiluve: 
        <select  class="form-control form-select" id="Pedulive" name="Pedulive"  required>
        <option value="OUI" >OUI</option>
        <option value="NON">NON</option>
        </select>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Type de construction: 
        <select  class="form-control form-select" id="construction" name="construction"  required>
            <option value="definitif" >Définitive</option>
            <option value="semi definitif">Semi définitive</option>
            <option value="materiau provisoire">Matériau provisoire</option>
        </select>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-0">
                Nombre de bâtiments: <input type="number"  class="form-control form-control-user" id="batiment"
           name="batiment" placeholder="Nombre de batiment" required>
    </div>
</div>  
<div class="form-group row">
    <div class="col-sm-3 mb-3 mb-sm-0">
        Superficie du local (m): <input type="number"  class="form-control form-control-user" id="superficie"
           name="superficie" placeholder="Superficie en (m)" value="0" onchange="calculedensite()" varequired>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Qualité du sol: <input type="texte"  class="form-control form-control-user" id="sole"
           name="sole" placeholder="Qualité du sol" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Densité au sol: <input type="texte"  class="form-control form-control-user" id="densite"
           name="densite" placeholder="Densité au sol" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Poids Moyen: <input type="number"  class="form-control form-control-user" id="poidmoyen"
           name="poidmoyen" placeholder="Poids Moyen" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Environement d'exploitation: <input type="text"  class="form-control form-control-user" id="Environement"
           name="Environement" placeholder="Environement d'exploitation" required>
    </div>
</div> 
<div class="form-group row">
    <div class="col-sm-3 mb-3 mb-sm-0">
        Hygiène du bâtiment: <select type="text"  class="form-control form-select" id="hygiene"
                   name="hygiene" placeholder="Hygiène du bâtiment" required>
                        <option id="MAUVAIRSE"> Mauvairse</option>
                        <option id="ASSEZ BONNE">Assez Bonne</option>
                        <option id="BONNE"> Bonne</option>
                        <option id="Excelente"> Excelente</option>
                   </select>
            </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Nombre mangeoir: <input type="number"  class="form-control form-control-user" id="mangeoire"
           name="mangeoire" placeholder="Nombre mangeoir" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Nombre abreuvoir: <input type="number"  class="form-control form-control-user" id="abrevoire"
           name="abrevoire" placeholder="Nombre abreuvoir" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Type d'aliment: 
        <select  class="form-control form-select" id="alimentation" name="alimentation"  required>
            <option value="predemarrage" >Prédemarrage</option>
            <option value="demarrage">Démarrage</option>
            <option value="croissance">Croissance</option>
            <option value="finition">Finition</option>
        </select>
    </div>
</div> 
<div class="form-group row">
    <div class="col-sm-3 mb-3 mb-sm-0">
        Granulométrie: 
        <select  class="form-control form-select" id="granulo" name="granulo"  required>
            <option value="BONNE" >Bonne</option>
            <option value="MAUVAIRSE">Mauvairse</option>
        </select>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Présence de l'anternau: 
        <select  class="form-control form-select" id="antenou" name="antenou"  required>
            <option value="OUI" >Oui</option>
            <option value="NON">Non</option>
        </select>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Prophylaxie:
        <select  class="form-control form-select" id="prophylacie" name="prophylacie"  required>
            <option value="respecte" >Respècte</option>
            <option value="non respecte">Non respècte</option>
            <option value="non connu">Non connue</option>
        </select>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Pathologies antérieux: 
    <textarea  id="patologie" name="patologie" placeholder="Patologies antérieux" required>
    </textarea>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-3 mb-3 mb-sm-0">
        Traitements antérieurs: 
        <textarea  id="Traitemenante" name="Traitemenante" placeholder="Traitement antérieur" required>
    </textarea>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Date début Maladie: 
    <input type="date" class="form-control form-control-user" id="datedebmal"
           name="datedebmal" placeholder="Date debut Maladie" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Nombre de mort: 
    <input type="number" class="form-control form-control-user" id="mort"
           name="mort" placeholder="Nombre de mort" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Nombre jour maladie: 
    <input type="number" class="form-control form-control-user" id="jourmalad"
           name="jourmalad" placeholder="Nombre de jour de la maladie" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Signes cliniques: 
        <textarea  id="siclinique" name="siclinique" placeholder="Signes cliniques" required>
    </textarea>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Diagnostics de suspicion: 
        <textarea  id="Diagnostic" name="Diagnostic" placeholder="Diagnostic de suspicion" required>
    </textarea>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Traitement prescrit: 
        <textarea  id="Traitementan" name="Traitementan" placeholder="Traitement Anvisage" required>
    </textarea>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Recommandation: 
        <textarea  id="Recommendation" name="Recommendation" placeholder="Recommendation" required>
    </textarea>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Date prochaine visite: 
    <input type="date" class="form-control form-control-user" id="datepvisit"
           name="datepvisit" placeholder="Date prochaine visite" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Nom du vétérinaire : 
    <input type="text" class="form-control form-control-user" id="veterinaire"
           name="veterinaire" placeholder="Date prochaine visite" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0"> 
    Montant <input type="number" class="form-control form-control-user" id="Montant"
    name="Montant" placeholder="Montant" required>
    </div>
</div>
<span id="message">
    <button type="submit" name="submit" id="submit" class="btn btn-success btn-user btn-block">
        Enregister
    </button>
</span>


</form>
