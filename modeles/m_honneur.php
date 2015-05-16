<?php
	
	//retourne au hasard une gestion proposé par un éditeur et lié à au moins un article
	function getRandomGestion($connexion) {
		$requete = "SELECT _date as gestion, honneur FROM gestion WHERE _date in (SELECT gestion from art_estpropose_gestion) ORDER BY RANDOM() LIMIT 1";
		$query = pg_query($connexion, $requete);
		return $query;
	}
	
	function getArticleGestion($connexion, $gestion) {
		$requete = "SELECT titre, (array_agg(contenu_txt))[1] as texte FROM (SELECT article as titre  FROM art_estpropose_gestion WHERE gestion='$gestion') as req LEFT JOIN text on titre=titreArticle GROUP BY titre";
		$query = pg_query($connexion, $requete);
		return $query;
	}
?>