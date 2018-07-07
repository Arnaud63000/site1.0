<?php
session_start();

 

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <title>Acceuil</title>
    </head>

    <!--contenu du site-->

    <body>
        <!--header-->    
     
       <div id="page">
            <header class="container-fluid site-header">
            <div class="container">  
                <a href="#portfolio" class="logo"> Blog </a>
                <nav class="menu">
                    <a href="#acceuil"> Acceuil </a>
                    <a href="#about"> A propos </a>  
                    <a href="#contact"> Contact </a>                                  
                    <?php 
                    //Si le membre est connecté on affiche le menu-connection
                    if(isset($_SESSION['id']))
                    { 
                    ?>
                     
                    <?php { htmlentities(trim($_SESSION['id']));
                    }
                    ?><a href="profil.php"> Profil </a><a href="Logout.php"> Deconnexion </a></div>
                     
                    <?php 
                    }
                    ?>
                     
                    <?php
                    //Si le membre n'est pas connecté on affiche le menu-deconnecter
                     if(empty($_SESSION['id']))
                    { 
                    ?>
                    <a href="Login.php">Connexion</a> <a href="Register.php"> Inscription</a></div>
                     
                    <?php 
                    } 
                    ?>
                 </nav>
             </div>
    </header>


        <!--end header-->


        <!-- banniere-->
    <main class="site-content">
        <section class="container-fluid banner">
        <div class="ban">
            <img src="photos/egypte.jpg" alt="bannière du site">
                </div>
              <div class="text-banner">
            <h1>L'Egypte</h1>
        </div>
    </section>


        <!--End banniere-->

    <!--à propos-->
    <div class="barre">
         <nav class="rubrique">
            <a href="Pyramide.php">Pyramides </a>
            <a href="Tombeaux.php">Tombeaux </a>
            <a href="Nil.php">Le nil </a>
            <a href="Dieu.php">Divinités </a>
            <a href="Sphinx.php"> Le Sphinx</a>
         </nav>
    </div>
    

    <!--end à propos-->

    <!--présentation-->

    <section class="container-fluid portfolio">
        <div class="container">
            <h2 id="portfolio"> Présentation </h2>
           <p>Bonjour, et bienvenue sur un site dédié à l'EGYPTE. Etant un passioné de l'egypte ancienne je met à disposition quelques grands monuments, si vous voulez les visité, cliquez sur les rubriques disposé sous la bannière</br>Des photos ainsi que l'histoire de l'egypte y sera présenter, les sources seront également en description de chaque articles.</br>Actuellement, le site est en construction et est très susceptible d'évolué au fil du temps, des fonctionnalitées seront rajouté également.</br>Si vous avez des idées de sujets ou si vous aimeriez amélioré le site, merci de me contactez via la rubrique "Contact".</br>Merci à tous et à toutes d'avoir lu ce message de présentation et espère que vous trouviez votre bonheur sur ce site ;)</p> </br><p>Cordialement, la direction ;)</p> 
            
            
            
        </div>
    </section>
    </main>
    <!-- end présentation-->

   <hr>



   <!--footer-->
    <footer class="container-fluid footer"> 
        <div class="containeur">
            <div class="row">
                <h2 id="contact"> Contact </h2>
        <div class="span6">
                    <form method="POST" action="traitement.php" class="formulaireContact">
                       
                        <input id="name" name="name" type="text" class="span3" placeholder="Prénom/Pseudo"> 
                        <input id="email" name="email" type="email" class="span3" placeholder="Adresse mail">
                        <textarea id="message" name="message" class="span6" placeholder="Votre message" rows="5"></textarea>
                         <button id="contact-submit" type="submit" class="btn btn-primary input-medium pull-right">Envoyez</button>
  
                </form>
            </div>
         </div>

        </div>
        
    </footer>

    </div>
   
    <!--end footer-->

    </body>
</html>

