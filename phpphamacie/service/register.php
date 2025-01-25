<?php
require_once("../connexion.php");
global $conn;


    $idclient = $_POST['idclient'];
    $Localisation = $_POST['Localisation'];
    $telephone = $_POST['telephone'];
    // $age = $_POST['Age'];
    $date = $_POST['date'];
    $motifvisite = $_POST['motifvisite'];
    $efectif = $_POST['Efectif'];
    $Age = $_POST['Age'];
    $barrier = $_POST['barrier'];
    $Pedulive = $_POST['Pedulive'];
    $construction = $_POST['construction'];
    $batiment = $_POST['batiment'];
    $superficie = $_POST['superficie'];
    $sole = $_POST['sole'];
    $densite = $_POST['densite'];
    $Environement = $_POST['Environement'];
    $hygiene = $_POST['hygiene'];
    $mangeoire = $_POST['mangeoire'];
    $abrevoire = $_POST['abrevoire'];
    $alimentation = $_POST['alimentation'];
    $granulo = $_POST['granulo'];
    $antenou = $_POST['antenou'];
    $prophylacie = $_POST['prophylacie'];
    $patologie = $_POST['patologie'];
    $Traitemenante = $_POST['Traitemenante'];
    $siclinique = $_POST['siclinique'];
    $Traitementan = $_POST['Traitementan'];
    $Montant = $_POST['Montant'];
    $speculation = $_POST['speculation'];
    $Diagnostic = $_POST['Diagnostic'];
    $Recommendation = $_POST['Recommendation'];
    $datepvisit = $_POST['datepvisit'];

// Formulaire d'enregistrement produit
if (isset($_POST['submit'])) {
    
    // Vérifier si tous les champs sont remplis
    if (!empty($date) || !empty($age) || !empty($Montant) || !empty($Traitementan) || !empty($siclinique) || !empty($patologie)) {
   
                // Créer le compte utilisateur
        $sql = "INSERT INTO terrain (idclient, localisation, telephone, datejour, motifvisite, efectif, Age, barrier, pedulive, construction, batiment, superficie,sole, densite, environement, hygiene , mangeoire , abrevoire , alimentation , granulometrie , antenou,prophylacie,patologie,traitemenanterieux,signeclinique,Traitementanvisage,Montant,speculation,dianostique,recommandation,dateprochevisite) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                    // Lier les paramètres
        if (!$stmt = $conn->prepare($sql)) {
            die('Erreur de préparation de la requête : ' . $conn->error);
        }
                    
                    $stmt->bind_param('dsdssddsssddssssddssssssssdssss', $idclient, $Localisation,$telephone,$date,$motifvisite,$efectif,$age,$barrier,$Pedulive,$construction,$batiment,$superficie,$sole,$densite,$Environement,$hygiene,$mangeoire,$abrevoire,$alimentation,$granulo, $antenou,$prophylacie,$patologie,$Traitemenante,$siclinique,$Traitementan,$Montant,$speculation,$Diagnostic,$Recommendation,$datepvisit);

                    // Exécuter la requête
        if (!$stmt->execute()) {
            die('Erreur d\'exécution de la requête : ' . $stmt->error);
        }
                    // Fermer la requête
        $stmt->close();
        $conn->close();

        header("Location:liste.php");
                exit();
    }

            $stmt->close(); 
   
}elseif(isset($_POST['modifier'])){

    $idt = $_POST['idterain'];
    

    if (!empty($idclient) || !empty($id) || !empty($telephone) || !empty($date) || !empty($Montant) || !empty($Localisation)) {
        
        
        $sql = "UPDATE terrain  set idclient='$idclient', localisation='$Localisation', telephone='$telephone',
         datejour='$date', motifvisite='$motifvisite', efectif='$efectif', Age='$Age', barrier='$barrier', 
         pedulive='$Pedulive', construction='$construction', batiment='$batiment', superficie='$superficie',
         sole='$sole', densite='$densite', environement='$Environement', hygiene='$hygiene' , mangeoire='$mangeoire' , 
         abrevoire='$abrevoire' , alimentation='$alimentation' , granulometrie='$granulo' , antenou='$antenou',
         prophylacie='$prophylacie',patologie='$patologie',traitemenanterieux='$Traitemenante',signeclinique='$siclinique',
         Traitementanvisage='$Traitementan',Montant='$Montant' 
        WHERE id = '$idt'";
        $result = $conn->query($sql);
        if ($result == true) {
           header("Location: liste.php");
        }
            

    }else {
        header("Location: ../../404.html");
        exit();
    }
}

?>