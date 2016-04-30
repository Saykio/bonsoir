<?php 
include("include/config.php");
session_destroy();
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
						<li class="active"><a href="index.php">Accueuil</a></li>
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
				
				<form action="Connexion.php" name="login-form" method="post">
		     	<input type="text" placeholder="Login" required name="login">
		     	<input type="password" placeholder="Mot de passe" required name="password">
		      	<INPUT TYPE="submit" name="nom" value=" Connexion ">
		    	</form>

		    	
				<hr />
				
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