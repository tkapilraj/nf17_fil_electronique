<?php

	//retourne le dernier état attribué par un éditeur à l'article donné
	function etatArticleEd($connexion, $article) {
		// on protège les entrées
		$article = pg_escape_string($article);
		// requête
		$requete = "SELECT etat FROM changement_etat_art_ed WHERE article='$article' ORDER BY _date DESC LIMIT 1;";
		$query = pg_query($connexion, $requete);
		return $query;
	}
	
	//retourne les articles ayant pour état le plus récent un parmi ceux de la liste $states de la forme ('state1', 'state2')
	function getArticlesInStates($connexion, $states) {
		// requête
		$requete = "WITH MostRecentState AS (
					SELECT titre, etat, date,
					ROW_NUMBER() OVER (PARTITION BY titre ORDER BY date DESC) AS RowNumber
					FROM (SELECT article as titre, cast(etat as varchar), _date as date 
							FROM changement_etat_art_red 
							UNION (SELECT article as titre,'soumis' as etat, soumis as date 
									FROM art_appartient_soum 
									UNION SELECT article as titre, cast(etat as varchar), _date as date 
									FROM changement_etat_art_ed)) as req) 
					SELECT m.titre, m.etat, m.date, (array_agg(t.contenu_txt))[1] as texte
					FROM MostRecentState m, text t
					WHERE RowNumber = 1 AND etat in $states AND m.titre=t.titreArticle
					GROUP BY m.titre, m.etat, m.date";
		$query = pg_query($connexion, $requete);
		return $query;
	}

	//retourne le dernier état d'un article parmi les états attribué par un éditeur et l'auteur (soumission inclus)
	function getLastArticleState($connexion, $article) {
		// on protège les entrées
		$article = pg_escape_string($article);
		$requete = "SELECT etat
					FROM (SELECT cast(etat as varchar), _date as date 
							FROM changement_etat_art_red 
							WHERE article='$article' 
							UNION (SELECT 'soumis' as etat, soumis as date 
									FROM art_appartient_soum 
									WHERE article='$article' 
									UNION SELECT cast(etat as varchar), _date as date 
									FROM changement_etat_art_ed 
									WHERE article='$article')) as req
					ORDER BY date DESC 
					LIMIT 1";
		$query = pg_query($connexion, $requete);
		return $query;
	}
	
	function isArticleValide($connexion, $article) {
		// on protège les entrées
		$article = pg_escape_string($article);
		// requête
		$etat = getLastArticleState($connexion, $article);
		$resultat = pg_fetch_array($etat);
		if($resultat['etat']='valide') {
			return true;
		}
		return false;
	}

	function getArticleImages($connexion, $article) {
		// on protège les entrées
		$article = pg_escape_string($article);
		// requête
		$requete = "SELECT titreBloc as titre, contenu_img as contenu FROM image WHERE titreArticle='$article'";
		$query = pg_query($connexion, $requete);
		return $query;
	}

	function getArticleTextes($connexion, $article) {
		// on protège les entrées
		$article = pg_escape_string($article);
		// requête
		$requete = "SELECT titreBloc as titre, contenu_txt as contenu FROM text WHERE titreArticle='$article'";
		$query = pg_query($connexion, $requete);
		return $query;
	}

    function getArticlesLies($connect, $article){
        $article = pg_escape_string($article);
        $requete = "SELECT article2 FROM lien WHERE article1 = '$article'";
        $result = pg_query($connect, $requete);
        return $result;
    }


?>
