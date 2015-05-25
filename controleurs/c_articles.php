<?php
ini_set('display_errors', TRUE); // -> test
error_reporting(-1);//  -> test
if (!empty($_GET['param'])) {
	//On inclut le modèle
	include(dirname(__FILE__).'/../modeles/m_articles.php');
	//récupération de titre de l'article par la méthode get
	$article=$_GET['param'];
	//affichage possible uniquement si l'article a été validé par un éditeur
	if(isArticleValide($connexion, $article)) {
			$result1 = getArticleImages($connexion, $article);
			$result2 = getArticleTextes($connexion, $article);			
		//On inclut la vue
		include(dirname(__FILE__).'/../vues/v_articles.php');
	}else {
		header('Location: index.php');  
	}
}else {
	header('Location: index.php');  
}

?>