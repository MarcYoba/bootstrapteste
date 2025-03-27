
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
           name="speculation" placeholder="speculation" required>
    </div>

    <div class="col-sm-4 mb-3 mb-sm-0">
        <input type="number" class="form-control form-control-user" id="telephone"
           name="telephone" placeholder="telephone" required>
    </div>
    
</div>
Information de descente
<hr>
<div class="form-group row">
    <div class="col-sm-4 mb-3 mb-sm-0">
        date du jour <input type="date" class="form-control form-control-user" id="date"
           name="date" placeholder="date achat" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Motif de la visite :<textarea  id="motifvisite" name="motifvisite" placeholder="Motif Visite" required>
        </textarea>
    </div>
    <div class="col-sm-2 mb-3 mb-sm-0">
        Efectif: <input type="number"  class="form-control form-control-user" id="Efectif"
           name="Efectif" placeholder="Efectif" value="0" onchange="calculedensite()" required>
    </div>
    <div class="col-sm-2 mb-3 mb-sm-0">
    Âge: <input type="number"  class="form-control form-control-user" id="Age"
           name="Age" placeholder="Age" required>
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
            <option value="definitif" >definitif</option>
            <option value="semi definitif">semi definitif</option>
            <option value="materiau provisoire">materiau provisoire</option>
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
    Qualité du sole: <input type="texte"  class="form-control form-control-user" id="sole"
           name="sole" placeholder="Qualite du sole" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Densite: <input type="texte"  class="form-control form-control-user" id="densite"
           name="densite" placeholder="Densite au sole" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Poids Moyen: <input type="number"  class="form-control form-control-user" id="poidmoyen"
           name="poidmoyen" placeholder="Poid Moyen" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Environement d'exploitation: <input type="text"  class="form-control form-control-user" id="Environement"
           name="Environement" placeholder="Environement d'exploitation" required>
    </div>
</div> 
<div class="form-group row">
    <div class="col-sm-3 mb-3 mb-sm-0">
        Hygiène du bâtiment: <input type="text"  class="form-control form-control-user" id="hygiene"
                   name="hygiene" placeholder="Hygiène du bâtiment" required>
            </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Nombre mangeoire: <input type="number"  class="form-control form-control-user" id="mangeoire"
           name="mangeoire" placeholder="Nombre mangeoire" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Nombre abrevoire: <input type="number"  class="form-control form-control-user" id="abrevoire"
           name="abrevoire" placeholder="Nombre abrevoire" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Type d'alimentation: 
        <select  class="form-control form-select" id="alimentation" name="alimentation"  required>
            <option value="predemarrage" >predemarrage</option>
            <option value="demarrage">demarrage</option>
            <option value="croissance">croissance</option>
            <option value="finition">finition</option>
        </select>
    </div>
</div> 
<div class="form-group row">
    <div class="col-sm-3 mb-3 mb-sm-0">
        Granulometrie: 
        <select  class="form-control form-select" id="granulo" name="granulo"  required>
            <option value="BONNE" >BONNE</option>
            <option value="MOVAIRSE">MOVAIRSE</option>
        </select>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
        Présence de l'antenou: 
        <select  class="form-control form-select" id="antenou" name="antenou"  required>
            <option value="OUI" >OUI</option>
            <option value="NON">NON</option>
        </select>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    prophylaxie:
        <select  class="form-control form-select" id="prophylacie" name="prophylacie"  required>
            <option value="respecte" >respecte</option>
            <option value="non respecte">non respecte</option>
            <option value="non connu">non connu</option>
        </select>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Pathologie anterieu: 
    <textarea  id="patologie" name="patologie" placeholder="Patologie anterieux" required>
    </textarea>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-3 mb-3 mb-sm-0">
        Traitements anterieurs: 
        <textarea  id="Traitemenante" name="Traitemenante" placeholder="Traitement anterieur" required>
    </textarea>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Date debut Maladie: 
    <input type="date" class="form-control form-control-user" id="datedebmal"
           name="datedebmal" placeholder="Date debut Maladie" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    nombre de mort: 
    <input type="number" class="form-control form-control-user" id="mort"
           name="mort" placeholder="Nombre de mort" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Nombre jour maladie: 
    <input type="number" class="form-control form-control-user" id="jourmalad"
           name="jourmalad" placeholder="Nombre de jour de la maladie" required>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Signe clinique: 
        <textarea  id="siclinique" name="siclinique" placeholder="Signe clinique" required>
    </textarea>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Traitement prescrit: 
        <textarea  id="Traitementan" name="Traitementan" placeholder="Traitement Anvisage" required>
    </textarea>
    </div>
    <div class="col-sm-3 mb-3 mb-sm-0">
    Diagnostics de suspicion: 
        <textarea  id="Diagnostic" name="Diagnostic" placeholder="Diagnostic de suspicion" required>
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
           name="datepvisit" placeholder="date achat" required>
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
