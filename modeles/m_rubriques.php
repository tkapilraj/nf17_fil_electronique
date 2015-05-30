<?php

	function getRubriquesPrincipales($connexion) {
		$requete = "SELECT nom FROM rubrique WHERE rubrique_mere is NULL";
		$query = pg_query($connexion, $requete);
		return $query;
	}

	function getSousRubriques($connexion, $mere) {
		// on protège les entrées
		$mere = pg_escape_string($mere);
		// requête
		$requete = "SELECT nom FROM rubrique WHERE rubrique_mere='$mere'";
		$query = pg_query($connexion, $requete);
		return $query;
	}

	function getArticlesAssocies($connexion, $mere) {
		// on protège les entrées
		$mere = pg_escape_string($mere);
		// requête
		$requete = "SELECT titre, (array_agg(contenu_txt))[1] as texte FROM (SELECT a.article as titre  FROM association a, assoc_appartient_rub r  WHERE rubrique='$mere' AND a._date=r._date) as req LEFT JOIN text on titre=titreArticle GROUP BY titre";
		$query = pg_query($connexion, $requete);
		return $query;
	}
	
	function getArticlesAssociesPublie($connexion, $mere) {
		// on protège les entrées
		$mere = pg_escape_string($mere);
		// requête
		$requete = "WITH MostRecentState AS (
					SELECT titre, etat, date,
					ROW_NUMBER() OVER (PARTITION BY titre ORDER BY date DESC) AS rowNumber
					FROM (SELECT article as titre, cast(etat as varchar), _date as date 
							FROM changement_etat_art_red 
							UNION (SELECT article as titre,'soumis' as etat, soumis as date 
									FROM art_appartient_soum 
									UNION SELECT article as titre, cast(etat as varchar), _date as date 
									FROM changement_etat_art_ed)) as req)

					SELECT m.titre, (array_agg(t.contenu_txt))[1] as texte
					FROM MostRecentState m, association a, assoc_appartient_rub r, text t
					WHERE m.rowNumber = 1 AND etat='publie' AND rubrique='$mere' AND a._date=r._date AND a.article=m.titre AND m.titre=t.titreArticle
					GROUP BY m.titre";
		$query = pg_query($connexion, $requete);
		return $query;
	}


?>
