<?php	
	if (isConnect($_SESSION)  && $_SESSION['redacteur'] ){ 
		// afin d'etre sur que la personne cherchant à accèder à la page est connectée est qu'elle est un rédacteur
		if( !empty($_GET["action"]) && $_GET["action"] == "consulter_article"){
			// si on dispose des paramètres suffisants et que le visiteur accède à la page intentionnellement
			$pseudo = $_SESSION['pseudo'];
			if(empty($_POST["titre"]) ){
				include(dirname(__FILE__).'/../modeles/m_consulter_article.php'); 
				// inclusion du modèle
				$result = getArticlesAuteur($connexion, $pseudo);
			}
			else{
				// on doit gérer la volonté de l'utilisateur
				$titreArticle = $_POST["titre"];
				include(dirname(__FILE__).'/../modeles/m_articles.php'); 
				// inclusion du modèle
				$result1 = getArticleImages($connexion, $titreArticle);
				$result2 = getArticleTextes($connexion, $titreArticle);	
			}
			include(dirname(__FILE__).'/../vues/v_consulter_article.php');
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