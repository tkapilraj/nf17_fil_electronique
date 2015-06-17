<?php	
	if (isConnect($_SESSION)  && $_SESSION['editeur'] ){ 
		// afin d'etre sur que la personne cherchant à accèder à la page est connectée est qu'elle est un éditeur
		if( !empty($_GET["action"]) && $_GET["action"] == "consulter_article_soumis"){
			// si on dispose des paramètres suffisants et que le visiteur accède à la page intentionnellement
			$pseudo = $_SESSION['pseudo'];
			if(empty($_POST["titre"]) ){
				include(dirname(__FILE__).'/../modeles/m_consulter_article_soumis.php'); 
				// inclusion du modèle
				$result = getArticleSoumis($connexion, $pseudo);
			}
			else{
				// on doit gérer la volonté de l'utilisateur
				$titreArticle = $_POST["titre"];
				include(dirname(__FILE__).'/../modeles/m_articles.php'); 
				// inclusion du modèle
				$result1 = getArticleImages($connexion, $titreArticle);
				$result2 = getArticleTextes($connexion, $titreArticle);	
			}
			include(dirname(__FILE__).'/../vues/v_consulter_article_soumis.php');
		}
		else{
			// redirection vers l'index
			header('Location: index.php'); 
		}
	}
	else{
		// redirection vers l'index
		header('Location: index.php'); 
	}
?>
