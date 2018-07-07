<?php

  $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');

  if(isset($_POST['bouton']))

{
      
    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $mail2 = htmlspecialchars($_POST['mail2']);
        $mdp = $_POST['mdp'];
        $mdp2 = $_POST['mdp2'];

        $pseudolenght = strlen($pseudo);
        if($pseudolenght <= 20)
        {

              if($mail == $mail2)
              {
                  if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                  {   
                      
                      $reqmail = $bdd->prepare('SELECT * FROM membres WHERE mail = ?');
                      $reqmail->execute(array($mail)); 
                      $mailexist = $reqmail->rowCount();
                      if($mailexist ==0)
                      {
                          $reqpseudo = $bdd->prepare('SELECT * FROM membres WHERE pseudo = ?');
                          $reqpseudo->execute(array($pseudo));
                          $pseudoexist = $reqpseudo->rowCount();
                          if($pseudoexist ==0)
                            {

                                if($mdp == $mdp2)
                                {
                                    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                                    $req = $bdd->prepare('INSERT INTO membres(pseudo, motdepasse, mail) VALUES(?, ?, ?)');
                                    if($req->execute(array($pseudo, $mdp, $mail)))
                                    {
                                      $erreur = "Votre compte à bien été crée ! <a href=\"Login.php\"> Se connecter</a>";
                                    }
                                    else
                                    print_r($req->errorInfo());
                                     
                         
                    }
                    else
                    {
                      $erreur = "Vos mots de passes ne correspondent pas !";
                    }
                     }
                     else
                     {
                      $erreur = "Pseudo déjà utilisé !";
                     } 
                     }                   
                     else
                     {
                      $erreur = "Adresse mail déjà utilisée !";
                     } 
                  }
                  else
                  {
                    $erreur = "Votre adresse mail n'est pas valide !";
                  }  
              }
              else
              {
                $erreur = "Vos adresses mail ne correspondent pas !";
              }
        }
        else
        {
          $erreur = "Votre pseudo ne doit pas dépassé 20 caractères !";
        }
    }
    else
    {
      $erreur = "Tous les champs doivent être complétés";
    }  

}  
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style_Register.css">
        <title>Inscription</title>
    </head>
<body>
  
   <header class="container-fluid header">
            <div class="container">  
                <a href="#portfolio" class="logo"> Blog </a>
                <nav class="menu">
                    <a href="index.php"> Accueil </a>
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

     <section class="container-fluid RegisterBox">
        <div class="container">
          <div class="bandeau">
            <h2 id="portfolio"> Inscription </h2>
        <form action="" method="post" class="formulaireINS">
         <table>
          <tr>
            <td>
                <label for="pseudo">Pseudo :</label>
              </td>
                 <td> <input type="text" id="pseudo" name="pseudo" placeholder="Votre Pseudo">
                 </td>
               </tr>
            
               <tr>
            <td>
                <label for="mail">mail :</label>
              </td>
                 <td> <input type="email" id="mail" name="mail" placeholder="Adresse mail">
                 </td>
               </tr>

               <tr>
            <td>
                <label for="mail2">Confirmation mail :</label>
              </td>
                 <td> <input type="email" id="mail2" name="mail2" placeholder="confirmez email">
                 </td>
               </tr>

                 <tr>
            <td>
                <label for="mdp">MDP :</label>
              </td>
                 <td> <input type="password" id="mdp" name="mdp" placeholder="Mot de passe">
                 </td>
               </tr>

          <tr>
            <td>
                <label for="mdp2">Confirmation MDP :</label>
              </td>
                 <td> <input type="password" id="mdp2" name="mdp2" placeholder="Confirmez votre Mot de passe">
                 </td>
               </tr>
             </table>
           </br>
            <input type="submit" name="bouton" class="valider" value="Je m'inscris">
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

