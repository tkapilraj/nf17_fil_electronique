<?php
ini_set('display_errors', TRUE); // -> test
error_reporting(-1);//  -> test

if (!empty($_GET['param']) && isLecteur($_SESSION)) {
	//On inclut le modèle
	include(dirname(__FILE__).'/../modeles/m_articles.php');
	include(dirname(__FILE__).'/../modeles/m_appreciations.php');
	//récupération de titre de l'article par la méthode get
	$article=$_GET['param'];
	//affichage possible uniquement si l'article a été validé par un éditeur
	if(isArticleValide($connexion, $article)) {
		if(!empty($_GET['option'])) {
			$option=$_GET['option'];
			if($option=='add') {
				$note=$_POST['note'];
				$titre=$_POST['titre'];
				$texte=$_POST['texte'];
				insertAppreciation($connexion, $_SESSION["pseudo"], $article, $note, $titre, $texte);
				header("Location: index.php?action=articles&param=$article");
			} else if($option=='update') {
				$appreciation=$_POST['appreciation'];
				$etat=$_POST['etat'];
				include(dirname(__FILE__).'/../vues/v_update_appreciations.php');
			} else if($option=='updated') {
				$appreciation=$_POST['appreciation'];
				$etat=$_POST['etat'];
				updateEtatAppreciation($connexion, $appreciation, $etat);
				header("Location: index.php?action=appreciations&param=$article");
			} else {
				header('Location: index.php');
			}
		} else {
				$appreciations = getAppreciationsLecteur($connexion,$_SESSION["pseudo"],$article);
				include(dirname(__FILE__).'/../vues/v_list_update_appreciations.php');
			}
	}else {
		//header('Location: index.php');
	}
}else {
	//header('Location: index.php');
}

?>