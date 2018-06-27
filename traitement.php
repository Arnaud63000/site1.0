<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />      
        <title>Page De Traitement</title>
    </head>

    <body>
    	

<?php
	
	
		

	if (empty($_POST['name']) OR empty($_POST['email']) OR empty($_POST['message']))
	{

		echo "ERREUR : tous les champs n'ont pas ete renseignés.";
	}
	else
	{
		echo 'Votre message viens d\'être envoyé!<br /><br />';

		echo  'Récapitulatif de votre message: ' . htmlspecialchars($_POST['message']) . '<br />';

		echo 'Pour revenir sur la page d\'acceuil cliquez <a href="index.php">ici</a>';

	}

	
?>


    </body>
</html>