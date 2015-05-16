<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Le-fil électronique</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link href="style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="header_wrapper">
			<div id="header">
				<div id="site_title">
					<h1><a href="index.php"><img src="images/logo.png" alt="Le-fil électronique" /></a></h1>
				</div> <!-- end of site_title -->
				<div class="cleaner_h10"></div>
				<div id="menu">
					<div id="home_menu"><a href="index.php"></a></div>
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="index.php?action=rubriques">Rubriques</a></li>
						<li><a href="index.php?action=recherche">Recherche</a></li>
						<li><a href="#">Recherche</a></li>
						<?php
						if (isConnect($_SESSION)){
						?>
						<li><a href="index.php?action=deconnexion">Déconnexion</a></li>
						<?php
						}else{
						?>
						<li><a href="index.php?action=connexion">Connexion</a></li>
						<li><a href="index.php?action=inscription">Inscription</a></li>
						<?php
						}
						?>
					</ul>
				</div> <!-- end of menu -->
			</div>
		</div> <!-- end of header_wrapper -->

		<div id="middle_wrapper1">
			<div id="middle_wrapper2">
				<div id="middle">
					<h1>Journal étudiant en ligne</h1>
					<span>Création d'articles, catégorisation, recherche, suivi éditorial et commentaires</span>
				</div>
			</div>
		</div>
