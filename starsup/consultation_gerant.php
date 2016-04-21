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
						<li class="active"><a href="index_gerant.php">Homepage</a></li>
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
				
				
			</div>
		</div>

	<!-- Main -->
		<div id="main">
			<div id="content" class="container">
<form action="consultation_gerant.php" name="ajout_visite" method="post">

	      				<p>Année :
	              <select name="date">
	              <?php
	             	$req = $dbh->query('SELECT * FROM visiter');
					while ($donnees = $req->fetch())
	              	{

					$date = date_parse($donnees['DATE_HEURE_VISITE']);
    				$year = $date['year'];
    				if($year !=$truc)
    				{
	                echo'<option>'.$year.'</option>';  
	                $truc = $year;     
	                } 		
	             	}
	              ?>
	               </select>
	      			<p><INPUT TYPE="submit" value=" Valider "></p>
    		</form>
    		<form  action="consultation_gerant_debut.php" name="ajout_visite" method="post">
				<p><INPUT TYPE="submit" value=" Voir tous "></p>
				</form>
			<?php 


$req = $dbh->query('SELECT * FROM visiter as V Inner join hebergement as H on V.ID_HEBERGEMENT = H.ID_HEBERGEMENT Inner join gerer as G On V.ID_HEBERGEMENT = G.ID_HEBERGEMENT
				   WHERE YEAR(DATE_HEURE_VISITE) = "'.$_POST['date'].'" AND ID_GERANT="'.$_SESSION['id_gerant'].'"');
while ($donnees = $req->fetch())
{
     echo utf8_encode($donnees['NOM_HEBERGEMENT'].'<br/>'.' Commentaire :'.$donnees['COMMENTAIRE_VISITE']).'<br/>';
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
     echo '<br>';
 }

$req->closeCursor(); // Termine le traitement de la requête
 ?>
			
			</div>
		</div>

	<!-- Tweet -->
		<div id="tweet">
			<div class="container">
				
			</div>
		</div>

	<!-- Footer -->
		<div id="footer">
			<div class="container">
				<section>
					<header>
						<h2>Get in touch</h2>
					</header>
					<ul class="contact">
						<li><a href="#" class="fa fa-twitter"><span>Twitter</span></a></li>
						<li class="active"><a href="#" class="fa fa-facebook"><span>Facebook</span></a></li>
						<li><a href="#" class="fa fa-dribbble"><span>Pinterest</span></a></li>
						<li><a href="#" class="fa fa-tumblr"><span>Google+</span></a></li>
					</ul>
				</section>
			</div>
		</div>

	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
			</div>
		</div>

	</body>
</html>