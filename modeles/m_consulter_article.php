<?php
	// fonction permettant de récupérer la liste des article conçus
	// par un rédacteur dont le pseudo est transmis en paramètre
	function getArticlesAuteur($connexion, $pseudo){
		// on protège les entrées
		$pseudo = pg_escape_string($pseudo);
		// requête
		$requete = "SELECT article
		FROM red_concoit_art
		WHERE redacteur ='$pseudo';";
		$resultat = pg_query($connexion,$requete);
		return $resultat;
	}
?>
