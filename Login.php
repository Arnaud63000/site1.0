<?php
session_start();

  $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');

  if(isset($_POST['formconnect']))
  {
          $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
          if(!empty($pseudoconnect) AND !empty($_POST['mdpconnect']))
          {
                  $requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?"); // <= on retire la condition du mdp
                  $requser->execute(array($pseudoconnect));
                  $userexist = $requser->rowCount();
                  if($userexist ==1)
                  {
                          $userinfo = $requser->fetch();
                          if(password_verify($_POST['mdpconnect'], $userinfo ['motdepasse'])) 
                          {
	                          $_SESSION['id'] = $userinfo['id'];
	                          $_SESSION['pseudo'] = $userinfo['pseudo'];
	                          $_SESSION['mail'] = $userinfo['mail'];
	                          header("location: profil.php?id=".$_SESSION['id']);
                          }
                          else
                          $erreur = "Mauvais Identifiant !";
                  }
                  else
                  {
                          $erreur = "Mauvais Identifiant !";
                  }
          }
          else
          {
                  $erreur = "Tous les champs doivent être complétés !";
          }
  }        
      
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style_Login.css">
        <title>Connexion</title>
    </head>
<body>
  
   <header class="container-fluid header">
            <div class="container">  
                <a href="#portfolio" class="logo"> Blog </a>
                <nav class="menu">
                    <a href="index.php"> Acceuil </a>
                    <a href=""> A propos </a>  
                    <a href=""> Contact </a>
                 </nav>
             </div>
    </header>

    <section class="container-fluid banner">
        <div class="ban">
            <img src="photos/egypte.jpg" alt="bannière du site">
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

     <section class="container-fluid LoginBox">
        <div class="container">
          <div class="bandeau">
            <h2 id="portfolio"> Connexion </h2>

        <form action="" method="post" class="formulaireCON">

        	<table>
          <tr>
            <td>
                <label for="pseudo">Pseudo :</label>
              </td>
                 <td> <input type="text" id="pseudo" name="pseudoconnect" placeholder="Votre Pseudo">
                 </td>
               </tr>
				
				 <tr>
            <td>
                <label for="mdp">Mot de passe :</label>
              </td>
                 <td> <input type="password" id="mdpconnect" name="mdpconnect" placeholder="Mot de passe">
                 </td>
               </tr>
				<tr>
					<td>
                 <input type="submit" name="formconnect" value="Se connecter" class="bouton">
			</td>
		</tr>
             </table>
        </form>
                <?php
                  if(isset($erreur))
                  {
                    echo $erreur;
                  }
                ?>

            
            <article class="item-folio"></article>
            </div>
        </div>
    </section>

                
         </body>
           </html>