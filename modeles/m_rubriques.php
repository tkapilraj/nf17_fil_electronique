<?php

	function getRubriquesPrincipales($connexion) {
		$requete = "SELECT nom FROM rubrique WHERE rubrique_mere is NULL";
		$query = pg_query($connexion, $requete);
		return $query;
	}
	
	function getSousRubriques($connexion, $mere) {
		$requete = "SELECT nom FROM rubrique WHERE rubrique_mere='$mere'";
		$query = pg_query($connexion, $requete);
		return $query;
	}
	
	function getArticlesAssocies($connexion, $mere) {
		$requete = "SELECT titre, (array_agg(contenu_txt))[1] as texte FROM (SELECT a.article as titre  FROM association a, assoc_appartient_rub r  WHERE rubrique='$mere' AND a._date=r._date) as req LEFT JOIN text on titre=titreArticle GROUP BY titre";
		$query = pg_query($connexion, $requete);
		return $query;
	}


?>