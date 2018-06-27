<?php
session_start();

  $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
      
  if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
  {
    $getid  = intval($_SESSION['id']);
    $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="Style_Profil.css">
        <title>Profil</title>
    </head>
<body>
  
   <header class="container-fluid header">
            <div class="container">  
                <a href="#portfolio" class="logo"> Blog </a>
                <nav class="menu">
                    <a href="index.php"> Accueil </a>
                    <a href=""> A propos </a>  
                    <a href=""> Contact </a>
                    <?php 
              //Si le membre est connecté j'affiche le menu membre
              if(isset($_SESSION['id'])){ ?>
               
              <?php { htmlentities(trim($_SESSION['id']));
              }
              ?>
              <a href="profil.php"> Profil </a><a href="Logout.php"> Deconnexion </a>
               
              <?php 
              }
              ?>
               
              <?php
              //Si le membre n'est pas connecté on affiche le menu visiteur
               if(empty($_SESSION['id'])) 
                { 
                ?>
              <a href="Login.php">Connexion</a> <a href="Register.php"> Inscription</a>
               
              <?php 
              }
              ?>
                 </nav>
             </div>
    </header>

    <section class="container-fluid banner">
        <div class="ban">
            <img src="egypte.jpg" alt="bannière du site">
                </div>
              <div class="text-banner">
            <h1>L'Egypte</h1>
        </div>
    </section>


  <div class="barre">
         <nav class="rubrique">
            <a href="Pyramide.php">Pyramides </a>
            <a href="Tombeaux.php">Tombeaux </a>
            <a href="Nil.php">Le nil </a>
            <a href="Dieu.php">Divinités </a>
            <a href="Sphinx.php"> Le Sphinx</a>
         </nav>
    </div>

     <section class="container-fluid ProfilBox">
        <div class="container">
          <div class="bandeau">
            <h2 id="portfolio"> Profil de <?php echo $userinfo['pseudo']; ?> </h2>
                
                <?php
                if(!empty($userinfo['avatar']))
                {
                ?>
                <img src="avatars/<?php echo $userinfo['avatar'] ?>" width="150" />
                <?php
                }
                ?>
                <br /> <br />
                  Pseudo : <?php echo $userinfo['pseudo']; ?>
                 <br />
                 Mail : <?php echo $userinfo['mail']; ?>
                  <br />
                <?php
                  if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
                  {
                  ?>
                    <a href="EditionProfil.php">Editer mon profil</a>
                  <?php
                  }
                  ?>
    </section>

                
  </body>
 </html>
 <?php
}
?>
