<?php include("include/config.php"); 


if (isset($_GET['date_visite']) && $_GET['date_visite'] != ''  ){


	/*if(isset($_GET['hebergement']))
	{     
		$hebergement=$_GET['hebergement'];
	}

	if(isset($_GET['inspecteur']))
	{     
		$inspecteur=$_GET['inspecteur'];
	}

	if(isset($_GET['saison']))
	{     
		$saison=$_GET['saison'];
	}
	
	if(isset($_GET['date_visite']) && $_GET['date_visite'] != '0000-00-00 00:00:00')
	{     
		$date_visite=$_GET['date_visite'];
	}
	
	else{
		$date_visite="NULL";
	}  */    


  $sql = $dbh->prepare("INSERT INTO visiter VALUES (:hebergement, :inspecteur, :saison, NULL, :date_visite, NULL, NULL)");
  $sql->execute(array("hebergement" => $_GET['hebergement'], "inspecteur" => $_GET['inspecteur'], "saison" => $_GET['saison'], "date_visite" => $_GET['date_visite']));
  echo "<script>alert(\"Visite ajoutée\")</script>";

}


?>
<!DOCTYPE HTML>
<!--
	Linear by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Stars'Up</title>
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

				</header>


			<form action="visite.php" name="ajout_visite" method="get">

	              <strong>Ajouter une visite</strong>
	      				<p>Hebergement :
	             
				<select name="hebergement">             
				<?php
				    $req = $dbh->query('SELECT * FROM hebergement');
				    while ($donnees = $req->fetch())
				    {
                 echo utf8_encode('<option value="'.$donnees['ID_HEBERGEMENT'].'">'.$donnees['NOM_HEBERGEMENT'].'</option>');      
               		}
                ?>               
                </select>

                <p>Inspecteur :
                <select name="inspecteur">             
				<?php
				    $req = $dbh->query('SELECT * FROM inspecteur');
				    while ($donnees = $req->fetch())
				    {
                 echo utf8_encode('<option value="'.$donnees['ID_INSPECTEUR'].'">'.$donnees['PRENOM_INSPECTEUR'].' '.$donnees['NOM_INSPECTEUR'].'</option>');
               		}
               ?>
                </select>

                <p>Saison :
                <select name="saison">             
				<?php
				    $req = $dbh->query('SELECT * FROM saison');
				    while ($donnees = $req->fetch())
				    {
                 echo utf8_encode('<option value="'.$donnees['ID_SAISON'].'">'.$donnees['LIBELLE_SAISON'].'</option>');
               		}
               ?>
                </select>

	      			<p><input type="text" placeholder="Date" name="date_visite" required></p>
	      			<p><INPUT TYPE="submit" name="nom" value="Valider"><p>
    		</form>

				
			</div>
		</div>


	<!-- Tweet -->
		<div id="tweet">
			<div class="container">
				<section>
					
				</section>
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