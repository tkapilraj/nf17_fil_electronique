<?php
	
	//retourne le dernier état attribué par un éditeur à l'article donné
	function etatArticleEd($connexion, $article) {
		$requete = "SELECT etat FROM changement_etat_art_ed WHERE article='$article' ORDER BY _date DESC LIMIT 1;";
		$query = pg_query($connexion, $requete);
		return $query;
	}
	
	function isArticleValide($connexion, $article) {
		$etat = etatArticleEd($connexion, $article);
		$resultat = pg_fetch_array($etat);
		if($resultat['etat']='valide') {
			return true;
		}
		return false;
	}

	function getArticleImages($connexion, $article) {
		$requete = "SELECT titreBloc as titre, contenu_img as contenu FROM image WHERE titreArticle='$article'";
		$query = pg_query($connexion, $requete);
		return $query;
	}
	
	function getArticleTextes($connexion, $article) {
		$requete = "SELECT titreBloc as titre, contenu_txt as contenu FROM text WHERE titreArticle='$article'";
		$query = pg_query($connexion, $requete);
		return $query;
	}
?>