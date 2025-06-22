<?php
if ((session_status() === PHP_SESSION_NONE)) {
   session_start(); 
}
require_once("php/activesaision.php");
?>
 <?php 
        if (!isset($_SESSION["roles"])) {
            header('Location:../../index.php');
        }
        
            echo '<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">';
        ?>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">AB COMPTA <sup>1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    '
        <li class="nav-item active">
            <a class="nav-link" href="../../homepahamacie.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
    
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsevente"
            aria-expanded="true" aria-controls="collapsevente">
            <i class="fas fa-fw fa-folder"></i>
            <span>Vente</span>
        </a>
        <div id="collapsevente" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opérations des ventes</h6>
                <a class="collapse-item" href="../vente/vente.php" id="ajouterVente"> Ajouter une vente</a>
                <a class="collapse-item" href="../vente/liste.php?date=<?php echo date("Y"); ?>">Liste des ventes</a>      
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseahcat"
            aria-expanded="true" aria-controls="collapseahcat">
            <i class="fas fa-fw fa-folder"></i>
            <span>Achat</span>
        </a>
        <div id="collapseahcat" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opérations des Achats</h6>
                <a class="collapse-item" href="../achat/teste.php" id="ajouterAcaht">Ajouter un Achat</a>
                <a class="collapse-item" href="../achat/liste.php?date=<?php echo date("Y"); ?>">Liste des Achats</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseclient"
            aria-expanded="true" aria-controls="collapseclient">
            <i class="fas fa-fw fa-folder"></i>
            <span>Client</span>
        </a>
        <div id="collapseclient" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opérations des clients</h6>
                <a class="collapse-item" href="../client/client.php" id="ajouterClient">Ajouter un client</a>
                <a class="collapse-item" href="../client/liste.php">Liste des clients</a>
                <a class="collapse-item" href="../client/clientInactif.php">Liste des clients Inactifs</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseproduit"
            aria-expanded="true" aria-controls="collapseproduit">
            <i class="fas fa-fw fa-folder"></i>
            <span>Produit</span>
        </a>
        <div id="collapseproduit" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opérations des produits</h6>
                <a class="collapse-item" href="../produit/produit.php" id="ajouterProduit">Ajouter un produit</a>
                <a class="collapse-item" href="../produit/liste.php">Liste des produits</a>
                <a class="collapse-item" href="../produit/Peremption.php">Date Péremption</a> 
                                  
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefournisseur"
            aria-expanded="true" aria-controls="collapsefournisseur">
            <i class="fas fa-fw fa-folder"></i>
            <span>Fournisseur</span>
        </a>
        <div id="collapsefournisseur" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opérations des Fourniseurs</h6>
                <a class="collapse-item" href="../fournisseur/fourniseur.php" id="ajouterFourniseur">Ajouter un Fournisseur</a>
                <a class="collapse-item" href="../fournisseur/liste.php">Liste des Fournisseurs</a>   
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsestock"
            aria-expanded="true" aria-controls="collapsestock">
            <i class="fas fa-fw fa-folder"></i>
            <span>Stock</span>
        </a>
        <div id="collapsestock" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opérations des Stocks</h6>
                <a class="collapse-item" href="../stock/sctockVente.php?date=<?php echo date("Y"); ?>">Historique </a>
                <a class="collapse-item" href="../achat/liste.php">Stock Achat </a>
                <a class="collapse-item" href="../stock/recaptliste.php?date=<?php echo date("Y"); ?>">Récapitulatif</a>
                <a class="collapse-item" href="../stock/editeStock.php" id="ajouterStock">Stock Initiale / Inventaire</a>
                        
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#versement"
            aria-expanded="true" aria-controls="versement">
            <i class="fas fa-fw fa-folder"></i>
            <span>Versement</span>
        </a>
        <div id="versement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">versement:</h6>
                
                <a class="collapse-item" href="../versement/versement.php" id="ajouterVersement">Ajouter versement</a>
                <a class="collapse-item" href="../versement/liste.php?date=<?php echo date("Y");?>">Liste versement</a>

            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dette"
            aria-expanded="true" aria-controls="dette">
            <i class="fas fa-fw fa-folder"></i>
            <span>Créance client</span>
        </a>
        <div id="dette" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Créance client:</h6>
                
                <a class="collapse-item" href="../dette/dette.php?date=<?php echo date("Y");?>">Créance client</a>
                   
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#caisse"
            aria-expanded="true" aria-controls="caisse">
            <i class="fas fa-fw fa-folder"></i>
            <span>Caisse</span>
        </a>
        <div id="caisse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Caisse:</h6>
                <a class="collapse-item" href="../caisse/caisse.php" id="ajouterCaise">Caisse</a>
                <a class="collapse-item" href="../caisse/liste.php?date=<?php echo date("Y");?>">Liste caisse</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#utilisateur"
            aria-expanded="true" aria-controls="utilisateur">
            <i class="fas fa-fw fa-folder"></i>
            <span>utilisateur</span>
        </a>
        <div id="utilisateur" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">utilisateur:</h6>
                        <a class="collapse-item" href="../userCon/page.php" id="ajouterUtilisateur">Ajouter utilisateur</a>
                        <a class="collapse-item" href="../userCon/liste.php">Liste utilisateur</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#volaille"
            aria-expanded="true" aria-controls="volaille">
            <i class="fas fa-fw fa-folder"></i>
            <span>Poussins </span>
        </a>
        <div id="volaille" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Poussins :</h6>
                
                <a class="collapse-item" href="../volaille/volaille.php" id="ajouterUtilisateur">Commande Poussins</a>
                <a class="collapse-item" href="../volaille/comandefourniseur.php">Commande fournisseur</a>
                <a class="collapse-item" href="../volaille/liste.php?date=<?php echo date("Y"); ?>">Liste Commande</a>
                <a class="collapse-item" href="../volaille/listecommande.php?date=<?php echo date("Y");?>">Liste fourniseur</a>
                   
                
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Clinique"
            aria-expanded="true" aria-controls="Clinique">
            <i class="fas fa-fw fa-folder"></i>
            <span>Cliniques </span>
        </a>
        <div id="Clinique" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cliniques :</h6>
                
                <a class="collapse-item" href="../vacin/consultation.php" id="ajouterUtilisateur">Consultation</a>
                <a class="collapse-item" href="../vacin/fichesuivi.php" >Fiche de suivi </a>
                <a class="collapse-item" href="../vacin/tableconsultation.php?date=<?php echo date("Y");?>">Liste Consultation</a>
                <a class="collapse-item" href="../vacin/listesuivi.php?date=<?php echo date("Y");?>" >Liste des suivis</a>
                    
                
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#vaccin"
            aria-expanded="true" aria-controls="vaccin">
            <i class="fas fa-fw fa-folder"></i>
            <span>Vaccins </span>
        </a>
        <div id="vaccin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Vaccins :</h6>
               
                        <a class="collapse-item" href="../vacin/vacin.php" id="ajouterUtilisateur">Adminitrer un Vaccin</a>
                        <a class="collapse-item" href="../vacin/liste.php?date=<?php echo date("Y");?>">Liste Vaccin</a>
                                  
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#depense"
            aria-expanded="true" aria-controls="depense">
            <i class="fas fa-fw fa-folder"></i>
            <span>Dépense</span>
        </a>
        <div id="depense" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Dépense:</h6>
                
                        <a class="collapse-item" href="../depenses/depense.php">Dépense</a>
                        <a class="collapse-item" href="../depenses/liste.php?date=<?php echo date("Y");?>">Liste des Dépenses</a>
                
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#service"
            aria-expanded="true" aria-controls="service">
            <i class="fas fa-fw fa-folder"></i>
            <span>Service </span>
        </a>
        <div id="service" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Service :</h6>
                
                    <a class="collapse-item" href="../service/service.php" id="ajouterUtilisateur">Descente sur terrain</a>
                    <a class="collapse-item" href="../service/liste.php?date=<?php echo date("Y");?>">Liste </a>
                  
                
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Prospection"
            aria-expanded="true" aria-controls="Prospection">
            <i class="fas fa-fw fa-folder"></i>
            <span>Prospection</span>      </a>
        <div id="Prospection" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Employé :</h6>
                <a class="collapse-item" href="../prospection/prospection.php">Ajouter Prospection</a>
                <a class="collapse-item" href="../prospection/image.php">Ajouter image</a>
                <a class="collapse-item" href="../prospection/liste.php?date=<?php echo date("Y"); ?>">Liste Prospection</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    

    <!-- Nav Item - Utilities Collapse Menu -->
    

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administrateur
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#employer"
            aria-expanded="true" aria-controls="employer">
            <i class="fas fa-fw fa-folder"></i>
            <span>Employé </span>
        </a>
        <div id="employer" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Personnel :</h6>
                        <a class="collapse-item" href="../../php/employer/employer.php">Ajouter Employé</a>
                        <a class="collapse-item" href="../../php/employer/personnel.php">Liste des Employés </a>
                        <a class="collapse-item" href="../../php/employer/liste.php?date=<?php echo date("Y");?>">Liste salaire </a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
   

    <!-- Nav Item - Charts -->

    
    <li class="nav-item">
        <a class="nav-link" href="../../comptaPhamacie.php">
        <i class="fas fa-fw fa-chart-area"></i>
            Comtabilité<span></span></a>
    </li> 
    <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jounale"
                    aria-expanded="true" aria-controls="jounale">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Journal Comptable</span>
                </a>
                <div id="jounale" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Journal Comptable:</h6>
                        <a class="collapse-item" href="../comptabilite/Journale.php">Jounal</a> 
                    </div>
                </div>
    </li>
    <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inventaire"
                    aria-expanded="true" aria-controls="inventaire">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Analyse Évolutive</span>
                </a>
                <div id="inventaire" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Analyse Évolutive:</h6>
                        <a class="collapse-item" href="../comptabilite/inventaire.php">Analyse Évolutive mois</a> 
                        <a class="collapse-item" href="../comptabilite/invantairesemaine.php">Analyse Évolutive Semaines</a> 
                    </div>
                </div>
    </li>

    <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#etatresultat"
                    aria-expanded="true" aria-controls="etatresultat">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>État des résultats</span>
                </a>
                <div id="etatresultat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">État des résultats:</h6>
                        <a class="collapse-item" href="../comptabilite/etatresultat.php">marge bénéficiaire</a> 
                        <a class="collapse-item" href="../comptabilite/chiffreaffaire.php">Chiffre d'affaires</a>
                        <a class="collapse-item" href="../comptabilite/ProduitStocks.php">Production et Stocks</a>  
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bilan"
                    aria-expanded="true" aria-controls="bilan">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Bilan Comptable</span>
                </a>
                <div id="bilan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Bilan :</h6>
                        <a class="collapse-item" href="../bilan/actif.php">Actif du Bilan</a>
                        <a class="collapse-item" href="../bilan/liste.php">liste des Actifs</a>
                        <a class="collapse-item" href="../bilan/passif.php">Passif du Bilan</a>
                        <a class="collapse-item" href="../bilan/listepasif.php">liste des Passifs</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tresor"
                    aria-expanded="true" aria-controls="tresor">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Trésorerie</span>
                </a>
                <div id="tresor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Trésorerie :</h6>
                        <a class="collapse-item" href="../tresorerie/tresorerie.php"> Trésorerie</a>
                        <a class="collapse-item" href="../tresorerie/liste.php">liste </a>
                        
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#compteresultat"
                    aria-expanded="true" aria-controls="compteresultat">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Compte Résultats : </span>
                </a>
                <div id="compteresultat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Compte Résultats :</h6>
                        <a class="collapse-item" href="../compteresultat/compteresultat.php">Compte Résultats</a>
                        <a class="collapse-item" href="../compteresultat/liste.php">liste </a>
                        
                    </div>
                </div>
            </li>   
        

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    

</ul>

