<!DOCTYPE HTML>

<?php 
include("include/config.php");

if (isset($_GET['modifier'])){


$req = $dbh->query('UPDATE visiter SET NOMBRE_ETOILE_VISITE="'.$_GET['etoile'].'" WHERE ID_HEBERGEMENT="'.$_GET['hebergement'].'"');
  
  echo "<script>alert(\"Etoile(s) modifiée(s)\")</script>";

}

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
						<li class="active"><a href="index_admin.php">Accueuil</a></li>
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
				
				<div id="content" class="container">

	<form action="modif_visite_debut.php" name="ajout_visite" method="post">

	      				<p>Année :
	              <select name="date">
	              <?php
	              $truc = '2016';
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
	      			<INPUT TYPE="submit" name="valider" value="Valider">
    		</form>	

			<?php 
$req = $dbh->query('SELECT * FROM visiter as V Inner join hebergement as H on V.ID_HEBERGEMENT = H.ID_HEBERGEMENT WHERE CONTRE_VISITE = 1');
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
     ?>
     <form action="modif_visite.php" name="modif_etoile" method="get">
     <select name="etoile">
     	<option>1</option>
     	<option>2</option>
     	<option>3</option>
     	<option>4</option>
     	<option>5</option>
     </select>
     <input type="hidden" name="hebergement" value="<?php echo $donnees['ID_HEBERGEMENT'] ?>">  
     <INPUT TYPE="submit" name="modifier" value="Modifier">
     </form>
     <?php
}

$req->closeCursor(); // Termine le traitement de la requête
 ?>
		
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