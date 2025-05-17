<?php
require_once("../bdmutilple/getService.php");
require_once("../bdmutilple/getclient.php");
require('../../fpdf186/fpdf.php');
require '../../vendor/autoload.php';
ini_set('memory_limit', '256M');
use Dompdf\Dompdf;

$date = date("Y-m-d");

//var_dump($date);
$id =  $_GET["id"];
$service = new Service();
$client = new Client(0);

// Créer une instance de Dompdf
$dompdf = new Dompdf();
// Créer le contenu HTML du PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Facture</title>
    <style>
        body {
            font-size: 14pt;
        }
}

.div-aligne {
  flex: 1; /* Pour distribuer l\'espace de manière égale */
}
</style>
        

       
    
       
</head>
<body>
<img src="../../img/logo.jpg" alt="Logo ABGROUP"/>
<h1> FICHE DE VISITE ABGROUP SARL </h1>
<table style="width:100%;">
    <thead>';
    $element = $service->getElement($id);
    $html .='  
        <tr>
       <td> Nom:     
        <p class="text-lg font-weight-bold">'.$client->getByIdClient($element["idclient"]).'</p> </td>
       <td> Localisation:
        <p class="text-lg font-weight-bold" >'. $element["localisation"] .'</p> 
        </td>
       <td> Telephone 
        <p class="text-lg font-weight-bold" > '. $element["telephone"].'
        </td>
        <td> Speculation: 
        <p class="text-lg font-weight-bold" > '. $element["speculation"].'
        </td>
        <tr>
        </tbody>
        </table>';
        
       $html .=' </p>
                                        
                                    Information de descente
                                    <hr>';
        $html.='<table style="width:100%;">
                <thead>
                <tbody>
                    <tr>
                    <td>date du jour: <p class="text-lg font-weight-bold" >'.$element["datejour"].'</p></td>                  
                   <td> Motif de la visite :<p class="text-lg font-weight-bold">' .$element["motifvisite"] .'</p></td>                   
                    <td>Effectif: <p class="text-lg font-weight-bold">'. $element["efectif"] .'</p></td> 
                    <td>Âge: <p class="text-lg font-weight-bold">'. $element["Age"] .'</p></td> 
                    </tr>
                    <tr>
                    <td>Présence de barrière: 
                    <p class="text-lg font-weight-bold" >'. $element["barrier"].'</p></td>
                    <td>Pédiluve: 
                    <p class="text-lg font-weight-bold">'. $element["pedulive"].'</p></td>             
                    <td>Type de construction: 
                    <p class="text-lg font-weight-bold" >'. $element["construction"].'</p></td>
                    <td>Nombre de bâtiments: 
                    <p class="text-lg font-weight-bold">'. $element["batiment"].'</p></td>
                    </tr>
                    <tr>
                    <td>Superficie du local (m): 
                    <p class="text-lg font-weight-bold">'.$element["superficie"].'</p></td>
                   <td> Qualité du sol: <p class="text-lg font-weight-bold">'. $element["sole"].'</p></td>
                   <td> Densité au sol: <p class="text-lg font-weight-bold">'. $element["densite"].'</p></td>   
                   <td> Poids moyen: <p class="text-lg font-weight-bold">'. $element["Poidmoyen"].'</p></td>                   
                    <td>Environement d\'exploitation: 
                    <p class="text-lg font-weight-bold">'. $element["environement"].'</p></td>
                    </tr>
                    <tr>
                    <td>Hygiène du bâtiment: 
                    <p class="text-lg font-weight-bold">echo'. $element["hygiene"].'</p></td>
                   <td> Nombre mangeoire: <p class="text-lg font-weight-bold">'. $element["mangeoire"].'</p></td>
                   <td> Nombre abrevoire: <p class="text-lg font-weight-bold">'. $element["abrevoire"].'</p></td>
                   <td> Type d\'alimentation: 
                    <p class="text-lg font-weight-bold">'. $element["alimentation"].'</p></td>
                    </tr>
                    <tr>
                   <td> Granulometrie: 
                    <p class="text-lg font-weight-bold">'. $element["granulometrie"].'</p></td>
                   <td> Presence de l\'antenou: 
                    <p class="text-lg font-weight-bold">'. $element["antenou"].'</p>
                    </td>
                    <td> Date Debut de la maladie: 
                    <p class="text-lg font-weight-bold">'. $element["datemaladie"].'</p>
                    </td>
                    <td> Nombre de Mort: 
                    <p class="text-lg font-weight-bold">'. $element["nbmort"].'</p>
                    </td>
                    <td> Nombre de jour maladie: 
                    <p class="text-lg font-weight-bold">'. $element["jourmaladie"].'</p>
                    </td>
                    </tr>
                    </tbody>
        </table> information medicale <hr>';    
                    $html.=' Prophylaxie:
                                        <p class="text-lg font-weight-bold">'. $element["prophylacie"].'</p>
                                       
                                        Pathologie antérieure: 
                                        <p class="text-lg font-weight-bold">'. $element["patologie"].'</p>
                                        Traitement antérieur: 
                                        <p class="text-lg font-weight-bold">'. $element["traitemenanterieux"].'</p>
                                        Signe clinique: 
                                        <p class="text-lg font-weight-bold">'. $element["signeclinique"].'</p>
                                       
                                        Traitement envisagé: 
                                        <p class="text-lg font-weight-bold">'. $element["Traitementanvisage"].'</p>

                                        Diagnostic de suspicion: 
                                        <p class="text-lg font-weight-bold">'. $element["dianostique"].'</p>

                                        Recommandation: 
                                        <p class="text-lg font-weight-bold">'. $element["recommandation"].'</p>

                                        Date prochaine visite: 
                                        <p class="text-lg font-weight-bold">'. $element["dateprochevisite"].'</p>
                                <hr>
                                <div style="display: flex; justify-content: space-between;">
                                    <div>
                                        Montant: <p class="text-lg font-weight-bold">'. $element["Montant"] .'</p>
                                        <p class="text-lg font-weight-bold" style="text-align: right;">'.$element["veterinaire"].'</p>
                                        <br>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <h2>NB : N\'oubliez pas de commander vos poussins, vos produits et l\'aliment pour garantir la croissance de votre élevage</h2>
         ';

$html .='
</body>
</html>';

// Charger le contenu HTML dans Dompdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("mon_fichier.pdf", array("Attachment" => 0));

?>