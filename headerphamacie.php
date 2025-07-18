
    <?php 
        if (!isset($_SESSION["roles"])) {
            header('Location: index.php');
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
                <h6 class="collapse-header">Opérations des ventes</h6>
                <a class="collapse-item" href="phpphamacie/vente/vente.php" id="ajouterVente">Ajouter une vente</a>
                <a class="collapse-item" href="phpphamacie/vente/liste.php?date=<?php echo date("Y"); ?>">Liste des ventes</a>
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
                <a class="collapse-item" href="phpphamacie/achat/teste.php" id="ajouterAcaht">Ajouter un Achat</a>
                <a class="collapse-item" href="phpphamacie/achat/liste.php?date=<?php echo date("Y"); ?>">Liste des Achats</a>
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
                <a class="collapse-item" href="phpphamacie/client/client.php" id="ajouterClient">Ajouter un client</a>
                <a class="collapse-item" href="phpphamacie/client/liste.php">Liste des clients</a>
                <a class="collapse-item" href="phpphamacie/client/clientInactif.php">Liste des clients Inactifs</a>
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
                <a class="collapse-item" href="phpphamacie/produit/produit.php" id="ajouterProduit">Ajouter un produit</a>
                <a class="collapse-item" href="phpphamacie/produit/liste.php">Liste des produits</a>
                <a class="collapse-item" href="phpphamacie/produit/Peremption.php">Date Péremption</a>      
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
                <h6 class="collapse-header">Opérations des Fournisseur</h6>
                <a class="collapse-item" href="phpphamacie/fournisseur/fourniseur.php" id="ajouterFourniseur">Ajouter un Fournisseur</a>
                <a class="collapse-item" href="phpphamacie/fournisseur/liste.php">Liste des Fournisseurs</a>
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
                <h6 class="collapse-header">Opérations des Stock</h6>
                <a class="collapse-item" href="phpphamacie/stock/sctockVente.php?date=<?php echo date("Y"); ?>">Historique </a>
                <a class="collapse-item" href="phpphamacie/stock/recaptliste.php?date=<?php echo date("m"); ?>">Récapitulatif</a>
                <a class="collapse-item" href="phpphamacie/stock/editeStock.php" id="ajouterStock">Stock Initiale / Inventaire</a>
                <a class="collapse-item" href="phpphamacie/stock/valeurstock.php?date=<?php echo date("Y") ?>">Valeurs stocks</a>
                <a class="collapse-item" href="phpphamacie/stock/quantiteStock.php?date=<?php echo date("Y") ?>">Quantite en stock</a>
                <a class="collapse-item" href="phpphamacie/stock/prixachat.php?date=<?php echo date("Y") ?>">Prix d'achat</a> 

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
                <a class="collapse-item" href="phpphamacie/versement/versement.php" id="ajouterVersement">Ajouter versement</a>
                <a class="collapse-item" href="phpphamacie/versement/liste.php?date=<?php echo date("Y"); ?>">Liste des versements</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dette"
            aria-expanded="true" aria-controls="dette">
            <i class="fas fa-fw fa-folder"></i>
            <span>Créance client</span>      </a>
        <div id="dette" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Dette:</h6>
            <a class="collapse-item" href="phpphamacie/dette/dette.php?date=<?php echo date("Y"); ?>">Créance client</a>
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
                <a class="collapse-item" href="phpphamacie/caisse/caisse.php" id="ajouterCaise">Caisse</a>
                <a class="collapse-item" href="phpphamacie/caisse/liste.php?date=<?php echo date("Y"); ?>">Liste caisse</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Depense"
            aria-expanded="true" aria-controls="Depense">
            <i class="fas fa-fw fa-folder"></i>
            <span>Dépense</span>      </a>
        <div id="Depense" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Dépense:</h6>
                <a class="collapse-item" href="phpphamacie/depenses/depense.php"> Ajouter Dépense</a>
                <a class="collapse-item" href="phpphamacie/depenses/liste.php?date=<?php echo date("Y"); ?>">Liste des Dépenses</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#utilisateur"
            aria-expanded="true" aria-controls="utilisateur">
            <i class="fas fa-fw fa-folder"></i>
            <span>Utilisateur</span>
        </a>
        <div id="utilisateur" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Utilisateur:</h6>
                <a class="collapse-item" href="phpphamacie/userCon/page.php" id="ajouterUtilisateur">Ajouter utilisateur</a>
                <a class="collapse-item" href="phpphamacie/userCon/liste.php">Liste des utilisateurs</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#volaille"
            aria-expanded="true" aria-controls="volaille">
            <i class="fas fa-fw fa-folder"></i>
            <span>Poussins</span>      </a>
        <div id="volaille" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Poussins</h6>
                <a class="collapse-item" href="phpphamacie/volaille/volaille.php">Ajouter Commande</a>
                <a class="collapse-item" href="phpphamacie/volaille/liste.php?date=<?php echo date("Y"); ?>">Liste Commande</a>
                <a class="collapse-item" href="phpphamacie/volaille/comandefourniseur.php">Commande fourniseur</a>
                <a class="collapse-item" href="phpphamacie/volaille/listecommande.php?date=<?php echo date("Y"); ?>">Liste fourniseur</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Clinique"
            aria-expanded="true" aria-controls="Clinique">
            <i class="fas fa-fw fa-folder"></i>
            <span>Clinique</span>      
        </a>
        <div id="Clinique" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Clinique :</h6> 
                <a class="collapse-item" href="phpphamacie/vacin/consultation.php" >Consultation</a> 
                <a class="collapse-item" href="phpphamacie/vacin/fichesuivi.php" >Fiche de suivi</a>      
                <a class="collapse-item" href="phpphamacie/vacin/tableconsultation.php?date=<?php echo date("Y"); ?>" >Liste Consultation</a> 
                <a class="collapse-item" href="phpphamacie/vacin/listesuivi.php?date=<?php echo date("Y"); ?>" >Liste des suivi</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#vaccin"
            aria-expanded="true" aria-controls="vaccin">
            <i class="fas fa-fw fa-folder"></i>
            <span>Vaccins</span>      </a>
        <div id="vaccin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Vaccins :</h6>
                <a class="collapse-item" href="phpphamacie/vacin/vacin.php" id="ajouterUtilisateur">Adminitrer un Vaccin</a>
                <a class="collapse-item" href="phpphamacie/vacin/liste.php?date=<?php echo date("Y"); ?>">Liste des Vaccins</a>
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
                <a class="collapse-item" href="phpphamacie/service/service.php" id="ajouterUtilisateur">Descente sur terrain</a>
                <a class="collapse-item" href="phpphamacie/service/liste.php?date=<?php echo date("Y"); ?>">Liste </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#employer"
            aria-expanded="true" aria-controls="employer">
            <i class="fas fa-fw fa-folder"></i>
            <span>Employé</span>      </a>
        <div id="employer" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Employé :</h6>
                <a class="collapse-item" href="php/employer/employer.php">Ajouter Employé</a>
                <a class="collapse-item" href="php/employer/liste.php?date=<?php echo date("Y"); ?>">Liste Employé</a>
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
                <a class="collapse-item" href="php/prospection/prospection.php">Ajouter Prospection</a>
                <a class="collapse-item" href="php/prospection/image.php">Ajouter image</a>
                <a class="collapse-item" href="php/prospection/liste.php?date=<?php echo date("Y"); ?>">Liste Prospection</a>
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

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="comptaPhamacie.php">
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
                        <a class="collapse-item" href="phpphamacie/comptabilite/Journale.php">Jounal Comptable</a> 
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
                        <a class="collapse-item" href="phpphamacie/comptabilite/inventaire.php">Analyse Évolutive mois</a> 
                        <a class="collapse-item" href="phpphamacie/comptabilite/invantairesemaine.php">Analyse Évolutive Semaines</a> 
                    </div>
                </div>
    </li>

    <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#etatresultat"
                    aria-expanded="true" aria-controls="etatresultat">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Etat des résultats</span>
                </a>
                <div id="etatresultat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Etat des résultats:</h6>
                        <a class="collapse-item" href="phpphamacie/comptabilite/etatresultat.php">Marge bénéficiaire</a> 
                        <a class="collapse-item" href="phpphamacie/comptabilite/chiffreaffaire.php">Chiffre d'affaires</a>      
                        <a class="collapse-item" href="phpphamacie/comptabilite/ProduitStocks.php">Production et Stocks</a>  
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
                        <a class="collapse-item" href="phpphamacie/bilan/actif.php">Actif du Bilans</a>
                        <a class="collapse-item" href="phpphamacie/bilan/liste.php">liste des Actifs</a>
                        <a class="collapse-item" href="phpphamacie/bilan/passif.php">Passif du Bilans</a>
                        <a class="collapse-item" href="phpphamacie/bilan/listepasif.php">liste des Passifs</a>
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
                        <a class="collapse-item" href="phpphamacie/tresorerie/tresorerie.php"> Trésorerie</a>
                        <a class="collapse-item" href="phpphamacie/tresorerie/liste.php">liste </a>
                        
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#compteresultat"
                    aria-expanded="true" aria-controls="compteresultat">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Compte Résultat : </span>
                </a>
                <div id="compteresultat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"> Compte Résultat :</h6>
                        <a class="collapse-item" href="phpphamacie/rapport/rapportComptable.php">Compte de Resultat</a>
                        
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