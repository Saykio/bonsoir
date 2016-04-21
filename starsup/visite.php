<?php include("include/config.php"); 


if (isset($_GET['test']) && $_GET['test'] != ''  ){


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
	*/ 
	if(isset($_GET['date_visite']) && !empty($_GET['date_visite']))
	{     
		$date_visite=$_GET['date_visite'];
	}
	
	else{
		$date_visite = NULL;
	}     


    $sql = $dbh->prepare("INSERT INTO visiter (ID_HEBERGEMENT, ID_INSPECTEUR, ID_SAISON, NOMBRE_ETOILE_VISITE, DATE_HEURE_VISITE, CONTRE_VISITE, COMMENTAIRE_VISITE) 
  						VALUES (:hebergement, :inspecteur, :saison, NULL, :date_visite, NULL, NULL)");
  //mysqli_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
  $sql->execute(array("hebergement" => $_GET['hebergement'], "inspecteur" => $_GET['inspecteur'], "saison" => $_GET['saison'], "date_visite" => $date_visite));
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
		<title>Ajout d'une visite</title>
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
						<li class="active"><a href="index_admin.php">Homepage</a></li>
					</ul>
				</nav>
			</div>
			<div class="container"> 
				
				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">Starsup</a></h1>
					<span class="tag">Ajout visite</span>
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

	      			<p><input type="text" placeholder="Date" name="date_visite"></p>
	      			<p><input type="text" placeholder="test" name="test"></p>
	      			<INPUT TYPE="submit" value=" Valider ">	
    		</form>

              

				<hr />
				
			</div>
		</div>


	<!-- Tweet -->
		<div id="tweet">
			<div class="container">
				<section>
					<blockquote>&ldquo;In posuere eleifend odio. Quisque semper augue mattis wisi. Maecenas ligula. Pellentesque viverra vulputate enim. Aliquam erat volutpat.&rdquo;</blockquote>
				</section>
			</div>
		</div>

	<!-- Footer -->
		<div id="footer">
			<div class="container">
				<section>
					<header>
						<h2>Get in touch</h2>
						<span class="byline">Integer sit amet pede vel arcu aliquet pretium</span>
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
