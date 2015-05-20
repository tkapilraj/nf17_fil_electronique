<?php
	// fonction permettant de récupérer la liste des article conçus
	// par un rédacteur dont le pseudo est transmis en paramètre
	function getArticlesAuteur($connexion, $pseudo){
		$requete = "SELECT article
		FROM red_concoit_art
		WHERE redacteur ='$pseudo';";
		// echo "$requete"; -> test
		$resultat = pg_query($connexion,$requete);
		return $resultat;
	}
?>