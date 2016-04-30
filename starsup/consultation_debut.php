<!DOCTYPE HTML>
<!--
	Linear by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<?php 
include("include/config.php");
?>
<html>
	<head>
		<title>Stars'up</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
	</head>
	<body class="homepage">

	<!-- Header -->
		<div id="header">
			<div id="nav-wrapper"> 
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li class="active"><a href="index_admin.php">Accueil</a></li>
						<li><a href="index.php">Déconnexion</a></li>
					</ul>
				</nav>
			</div>
			<div class="container"> 
				
				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">Stars'Up</a></h1>
				</div>
			</div>
		</div>

	<!-- Featured -->
		<div id="featured">
			<div class="container">
				<header>
					<h2>Historique</h2>
				</header>
				
				<div id="content" class="container">

	<form action="consultation.php" name="ajout_visite" method="post">

	      				<p>Année :
	              <select name="date">
	             		<option>2016</option>
	             		<option>2017</option>
	             		<option>2018</option>
	               </select>
	      			<INPUT TYPE="submit" name="valider" value="Valider">
    		

			<?php 
			echo '<br>';
$req = $dbh->query('SELECT * FROM visiter as V Inner join hebergement as H on V.ID_HEBERGEMENT = H.ID_HEBERGEMENT ORDER BY DATE_HEURE_VISITE DESC');
while ($donnees = $req->fetch())
{
	?>
     <?php
     echo '<br>';
     echo utf8_encode('<b>'.$donnees['NOM_HEBERGEMENT'].'</b>&nbsp&nbsp  ');
     if ($donnees['NOMBRE_ETOILE_VISITE'] ==1)
     {
     echo '<img src="images/1Stars.jpg"/>'.'<br/>';
     }
     else if ($donnees['NOMBRE_ETOILE_VISITE'] ==2)
     {
     echo '<img src="images/2Stars.jpg"/>'.'<br/>';
     }
     else if ($donnees['NOMBRE_ETOILE_VISITE'] ==3)
     {
     echo '<img src="images/3Stars.jpg"/>'.'<br/>';
     }
     else if ($donnees['NOMBRE_ETOILE_VISITE'] ==4)
     {
     echo '<img src="images/4Stars.jpg"/>'.'<br/>';
     }
     else if ($donnees['NOMBRE_ETOILE_VISITE'] ==5)
     {
     echo '<img src="images/5Stars.jpg"/>'.'<br/>';
     }
     echo 'Commentaires : '.$donnees['COMMENTAIRE_VISITE'].' ('.$donnees['DATE_HEURE_VISITE'].')<br>';

}

$req->closeCursor(); // Termine le traitement de la requête
 ?>
	</form>		
			</div>
			</div>
		</div>


	<!-- Tweet -->
		<div id="tweet">
			<div class="container">
				
			</div>
		</div>



	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Créateurs: <a href="#">Gaël Baudouin</a> et <a href="#">Théo Brémaud </a>
			</div>
		</div>

	</body>
</html>