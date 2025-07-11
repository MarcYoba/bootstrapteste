<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/ico/favicon.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/ico/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/ico/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/ico/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" href="assets/img/ico/apple-touch-icon-57x57.png">

    <title>GESTION DE STOCK</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/plugins.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/pe-icons.css" rel="stylesheet">

</head>

<body id="page-top" class="regular-navigation">


    <div class="master-wrapper">

        <div class="preloader">
            <div class="preloader-img">
            <!-- 	<span class="loading-animation animate-flicker"><img src="assets/img/loading.GIF" alt="loading" /></span>-->
            </div>
        </div>

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top fadeInDown" data-wow-delay="0.2s">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand smoothie" href="index.php">ABGROUP<span class="theme-accent-color">SARL</span></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="main-navigation">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#about" class="page-scroll">About Us</a></li>  
                        <li><a href="#informatique" class="page-scroll">informatique</a></li> 
                        <li><a href="#commerce" class="page-scroll">general trade</a></li> 
                        <li><a href="#provenderie" class="page-scroll">Provenderie</a></li>      
                        <li><a href="#pharmacie" class="page-scroll">Pharmacie</a></li>   
                        <li><a href="#Client" class="page-scroll">Client</a></li>                
                        <li><a href="#search"><i class="fa fa-search"></i></a></li>
                    </ul>

                </div>
                <!-- /.navbar-collapse -->         

            </div>
            <!-- /.container-fluid -->
        </nav>

        <div id="search-wrapper">
            <button type="button" class="close">×</button>
            <form>
                <input type="search" value="" placeholder="Enter Search Term" />
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <!-- Header -->
        <header id="headerwrap" class="backstretched fullheight">
            <div class="container-fluid fullheight">
                <div class="vertical-center row">
                    <div class="col-sm-1 pull-left text-center slider-control match-height">
                        <a href="#" class="prev-bs-slide vertical-center wow fadeInLeft" data-wow-delay="0.8s"><i class="fa fa-long-arrow-left"></i></a>
                    </div>
                    <div class="intro-text text-center smoothie col-sm-10 match-height">                    
                        <div class="intro-heading wow fadeIn heading-font" data-wow-delay="0.8s"><img src="assets/img/intro-logo.png"></div>              
                    </div>
                    <div class="col-sm-1 pull-right text-center slider-control match-height">
                        <a href="#" class="next-bs-slide vertical-center wow fadeInRight" data-wow-delay="0.8s"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </header>

        <section id="about" class="top-border-me">
            <div class="section-inner">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center mb100">                        
                            <h2 class="section-heading">WE <span class="theme-accent-color">are</span> Welcome</h2>
                            <hr class="thin-hr">
                            <h3 class="section-subheading secondary-font">Nous sommes très heureux de te voir.</h3>
                        </div>
                        
                        <div class="col-sm-12 nopadding-lr dark-wrapper opaqued background-cover left-half" style="background-image: url('assets/img/bg/bg3.jpg');">
                            <div class="dark-opaqued-half section-inner pad-sides-60 match-height" data-mh="promo-inner">
                                <h3 class="mb50">commerce,  <span class="theme-accent-color">Informatique</span></h3>
                                <p class="lead mb50">AB COMPTA est un logiciel de gestion informatique qui est une 
                                    solution centralisée conçue pour aider les entreprises à superviser les ventes 
                                    et optimiser l'ensemble de leur parc technologique, incluant les postes de travail, serveurs, périphériques réseau, logiciels et licences. 
                                    Il permet généralement d'automatiser des tâches essentielles telles que l'inventaire des actifs,
                                    la surveillance des performances des ventes journalières, ainsi que la gestion des incidents de stock. 
                                    En offrant une vue d'ensemble et un contrôle accru sur l'infrastructure,
                                    ce type de logiciel vise à améliorer l'efficacité opérationnelle, renforcer la sécurité, réduire les pertes et assurer la conformité réglementaire.</p>
                                <div class="spacer-180"></div>
                                <p class="mt30"><a href="https://fayacomputer.wuaze.com" class="btn btn-primary btn-red page-scroll">FAYA COMPUTER</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <h2 class="mb50">About <span class="theme-accent-color">US</span></h2>
                                <p class="lead">The AB GROUP company provides you with a veterinary practice and a feed mill with the following services</p>
                            </div>

                            <div class="col-md-5">
                                <h2 class="mb50">TO <span class="theme-accent-color">THE</span></h2>
                                <p class="lead">clinic (vaccination, hospitalization) <br> - pharmacy (retail and wholesale sale of veterinary products)<br> - training in breeding <br>- advice and monitoring of breeding, setting up of business plans<br> - assistance in finding financing for your farms<br> - supply of poultry feed, small and large livestock<br> - sales of raw materials in retail and wholesale<br> - sale of day-old chicks</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section id="informatique" class="top-border-me">
            <div class="section-inner">

                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-12 nopadding-lr dark-wrapper opaqued background-cover left-half" style="background-image: url('assets/img/bg/bg3.jpg');">
                            <div class="dark-opaqued-half section-inner pad-sides-60 match-height" data-mh="promo-inner">
                                <h3 class="mb50">commerce,  <span class="theme-accent-color">Informatique</span></h3>
                                <p class="lead mb50">AB COMPTA est un logiciel de gestion informatique qui est une 
                                    solution centralisée conçue pour aider les entreprises à superviser les ventes 
                                    et optimiser l'ensemble de leur parc technologique, incluant les postes de travail, serveurs, périphériques réseau, logiciels et licences. 
                                    Il permet généralement d'automatiser des tâches essentielles telles que l'inventaire des actifs,
                                    la surveillance des performances des ventes journalières, ainsi que la gestion des incidents de stock. 
                                    En offrant une vue d'ensemble et un contrôle accru sur l'infrastructure,
                                    ce type de logiciel vise à améliorer l'efficacité opérationnelle, renforcer la sécurité, réduire les pertes et assurer la conformité réglementaire.</p>
                                <div class="spacer-180"></div>
                                <?php
                                    if (($_SESSION["roles"] == "administrateur") || ($_SESSION['zonetravail'] == "fayacomputer") ) {
                                        echo '<p class="mt30"><a href="https://fayacomputer.wuaze.com" class="btn btn-primary btn-red page-scroll">FAYA COMPUTER</a></p>';  
                                    }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="commerce" class="top-border-me">
            <div class="section-inner">

                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-12 nopadding-lr dark-wrapper opaqued background-cover left-half" style="background-image: url('assets/img/bg/bg14.jpg');">
                            <div class="dark-opaqued-half section-inner pad-sides-60 match-height" data-mh="promo-inner">
                                <h3 class="mb50">commerce,  <span class="theme-accent-color">Informatique</span></h3>
                                <p class="lead mb50">AB COMPTA est un logiciel de gestion informatique qui est une 
                                    solution centralisée conçue pour aider les entreprises à superviser les ventes 
                                    et optimiser l'ensemble de leur parc technologique, incluant les postes de travail, serveurs, périphériques réseau, logiciels et licences. 
                                    Il permet généralement d'automatiser des tâches essentielles telles que l'inventaire des actifs,
                                    la surveillance des performances des ventes journalières, ainsi que la gestion des incidents de stock. 
                                    En offrant une vue d'ensemble et un contrôle accru sur l'infrastructure,
                                    ce type de logiciel vise à améliorer l'efficacité opérationnelle, renforcer la sécurité, réduire les pertes et assurer la conformité réglementaire.</p>
                                <div class="spacer-180"></div>
                                <p class="mt30"><a href="#" class="btn btn-primary btn-red page-scroll">Commerce generale</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="pharmacie" class="top-border-me">
            <div class="section-inner">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center mb100">                        
                            <h2 class="section-heading">Information <span class="theme-accent-color">en</span> Pharmacie</h2>
                            
                            <?php           
                                if (($_SESSION["zonetravail"] == "cabinet") || ($_SESSION["zonetravail"] == "Tous")) {
                                    echo '<p class="mt20"><a href="homepahamacie.php" class="btn btn-primary btn-red page-scroll">Aller en pharmacie</a></p>';                
                                }   
                            ?>
                            <hr class="thin-hr">
                            <h3 class="section-subheading secondary-font">Nous sommes très heureux de te voir.</h3>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <h2 class="mb50">VAccin <span class="theme-accent-color">chien</span></h2>
                                <p class="lead">
                                    Les types de vaccins en Chine incluent les vaccins inactivés, les vaccins vivants atténués, les vaccins à sous-unités et les vaccins à vecteur viral.
                                </p>
                            </div>

                            <div class="col-md-5">
                                <h2 class="mb50">Fiche <span class="theme-accent-color">Prophylaxie</span></h2>
                                <p class="lead">
                                    Les fiches de Prophylaxie sont des documents détaillant les protocoles de prévention et de traitement des maladies animales. Elles incluent des informations sur les vaccins, les médicaments, les dosages, les calendriers de vaccination, et les mesures de biosécurité à suivre pour maintenir la santé des animaux.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 nopadding-lr dark-wrapper opaqued background-cover left-half" style="background-image: url('assets/img/bg/bg10.jpg');">
                    <div class="dark-opaqued-half section-inner pad-sides-60 match-height" data-mh="promo-inner">
                        <h3 class="mb50">Jack Ma,  <span class="theme-accent-color">fondateur d'Alibaba</span></h3>
                        <p class="lead mb50">J'ai échoué 3 fois à l'université... Quand KFC est arrivé en Chine, j'ai été le seul à être rejeté... 
                            Je voulais rentrer dans la police et j'ai été le seul à être rejeté. 
                            J'ai postulé 10 fois pour rentrer à Harvard et j'ai été à chaque fois rejeté.</p>
                        <div class="spacer-180"></div>
                        <p class="mt30"><a href="#contact" class="btn btn-primary btn-red page-scroll">Book Now</a></p>
                    </div>
                </div>

                <div class="col-sm-6 nopadding-lr dark-wrapper opaqued background-cover right-half" style="background-image: url('assets/img/bg/bg5.jpg');">
                    <div class="dark-opaqued-half section-inner pad-sides-60 match-height text-right" data-mh="promo-inner">
                        <h3 class="mb50"> Ingvar Kamprad, <span class="theme-accent-color">fondateur d'Ikea </span></h3>
                        <p class="lead mb50">Seuls ceux qui dorment ne commettent pas d'erreurs.</p>
                        <h3 class="mb50"> Molière, <span class="theme-accent-color">phylosophe </span></h3>
                        <p class="lead mb50">Le chemin est long du projet à la chose.</p>
                        <div class="spacer-180"></div>
                        <p class="mt30"><a href="#contact" class="btn btn-primary btn-white page-scroll">View Menu</a></p>
                    </div>
                    
                </div>
            </div>
        </div>

        <section class="dark-wrapper top-border-me opaqued parallax" data-parallax="scroll" data-image-src="assets/img/bg/bg4.jpg" data-speed="0.8">
            <div class="section-inner">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center mb100">                        
                            <h2 class="section-heading">symptôme <span class="theme-accent-color">Clinique</span> animale</h2>
                            <hr class="thin-hr">
                            <h3 class="section-subheading secondary-font">resultat des recherches.</h3>
                        </div>
                    </div>
                </div>

                <div class="wow fadeIn" data-wow-delay="0.2s">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12" role="tabpanel">
                                <div class="text-center">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-justified icon-tabs" id="nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#dustin" aria-controls="dustin" role="tab" data-toggle="tab">
                                                <span class="tabtitle heading-font">Rage</span>                                                
                                                <span class="tabtitle small"><p class="lead">chien</p></span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="">
                                            <a href="#daksh" aria-controls="daksh" role="tab" data-toggle="tab">
                                               <span class="tabtitle heading-font">coccidiose</span>
                                               <span class="tabtitle small"><p class="lead">Volaille.</p></span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="">
                                            <a href="#anna" aria-controls="anna" role="tab" data-toggle="tab">
                                                <span class="tabtitle heading-font">influenza  </span>
                                                <span class="tabtitle small"><p class="lead">aviaire.</p></span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="">
                                            <a href="#wafer" aria-controls="wafer" role="tab" data-toggle="tab">
                                                <span class="tabtitle heading-font">Tuberculose </span>
                                                <span class="tabtitle small"><p class="lead">bovine</p></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt60">
                                    <!-- Tab panes -->
                                    <div class="tab-content" id="tabs-collapse">            
                                        <div role="tabpanel" class="tab-pane fade in active" id="dustin">
                                            <div class="tab-inner">                    
                                                <h2 class="secondary-font mb30">La rage chez les chiens</h2>
                                                <p> est une maladie virale extrêmement 
                                                    grave et mortelle. Elle affecte le système nerveux central de l'animal, 
                                                    provoquant des changements comportementaux radicaux et, finalement, la mort
                                                    Comment se transmet-elle ?<br>

                                                    Morsure: C'est le mode de transmission le plus fréquent. La salive d'un animal infecté, lorsqu'elle pénètre dans une plaie, peut transmettre le virus.
                                                    Griffures profondes: Dans certains cas, des griffures profondes peuvent également transmettre la maladie.
                                                    Quels sont les symptômes ?<br>

                                                    Les symptômes de la rage évoluent rapidement et sont généralement divisés en deux phases :
                                                    <br>
                                                    Phase prodromique:
                                                    Changements de comportement : Agressivité inhabituelle, peur de l'eau, hypersalivation, difficulté à avaler.
                                                    Troubles sensoriels : Hypersensibilité aux sons, à la lumière, au toucher.
                                                    Phase paralytique:<br>
                                                    Paralysie progressive : Elle commence souvent par les muscles de la mâchoire, rendant impossible l'alimentation.
                                                    Coma et décès.
                                                </p>         
                                            </div>
                                        </div>
                                        
                                        <div role="tabpanel" class="tab-pane fade" id="daksh">
                                            <div class="tab-inner">                    
                                                <h2 class="secondary-font mb30">La coccidiose chez les animaux</h2>  
                                                <p>La coccidiose est une maladie parasitaire fréquente chez de nombreuses espèces animales, notamment les bovins, les ovins, les caprins, les volailles et les lapins. Elle est causée par des protozoaires appelés coccidies,
                                                     qui se multiplient dans les cellules de l'intestin de l'animal.
                                                </p>         
                                            </div>
                                        </div>
                                        
                                        <div role="tabpanel" class="tab-pane fade" id="anna">
                                            <div class="tab-inner">                    
                                                <h2 class="secondary-font mb30">La grippe aviaire?</h2>  
                                                <p>est une maladie infectieuse qui touche principalement les oiseaux. Elle est causée par des virus de type A du virus de la grippe
                                                    La grippe aviaire, également connue sous le nom d'influenza aviaire, est une maladie virale hautement contagieuse qui affecte principalement les oiseaux, mais peut également infecter d'autres animaux et, dans de rares cas, les humains. Elle est causée par des virus de la famille des Orthomyxoviridae.
                                                    <br>
                                                    Comment se transmet-elle ?<br>

                                                    Contact direct : Les oiseaux peuvent contracter la grippe aviaire par contact direct avec des sécrétions respiratoires ou des excréments d'oiseaux infectés.
                                                    Contact indirect : La maladie peut également se propager par le biais de surfaces contaminées, telles que les cages, les équipements, les vêtements et les chaussures.
                                                    Quels sont les symptômes ?<br>

                                                    Les symptômes de la grippe aviaire varient en fonction de la souche virale et de l'espèce d'oiseau infectée, mais peuvent inclure :
                                                    <br>
                                                    Respiratoires : Toux, éternuements, difficultés respiratoires.
                                                    Digestifs : Diarrhée, perte d'appétit.
                                                    Neurologiques : Tremblements, incoordination.
                                                    Autres : Diminution de la production d'œufs, plumage ébouriffé, gonflement de la tête et du cou.
                                                </p>         
                                            </div>
                                        </div>
                                        
                                        <div role="tabpanel" class="tab-pane fade" id="wafer">
                                            <div class="tab-inner">                    
                                                <h2 class="secondary-font mb30">Tuberculose bovine.</h2>  
                                                <p>
                                                    La tuberculose bovine est une maladie infectieuse chronique causée par la bactérie Mycobacterium bovis. 
                                                    Elle affecte principalement les bovins, 
                                                    mais peut également infecter d'autres animaux et les humains.
                                                </p>         
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="Client">
            <div class="section-inner">

                 <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center mb100">
                            <h2 class="section-heading">votre <span class="theme-accent-color">grand</span> espace</h2>
                            <hr class="thin-hr">
                            
                            <?php           
                                    if (empty($_SESSION['cathegorie'])) {
                                        echo '<p class="mt20"><a href="customer/client.php" class="btn btn-primary btn-red page-scroll">passer une commande</a></p>';
                                        $_SESSION['idclient']  = $_SESSION['id'];          
                                    } else{
                                        echo '<p class="mt20"><a href="customer/transition.php" class="btn btn-primary btn-red page-scroll">passer une commande</a></p>';
                                         
                                    }  
                                ?>
                            <h3 class="section-subheading secondary-font">Bienvenue dans la communauté</h3>
                        </div>
                    </div>
                </div>
                
                <div class="container">

                    <div class="row mb100">
                      

                      

                     
                      
                      
                    </div>

                   
                </div>
            </div>
        </section>


        <section id="provenderie">
            <div class="section-inner">

                 <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center mb100">
                            <h2 class="section-heading">Infomation <span class="theme-accent-color">en</span> provenderi</h2>
                            <hr class="thin-hr">
                            <?php        
                                if (($_SESSION['zonetravail'] == "provenderie") || ($_SESSION["zonetravail"] == "Tous")) {
                                    echo '<p class="mt20"><a href="home.php" class="btn btn-primary btn-red page-scroll">Aller a la provenderie</a></p>';           
                                }
                                if (($_SESSION["roles"] == "administrateur") || ($_SESSION['zonetravail'] == "provenderie douala") ) {
                                    echo '<p class="mt20"><a href="https://www.provenderiedouala.wuaze.com" class="btn btn-primary btn-red page-scroll">Provenderie Douala</a></p>';  
                                    echo '<p class="mt20"><a href="https://www.counting.com" class="btn btn-primary btn-red page-scroll">Provenderie KATAMGA</a></p>';
                                    echo '<p class="mt20"><a href="https://www.limegreen-snail-490218.hostingersite.com" class="btn btn-primary btn-red page-scroll">Provenderie la difference</a></p>';   
                                }
                                if (($_SESSION["zonetravail"] == "difference") || ($_SESSION['zonetravail'] == "difference") ) {
                                    echo '<p class="mt20"><a href="https://www.limegreen-snail-490218.hostingersite.com" class="btn btn-primary btn-red page-scroll">Provenderie la difference</a></p>';  
                                }
                            ?>
                            <h3 class="section-subheading secondary-font">Bienvenue dans la communauté</h3>
                        </div>
                    </div>
                </div>
                
                <div class="container">

                    <div class="row mb100">
                      <div class="col-md-4 wow fadeIn">
                        <h2 class="mb50"><span class="heading-font text-uppercase">Volaille</span></h2>
                        <h3>1-10 jours <span class="theme-accent-color">Prédémarrage</span>200g aliment </h3>
                        <p>Des recettes enrichies sont élaborées pour couvrir les apports nécessaires à son développement et assurer la continuité de l'engraissement.</p>
                        <h3>10-21 jours <span class="theme-accent-color">Démarrage</span>600g</h3>
                        <p>Les poussins ont besoin d'une alimentation riche en protéines pour leur croissance rapide</p>
                        <h3>21-35 jours <span class="theme-accent-color">Engraissement</span>1200g</h3>
                        <p>La quantité diminue légèrement en fin d'élevage: Les besoins énergétiques diminuent légèrement lorsque le poulet atteint son poids d'abattage</p>
                        <h3>35-45 jours <span class="theme-accent-color">finition</span>1000g</h3>
                        <p>L'alimentation doit être adaptée à chaque phase: Il est essentiel de proposer un aliment adapté à chaque étape de croissance du poulet</p>
                      </div>

                      <div class="col-md-4 wow fadeIn">
                        <h2 class="mb50"><span class="heading-font text-uppercase">PORC</span></h2>
                        <h3>.<span class="theme-accent-color">.</span></h3>
                        <p>.</p>
                        <h3>. <span class="theme-accent-color">.</span></h3>
                        <p>..</p>
                        <h3>. <span class="theme-accent-color">.</span></h3>
                        <p>..</p>
                        <h3>. <span class="theme-accent-color">.</span></h3>
                        <p>..</p>
                      </div>

                      <div class="col-md-4 wow fadeIn">
                        <h2 class="mb50"><span class="heading-font text-uppercase">LAPIN</span></h2>
                        <h3>. <span class="theme-accent-color">.</span></h3>
                        <p>.</p>
                        <h3>. <span class="theme-accent-color">.</span></h3>
                        <p>.</p>
                        <h3>. <span class="theme-accent-color">.</span></h3>
                        <p>.</p>
                        <h3>. <span class="theme-accent-color">.</span></h3>
                        <p>.</p>
                      </div>
                      
                      
                    </div>

                   <!-- <div class="row">
                        <div class="col-md-6 wow fadeIn">
                            <h2 class="mb50"><span class="heading-font text-uppercase">Starters</span></h2>
                            <div class="food-menu-item">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img src="assets/img/food/meal4.jpg" class="img-responsive">
                                    </div>
                                    <div class="col-xs-9">
                                        <h3>Lorem Ipsum <span class="theme-accent-color">$8.95</span></h3>
                                        <p>No phone no lights no motor car not a single luxury. Like Robinson Crusoe it's primitive as can be. Like Robinson Crusoe it's primitive as can be</p>
                                    </div>
                                </div>
                            </div>
                            <div class="food-menu-item">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img src="assets/img/food/meal1.jpg" class="img-responsive">
                                    </div>
                                    <div class="col-xs-9">
                                        <h3>Lorem Ipsum <span class="theme-accent-color">$8.95</span></h3>
                                        <p>No phone no lights no motor car not a single luxury. Like Robinson Crusoe it's primitive as can be. Like Robinson Crusoe it's primitive as can be</p>
                                    </div>
                                </div>
                            </div>
                            <div class="food-menu-item">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img src="assets/img/food/meal2.jpg" class="img-responsive">
                                    </div>
                                    <div class="col-xs-9">
                                        <h3>Lorem Ipsum <span class="theme-accent-color">$8.95</span></h3>
                                        <p>No phone no lights no motor car not a single luxury. Like Robinson Crusoe it's primitive as can be. Like Robinson Crusoe it's primitive as can be</p>
                                    </div>
                                </div>
                            </div>
                            <div class="food-menu-item">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img src="assets/img/food/meal3.jpg" class="img-responsive">
                                    </div>
                                    <div class="col-xs-9">
                                        <h3>Lorem Ipsum <span class="theme-accent-color">$8.95</span></h3>
                                        <p>No phone no lights no motor car not a single luxury. Like Robinson Crusoe it's primitive as can be. Like Robinson Crusoe it's primitive as can be</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 wow fadeIn">
                            <h2 class="mb50"><span class="heading-font text-uppercase">Main Course</span></h2>
                            <div class="food-menu-item">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img src="assets/img/food/meal3.jpg" class="img-responsive">
                                    </div>
                                    <div class="col-xs-9">
                                        <h3>Lorem Ipsum <span class="theme-accent-color">$8.95</span></h3>
                                        <p>No phone no lights no motor car not a single luxury. Like Robinson Crusoe it's primitive as can be. Like Robinson Crusoe it's primitive as can be</p>
                                    </div>
                                </div>
                            </div>
                            <div class="food-menu-item">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img src="assets/img/food/meal5.jpg" class="img-responsive">
                                    </div>
                                    <div class="col-xs-9">
                                        <h3>Lorem Ipsum <span class="theme-accent-color">$8.95</span></h3>
                                        <p>No phone no lights no motor car not a single luxury. Like Robinson Crusoe it's primitive as can be. Like Robinson Crusoe it's primitive as can be</p>
                                    </div>
                                </div>
                            </div>
                            <div class="food-menu-item">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img src="assets/img/food/meal6.jpg" class="img-responsive">
                                    </div>
                                    <div class="col-xs-9">
                                        <h3>Lorem Ipsum <span class="theme-accent-color">$8.95</span></h3>
                                        <p>No phone no lights no motor car not a single luxury. Like Robinson Crusoe it's primitive as can be. Like Robinson Crusoe it's primitive as can be</p>
                                    </div>
                                </div>
                            </div>
                            <div class="food-menu-item">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <img src="assets/img/food/meal7.jpg" class="img-responsive">
                                    </div>
                                    <div class="col-xs-9">
                                        <h3>Lorem Ipsum <span class="theme-accent-color">$8.95</span></h3>
                                        <p>No phone no lights no motor car not a single luxury. Like Robinson Crusoe it's primitive as can be. Like Robinson Crusoe it's primitive as can be</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>

        <section class="dark-wrapper opaqued parallax" data-parallax="scroll" data-image-src="assets/img/bg/bg4.jpg" data-speed="0.8">
            <div class="section-inner">
                 <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center mb100">
                            <h2 class="section-heading">LES <span class="theme-accent-color">SERVICE</span> DE CHEF</h2>
                            <hr class="thin-hr">
                            <h3 class="section-subheading secondary-font">Dedicated to excellence.</h3>
                        </div>
                    </div>
                </div>
                <div class="wow fadeIn" data-wow-delay="0.2s">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <ul class="owl-carousel-paged testimonial-owl wow fadeIn list-unstyled" data-items="3" data-items-tablet="[768,2]" data-items-mobile="[479,1]">
                                    <li>
                                        <div class="row hover-item">
                                            <div class="col-xs-12">
                                                <img src="assets/img/team/1.jpg" class="img-responsive smoothie" alt="">
                                            </div>
                                            <div class="col-xs-12 overlay-item-caption smoothie"></div>
                                            <div class="col-xs-12 hover-item-caption smoothie">
                                                <div class="vertical-center">
                                                    <h3 class="smoothie"><a href="#" title="view project">Destin Nouebissi</a></h3>
                                                    <ul class="smoothie list-inline social-links wow fadeIn" data-wow-delay="0.2s">
                                                        <li>
                                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-dribbble"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-behance"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-linkedin"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="col-xs-12 theme-accent-color-bg hover-bar"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row hover-item">
                                            <div class="col-xs-12">
                                                <img src="assets/img/team/2.jpg" class="img-responsive smoothie" alt="">
                                            </div>
                                            <div class="col-xs-12 overlay-item-caption smoothie"></div>
                                            <div class="col-xs-12 hover-item-caption smoothie">
                                                <div class="vertical-center">
                                                    <h3 class="smoothie"><a href="#" title="view project">Dr josephine NG'ONAN</a></h3>
                                                    <ul class="smoothie list-inline social-links wow fadeIn" data-wow-delay="0.2s">
                                                        <li>
                                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-dribbble"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-behance"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-linkedin"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="theme-accent-color-bg hover-bar"></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row hover-item">
                                            <div class="col-xs-12">
                                                <img src="assets/img/team/3.jpg" class="img-responsive smoothie" alt="">
                                            </div>
                                            <div class="col-xs-12 overlay-item-caption smoothie"></div>
                                            <div class="col-xs-12 hover-item-caption smoothie">
                                                <div class="vertical-center">
                                                    <h3 class="smoothie"><a href="single-portfolio.html" title="view project">Dr martin toukam</a></h3>
                                                    <ul class="smoothie list-inline social-links wow fadeIn" data-wow-delay="0.2s">
                                                        <li>
                                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-dribbble"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-behance"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-linkedin"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="theme-accent-color-bg hover-bar"></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row hover-item">
                                            <div class="col-xs-12">
                                                <img src="assets/img/team/4.jpg" class="img-responsive smoothie" alt="">
                                            </div>
                                            <div class="col-xs-12 overlay-item-caption smoothie"></div>
                                            <div class="col-xs-12 hover-item-caption smoothie">
                                                <div class="vertical-center">
                                                    <h3 class="smoothie"><a href="#" title="view project">the best of the fisrt</a></h3>
                                                    <ul class="smoothie list-inline social-links wow fadeIn" data-wow-delay="0.2s">
                                                        <li>
                                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-dribbble"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-behance"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><i class="fa fa-linkedin"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="theme-accent-color-bg hover-bar"></span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="dark-wrapper opaqued parallax" data-parallax="scroll" data-image-src="assets/img/bg/bg10.jpg" data-speed="0.8">
            <div class="section-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center mb100">
                            <h2 class="section-heading">NOS   <span class="theme-accent-color">CLIENTS</span> HEUREUX</h2>
                            <hr class="thin-hr">
                            <h3 class="section-subheading secondary-font">Satisfaction, everytime.</h3>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="owl-carousel-paged testimonial-owl wow fadeIn list-unstyled" data-items="1" data-items-desktop="[1200,1]" data-items-desktop-small="[980,1]" data-items-tablet="[768,1]" data-items-mobile="[479,1]">
                                <li>
                                    <div class="row">
                                        <div class="col-xs-8 col-xs-offset-2 item-caption">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img src="assets/img/team/small1.jpg" class="img-responsive testimonial-author" alt="">
                                                </div>
                                                <div class="col-sm-10">                                                
                                                    <h4>Mr BEN</h4>
                                                    <p>La qualite du service </p>
                                                    <ul class="list-inline">
                                                        <li><i class="fa fa-star theme-accent-color"></i></li>
                                                        <li><i class="fa fa-star theme-accent-color"></i></li>
                                                        <li><i class="fa fa-star theme-accent-color"></i></li>
                                                        <li><i class="fa fa-star theme-accent-color"></i></li>
                                                        <li><i class="fa fa-star theme-accent-color"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-8 col-xs-offset-2 item-caption">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img src="assets/img/team/small1.jpg" class="img-responsive testimonial-author" alt="">
                                                </div>
                                                <div class="col-sm-10">                                                
                                                    <h4>Mr Anatole</h4>
                                                    <p>La Precision des Formules</p>
                                                    <ul class="list-inline">
                                                        <li><i class="fa fa-star theme-accent-color"></i></li>
                                                        <li><i class="fa fa-star theme-accent-color"></i></li>
                                                        <li><i class="fa fa-star theme-accent-color"></i></li>
                                                        <li><i class="fa fa-star theme-accent-color"></i></li>
                                                        <li><i class="fa fa-star theme-accent-color"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="dark-wrapper opaqued parallax" data-parallax="scroll" data-image-src="assets/img/bg/bg1.jpg" data-speed="0.8">
            <div class="section-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center mb100">
                            <h2 class="section-heading">Book <span class="theme-accent-color">Your</span> Table</h2>
                            <hr class="thin-hr">
                            <h3 class="section-subheading secondary-font">Satisfaction, everytime.</h3>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row mb100"> 
                        <!-- Address, Phone & Email -->
                        <div class="col-md-5 col-md-offset-1 wow fadeIn">
                            <h3 class="mb30">Address</h3>
                            <p class="lead">YAOUNDE - CAMEROUN</p>
                            <p class="lead">Fin goudron<br>
                             </p>
                            <p class="lead">6 76 35 90 56<br>
                        </div>

                        <div class="col-md-5 col-sm-7 wow fadeIn">
                            <h3 class="mb30">Opening Times</h3>
                            <div class="row">
                              <div class="col-xs-5">
                                <ul class="list-unstyled weekdays">
                                  <li>Monday</li>
                                  <li>Tuesday</li>
                                  <li>Wednesday</li>
                                  <li>Thursday</li>
                                  <li>Friday</li>
                                  <li>Saturday</li>
                                  <li>Sunday</li>
                                </ul>
                              </div>
                              <div class="col-xs-7">
                                <ul class="list-unstyled">
                                  <li>7:30 AM - 5:00 PM</li>
                                  <li>7:30 AM - 5:00 PM</li>
                                  <li>7:30 AM - 5:00 PM</li>
                                  <li>7:30 AM - 5:00 PM</li>
                                  <li>7:30 AM - 5:00 PM</li>
                                  <li>7:30 AM - 5:00 PM</li>
                                  <li>7:30 AM - 5:00 PM</li>
                                </ul>
                              </div>
                            </div>
                        </div>                
                    </div>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="row">
                                <div id="message" class="col-md-12"></div>
                                <form method="post" action="sendemail.php" id="contactform" class="form-group main-contact-form col-md-12 wow fadeIn" data-wow-delay="0.2s">
                                    <input type="text" class="form-control col-md-4" name="name" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name." />
                                    <input type="text" class="form-control col-md-4" name="email" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address." />
                                    <input type="text" class="form-control col-md-4" name="website" placeholder="Your URL *" id="website" required data-validation-required-message="Please enter your web address." />
                                    <textarea name="comments" class="form-control" id="comments" placeholder="Your Message *" required data-validation-required-message="Please enter a message."></textarea>
                                    <input class="btn btn-primary btn-white mt30 pull-right" type="submit" name="submit" value="Submit" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</section>

       

        <footer class="white-wrapper">
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col-md-12 wow fadeIn mb30" data-wow-delay="0.2s">
                        <span class="copyright">GESTION  DE STOCK</span>
                    </div>
                    <div class="col-md-12">
                        <ul class="list-inline social-links wow fadeIn" data-wow-delay="0.2s">
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-behance"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <div id="bottom-frame"></div>

        <a href="#" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/plugins.js"></script>
   <!--  --> <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="assets/js/init.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript">
    $(document).ready(function(){
       'use strict';
        jQuery('#headerwrap').backstretch([
          "assets/img/bg/bg1.jpg",
          "assets/img/bg/bg2.jpg",
          "assets/img/bg/bg3.jpg",
          "assets/img/bg/bg13.jpg",
        ], {duration: 8000, fade: 500});
    });
    </script>

</body>

</html>
