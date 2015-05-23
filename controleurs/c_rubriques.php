<?php

//On inclut le modèle
include(dirname(__FILE__).'/../modeles/m_rubriques.php');

if (!empty($_GET['param'])) {
	$mere=$_GET['param'];
	$rubriques=getSousRubriques($connexion, $mere);
	$articles=getArticlesAssocies($connexion, $mere);
} else {
	$rubriques=getRubriquesPrincipales($connexion);
}

//On inclut la vue
include(dirname(__FILE__).'/../vues/v_rubriques.php');

if (isset($mere)) {
	include(dirname(__FILE__).'/../vues/v_liste_articles.php');
}

?>