<?php
 	//On inclut le modèle
	include(dirname(__FILE__).'/../modeles/m_honneur.php');

	$gestion = getRandomGestion($connexion);
	$resultat = pg_fetch_array($gestion);
	$honneur = $resultat['honneur'];
	$articles = getArticleGestion($connexion, $resultat['gestion']);
	 
	//On inclut la vue
	include(dirname(__FILE__).'/../vues/v_honneur.php');
	include(dirname(__FILE__).'/../vues/v_liste_articles.php');
?>