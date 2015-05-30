<?php

	//retourne au hasard une gestion proposé par un éditeur et lié à au moins un article
	function getRandomGestion($connexion) {
		$requete = "SELECT _date as gestion, honneur 
		FROM gestion WHERE _date in 
			(SELECT gestion from art_estpropose_gestion) 
		ORDER BY RANDOM() 
		LIMIT 1";
		$query = pg_query($connexion, $requete);
		return $query;
	}

	function getArticleGestion($connexion, $gestion) {
		// on protège les entrées
		$gestion = pg_escape_string($gestion);
		// requête
		$requete = "SELECT titre, (array_agg(contenu_txt))[1] as texte 
		FROM 
			(SELECT article as titre  
			FROM art_estpropose_gestion 
			WHERE gestion='$gestion') as req 
		LEFT JOIN text on titre=titreArticle 
		GROUP BY titre";
		$query = pg_query($connexion, $requete);
		return $query;
	}
	
	//retourne les articles ayant pour état publié
	function getArticlesGestionPublie($connexion, $gestion) {
		// on protège les entrées
		$gestion = pg_escape_string($gestion);
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
					FROM MostRecentState m, art_estpropose_gestion g, text t
					WHERE m.rowNumber = 1 AND etat='publie' AND g.gestion='$gestion' AND m.titre=g.article AND m.titre=t.titreArticle
					GROUP BY m.titre";
		$query = pg_query($connexion, $requete);
		return $query;
	}
?>
