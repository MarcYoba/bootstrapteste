<?php
session_start(); 
require_once("php/activesaision.php");
?>
 <?php 
        if (!isset($_SESSION["route"])) {
            header('Location:../../index.php');
        }
        
            echo '<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">';
        ?>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ABGROUP <sup>2</sup></div>
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
                <h6 class="collapse-header">Operation de vente</h6>
                
                    <a class="collapse-item" href="../vente/vente.php" id="ajouterVente"> ajouter une vente</a>
                    <a class="collapse-item" href="../vente/liste.php">liste vente</a>
                        
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
                <h6 class="collapse-header">Operation des Achat</h6>
                
                        <a class="collapse-item" href="../achat/teste.php" id="ajouterAcaht">ajouter un Achat</a>
                        <a class="collapse-item" href="../achat/liste.php">liste Achat</a>
                      
                
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
                <h6 class="collapse-header">Operation des clients</h6>
                
                        <a class="collapse-item" href="../client/client.php" id="ajouterClient">ajouter un client</a>
                        <a class="collapse-item" href="../client/liste.php">liste client</a>
                        <a class="collapse-item" href="../client/clientInactif.php">liste des client Inactif client</a>
                        
               
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
                <h6 class="collapse-header">Operation des produit</h6>
                
                            <a class="collapse-item" href="../produit/produit.php" id="ajouterProduit">ajouter un produit</a>
                            <a class="collapse-item" href="../produit/liste.php">liste produit</a>
                            <a class="collapse-item" href="../produit/Peramtion.php">Date Peramtion</a>
                                  
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
                <h6 class="collapse-header">Operation des Fourniseurs</h6>
                
                        <a class="collapse-item" href="../fournisseur/fourniseur.php" id="ajouterFourniseur">ajouter un Fournisseur</a>
                        <a class="collapse-item" href="../fournisseur/liste.php">liste Fournisseur</a>
                    
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
                <h6 class="collapse-header">Operation des Stock</h6>
                
                        <a class="collapse-item" href="../stock/sctockVente.php">Historique </a>
                        <a class="collapse-item" href="../achat/liste.php">Stock Achat </a>
                        <a class="collapse-item" href="../stock/recaptliste.php">Recapitulatif </a>
                        <a class="collapse-item" href="../stock/editeStock.php" id="ajouterStock">Stock Initiale / Inventaire </a>
                        
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
                
                            <a class="collapse-item" href="../versement/versement.php" id="ajouterVersement">ajouter versement</a>
                            <a class="collapse-item" href="../versement/liste.php">Liste versement</a>

            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dette"
            aria-expanded="true" aria-controls="dette">
            <i class="fas fa-fw fa-folder"></i>
            <span>Dette client</span>
        </a>
        <div id="dette" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Dette:</h6>
                
                            <a class="collapse-item" href="../dette/dette.php">Liste credit</a>
                   
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
                <h6 class="collapse-header">Dette:</h6>
                
                        <a class="collapse-item" href="../caisse/caisse.php" id="ajouterCaise">Caisse</a>
                        <a class="collapse-item" href="../caisse/liste.php">liste caisse</a>
                        
                
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
                
                        <a class="collapse-item" href="../userCon/page.php" id="ajouterUtilisateur">ajouter utilisateur</a>
                        <a class="collapse-item" href="../userCon/liste.php">Liste</a>
                        
                
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#volaille"
            aria-expanded="true" aria-controls="volaille">
            <i class="fas fa-fw fa-folder"></i>
            <span>Poussin </span>
        </a>
        <div id="volaille" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Volaille :</h6>
                
                        <a class="collapse-item" href="../volaille/volaille.php" id="ajouterUtilisateur">Commande</a>
                        <a class="collapse-item" href="../volaille/comandefourniseur.php">Commande fourniseur</a>
                        <a class="collapse-item" href="../volaille/liste.php">Liste</a>
                        <a class="collapse-item" href="../volaille/listecommande.php">Liste fourniseur</a>
                   
                
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Clinique"
            aria-expanded="true" aria-controls="Clinique">
            <i class="fas fa-fw fa-folder"></i>
            <span>Clinique </span>
        </a>
        <div id="Clinique" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Clinique :</h6>
                
                        <a class="collapse-item" href="../vacin/consultation.php" id="ajouterUtilisateur">Consultation</a>
                        <a class="collapse-item" href="../vacin/fichesuivi.php" >fiche suivi </a>
                        <a class="collapse-item" href="../vacin/tableconsultation.php">liste Consultation</a>
                        <a class="collapse-item" href="../vacin/listesuivi.php" >liste des suivi</a>
                    
                
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#vaccin"
            aria-expanded="true" aria-controls="vaccin">
            <i class="fas fa-fw fa-folder"></i>
            <span>Vaccin </span>
        </a>
        <div id="vaccin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Vaccin :</h6>
               
                        <a class="collapse-item" href="../vacin/vacin.php" id="ajouterUtilisateur">Adminitrer un Vaccin</a>
                        <a class="collapse-item" href="../vacin/liste.php">Liste Vaccin</a>
                                  
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#depense"
            aria-expanded="true" aria-controls="depense">
            <i class="fas fa-fw fa-folder"></i>
            <span>Depense</span>
        </a>
        <div id="depense" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Depense:</h6>
                
                        <a class="collapse-item" href="../depenses/depense.php">Depenses</a>
                        <a class="collapse-item" href="../depenses/liste.php">Liste Depense</a>
                
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
                    <a class="collapse-item" href="../service/liste.php">Liste </a>
                  
                
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
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Composant vente</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Dette :</h6>
                
                        <a class="collapse-item" href="../dette/dette.php">Liste dette</a>
                       
                
                <!--<a class="collapse-item" href="cards.html">Dette client</a>-->
            </div>
        </div>
       
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Uotils</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                
                        <a class="collapse-item" href="../caisse/liste.php">liste caisse</a>
                        <a class="collapse-item" href="../depenses/depense.php">Depenses</a>
                        <a class="collapse-item" href="../depenses/liste.php">Liste Depense</a>
                     
              <!--  <a class="collapse-item" href="../caisse/caisse.php" id="ajoutCaise">Caisse</a> -->
                
            </div>
        </div>
    </li>

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
            <span>Employer </span>
        </a>
        <div id="employer" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Employer :</h6>
                
                        <a class="collapse-item" href="../employer/employer.php">Employer</a>
                        <a class="collapse-item" href="../employer/liste.php">Liste </a>
                  
                
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="../../index.php">Login</a>
               <!-- <a class="collapse-item" href="../userCon/page.php" id="ajouteruser">ajouter utilisateur</a> -->
                <a class="collapse-item" href="../userCon/liste.php">Liste</a>
                <a class="collapse-item" href="../userCon/forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="../../404.html">404 Page</a>
                <a class="collapse-item" href="../../blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->

    
            <li class="nav-item">
            <a class="nav-link" href="../../comptaPhamacie.html">
            <i class="fas fa-fw fa-chart-area"></i>
            Statistique<span></span></a>
            </li>';    
        

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

