<?php

if (!empty($_GET['param'])) {
	//On inclut le modèle
	include(dirname(__FILE__).'/../modeles/m_articles.php');

	$article=$_GET['param'];
	
	//affichage possible uniquement si l'article a été validé par un éditeur
	if(isArticleValide($connexion, $article)) {
		$textes=getArticleTextes($connexion, $article);
		
		//On inclut la vue
		include(dirname(__FILE__).'/../vues/v_articles.php');
	}else {
		header('Location: index.php');  
	}
}else {
	header('Location: index.php');  
}

?>