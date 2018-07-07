<?php

	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

$membres = $bdd->query('SELECT * FROM membres ORDER BY id DESC')
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Administration</title>
</head>
<body>
	<ul>
		<?php while($m = $membres->fetch())  ?>
		<li><?php echo $m['id'] ?> : <?php echo $m['pseudo'] ?>
		
				
				 </li>
		 
	</ul>

</body>
</html>	