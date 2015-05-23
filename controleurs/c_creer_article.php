<?php

if (isConnect($_SESSION)  && $_SESSION['redacteur']){ 
	// afin d'etre sur que la personne cherchant à accèder à la page est connectée est qu'elle est un rédacteur
	if(!empty($_POST["titre"])){
		// la personne a déjà selection son titre d'article
		include(dirname(__FILE__).'/../modeles/m_creer_article.php');
		$titreArticle = $_POST["titre"];
		if (presenceTitre($connexion,$titreArticle)){
			// le titre choisi existe dejà en BDD
			$affichageFormulaire = TRUE;
			$messageErreur = "$titreArticle existe déjà.";
		}
		else{
			// le titre n'est pas présent en BDD
			creerArticle($connexion,$titreArticle);
			$messageReussite = "Votre article $titreArticle a bien été créé.";
			$affichageFormulaire = FALSE;
		}
	}
	
	else{
		// la personne n'a pas encore selectionnée son titre d'article
		$affichageFormulaire = TRUE;
	}
	include(dirname(__FILE__).'/../vues/v_creer_article.php');

}
else{
	// redirection vers l'article
	header('Location: index.php'); 
}
?>