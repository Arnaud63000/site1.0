<?php
    session_start();
    
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
        

  if(!empty($_SESSION['id']))
  {
    $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
  
   
    if(!empty($_FILES['avatar'])) {
      
        if($_FILES['avatar']['size'] <= 2097152) {
            $extensionsvalides = array('jpg', 'jpeg', 'png');
          

           
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            
            
            if(in_array($extensionUpload, $extensionsvalides)) {
                $chemin = "avatars/".$_SESSION['id'].".".$extensionUpload;
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin)) {
                    $updateavatar = $bdd->prepare('UPDATE membres SET avatar = :avatar WHERE id = :id');
                    $updateavatar->execute(array('avatar' => $_SESSION['id'].".".$extensionUpload, 'id' => $_SESSION['id']));
                    if ($updateavatar->rowCount() == 1) {
                        header('Location: profil.php?id='.$_SESSION['id']);
                    } else {
                        $erreur = "Il y as eu une erreur durant la mise à jour base de votre avatar !";
                    }
                } else {
                    $erreur = "Il y as eu une erreur durant l'importation de votre avatar sur le serveur";
                }
              }
                else
                {
                  $erreur = "Votre avatar doit être au format jpg, jpeg ou png !";
                
            }
        } else {
            $erreur = "Votre avatar ne doit pas dépasser 2Mo !";
        }
    }
      if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
      {
        $pseudo = htmlspecialchars($_POST['newpseudo']);
        $pseudolenght = strlen($pseudo);
        if($pseudolenght <= 20)
        {
          $reqpseudo = $bdd->prepare('SELECT * FROM membres WHERE pseudo = ?');
          $reqpseudo->execute(array($pseudo));
          $pseudoexist = $reqpseudo->rowCount();
          if($pseudoexist ==0)
        {
          $newpseudo = htmlspecialchars($_POST['newpseudo']);
          $insertpseudo =$bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
          $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
          header('Location: profil.php?id='.$_SESSION['id']);
          }
          else
          {
            $erreur = "Pseudo déjà utilisé !";
          }
            }
            else
            {
              $erreur = "Votre pseudo ne doit pas dépassé 20 caractères !";
            }
             }    
 
              if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
              {
                $mail = htmlspecialchars($_POST['newmail']);
                if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                {  
                               
                  $reqmail = $bdd->prepare('SELECT * FROM membres WHERE mail = ?');
                  $reqmail->execute(array($mail));
                  $mailexist = $reqmail->rowCount();
                  if($mailexist ==0)
                {
                $newmail = htmlspecialchars($_POST['newmail']);
                $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
                $insertmail->execute(array($newmail, $_SESSION['id']));
                header('Location: profil.php?id='.$_SESSION['id']);
                }
                else
                {
                  $erreur = "Adresse mail déjà utilisé !";
                }
                  }
                  else
                  {
                    $erreur = "Veuillez rentrer une adresse mail valide !";
                  }
                    }
 
                      if (!empty($_POST['newmdp1']) AND !empty($_POST['newmdp2']))
                      {
                         $mdp1 = $_POST['newmdp1'];
                         $mdp2 = $_POST['newmdp2'];
 
                          if($mdp1 == $mdp2)
                        {
                          $mdp1 = password_hash($mdp1, PASSWORD_DEFAULT);
                          $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
                          $insertmdp->execute(array($mdp1, $_SESSION['id']));      
                          header('Location: profil.php?id='.$_SESSION['id']);
                          }
                          else
                          {
                              $erreur = "Les deux mots de passes ne correspondent pas !";
                          }
                        }
       
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/Style_EditProfil.css">
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

     <section class="container-fluid EditProfilBox">
        <div class="container">
          <div class="bandeau">
            <h2 id="portfolio"> Edition de profil </h2>
            <form method="POST" action="" enctype="multipart/form-data" class="formulaireEDIT">
              <table>
                <tr>
                  <td>
                    <label>Avatar :</label>
                    <input type="file" name="avatar"><br /><br />
                  </td>
                </tr>
                <tr>
                  <td>
                <label>Pseudo :</label>
                <input type="text" name="newpseudo" placeholder="pseudo" value="<?php echo $user['pseudo']; ?>"><br /><br />
              </td>
            </tr>
            <tr>
              <td>
                <label>Mail :</label>
                <input type="mail" name="newmail" placeholder="Adresse mail" value="<?php echo $user['mail']; ?>"><br /><br />
              </td>
            </tr>
            <tr>
              <td>
                <label>Mot de passe :</label>
                <input type="password" name="newmdp1" placeholder="Mot de passe"><br /><br />
              </td>
            </tr>
            <tr>
              <td>
                <label>Confirmation mot de passe :</label>
                <input type="password" name="newmdp2" placeholder="confirmation MDP"><br /><br />
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" value="Mettre à jour" class="boutonEDIT">
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

        
  </div>
</div>
    </section>

                
  </body>
 </html>
 <?php
}
else
{
  header("Location: connexion.php");
}
?>