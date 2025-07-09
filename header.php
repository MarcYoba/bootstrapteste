
    <?php 
        if (!isset($_SESSION["roles"])) {
            header('Location: index.php');
        }
        if (($_SESSION["zonetravail"] == "Tous") && ($_SESSION["route"] == "cabinet")) {
            echo '<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">';
        } else {
            echo '<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">';
        }
        
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
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
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
                <h6 class="collapse-header">Opérations des Ventes</h6>      
                <a class="collapse-item" href="php/vente/vente.php" id="ajouterVente"> Ajouter une vente</a>
                <a class="collapse-item" href="php/vente/liste.php?date=<?php echo date("Y") ?>">Liste des ventes</a>
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
                <a class="collapse-item" href="php/achat/teste.php" id="ajouterAcaht">Ajouter un Achat</a>
                <a class="collapse-item" href="php/achat/liste.php?date=<?php echo date("Y") ?>">Liste des Achats</a>
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
                <a class="collapse-item" href="php/client/client.php" id="ajouterClient">Ajouter un client</a>
                <a class="collapse-item" href="php/client/liste.php">Liste des clients</a>
                <a class="collapse-item" href="php/client/clientInactif.php">Liste des clients Inactifs </a>
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
                <a class="collapse-item" href="php/produit/produit.php" id="ajouterProduit">Ajouter un produit</a>
                <a class="collapse-item" href="php/produit/liste.php">Liste des produits</a>
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
                <h6 class="collapse-header">Opérations des Fournisseurs</h6>
                <a class="collapse-item" href="php/fournisseur/fourniseur.php" id="ajouterFourniseur">Ajouter un Fournisseur</a>
                <a class="collapse-item" href="php/fournisseur/liste.php">Liste des Fournisseurs</a>
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
                <a class="collapse-item" href="php/stock/sctockVente.php?date=<?php echo date("Y") ?>">Historique</a>
                <a class="collapse-item" href="php/achat/liste.php?date=<?php echo date("Y") ?>">List des Achats </a>
                <a class="collapse-item" href="php/stock/recaptliste.php?date=<?php echo date("Y") ?>">Récapitulatif</a> 
                <a class="collapse-item" href="php/stock/editeStock.php" id="ajouterStock">Stock Initiale / Inventaire</a>
                <a class="collapse-item" href="php/stock/valeurstock.php?date=<?php echo date("Y") ?>">Valeurs stocks</a>
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
                <h6 class="collapse-header">Versement:</h6>      <a class="collapse-item" href="php/versement/versement.php" id="ajouterVersement">Ajouter versement</a>
                <a class="collapse-item" href="php/versement/liste.php?date=<?php echo date("Y") ?>">Liste des versements</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dette"
            aria-expanded="true" aria-controls="dette">
            <i class="fas fa-fw fa-folder"></i>
            <span>Créance Client</span>      </a>
        <div id="dette" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Créance Client</h6>
            <a class="collapse-item" href="php/dette/dette.php?date=<?php echo date("Y") ?>">Liste des credits</a>
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
                <a class="collapse-item" href="php/caisse/caisse.php" id="ajouterCaise">Caisse</a>
                <a class="collapse-item" href="php/caisse/liste.php?date=<?php echo date("Y") ?>">Liste caisse</a> 
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
                <a class="collapse-item" href="php/userCon/page.php" id="ajouterUtilisateur">Ajouter utilisateur</a>
                <a class="collapse-item" href="php/userCon/liste.php">Liste</a>
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
                <a class="collapse-item" href="php/depenses/depense.php">Depenses</a>
                <a class="collapse-item" href="php/depenses/liste.php?date=<?php echo date("Y") ?>">Liste Depense</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Prospection"
            aria-expanded="true" aria-controls="Prospection">
            <i class="fas fa-fw fa-folder"></i>
            <span>Prospection</span>
        </a>
        <div id="Prospection" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Prospection:</h6>
                <a class="collapse-item" href="php/prospection/prospection.php">prospection</a>
                <a class="collapse-item" href="php/prospection/image.php">Ajouter image</a>
                <a class="collapse-item" href="php/prospection/liste.php?date=<?php echo date("Y") ?>">Liste Prospection</a>
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
            <h6 class="collapse-header">Employé :</h6>      
            <a class="collapse-item" href="php/employer/employer.php">Ajouter Employé</a>
            <a class="collapse-item" href="php/employer/liste.php">Liste des Employé </a>
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
                <a class="collapse-item" href="index.php">Login</a>
                <a class="collapse-item" href="php/userCon/page.php">Register</a>
                <a class="collapse-item" href="php/userCon/liste.php">Liste</a>
                <a class="collapse-item" href="php/userCon/forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="comptabilite.php">
            <i class="fas fa-fw fa-chart-area"></i>
            Comptabilité<span></span></a>
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
                        <a class="collapse-item" href="php/comptabilite/Journale.php">Jounal</a> 
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
                        <a class="collapse-item" href="php/comptabilite/inventaire.php">Analyse Évolutive mois</a> 
                        <a class="collapse-item" href="php/comptabilite/invantairesemaine.php">Analyse Évolutive Semaines</a> 
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
                        <a class="collapse-item" href="php/comptabilite/etatresultat.php">Marge bénéficiaire</a>       
                        <a class="collapse-item" href="php/comptabilite/chiffreaffaire.php">Chiffre d'affaires</a>      
                        <a class="collapse-item" href="php/comptabilite/ProduitStocks.php">Produit et Stocks</a>  
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
                        <a class="collapse-item" href="php/bilan/actif.php">Actif du Bilan</a>
                        <a class="collapse-item" href="php/bilan/liste.php">liste des Actifs</a>
                        <a class="collapse-item" href="php/bilan/passif.php">Passif du Bilan</a>
                        <a class="collapse-item" href="php/bilan/listepasif.php">liste des Passifs</a>
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
                        <h6 class="collapse-header">Trésorerie :</h6>      
                        <a class="collapse-item" href="php/tresorerie/tresorerie.php">Ajouter Trésorerie</a>
                        <a class="collapse-item" href="php/tresorerie/liste.php">liste des Trésoreries </a>
                        
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#compteresultat"
                    aria-expanded="true" aria-controls="compteresultat">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Compte résultat : </span>
                </a>
                <div id="compteresultat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Compte résultat :</h6>
                        <a class="collapse-item" href="php/rapport/rapportComptable.php">Rapport Comptable</a>
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