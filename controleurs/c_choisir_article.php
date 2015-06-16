<?php	
	if (isConnect($_SESSION)  && $_SESSION['redacteur'] ){ 
		// afin d'etre sur que la personne cherchant à accèder à la page est connectée est qu'elle est un rédacteur
		if( ( !empty($_POST["titre"]) && !empty($_POST["fonction"])) || !empty($_GET["fonction"]) ){
			// si on dispose des paramètres suffisants
			include(dirname(__FILE__).'/../modeles/m_choisir_article.php'); 
			// inclusion du modèle
			if(!empty($_GET["fonction"])){
				// on doit afficher les articles en fonction du désir de l'utilisateur
				$fonction = $_GET["fonction"];
				$result  = 0;
				switch($fonction){
					case 'restaurer' :
						$result = recupArticleRestaurables($connexion);
						$fonction="restaurer";
						break;
					case 'supprimer' :
						$result = recupArticlesSupprimables($connexion);
						$fonction="supprimer";
						break;
					case 'soumettre' :
						$result = recupArticlesSoumettables($connexion);
						$fonction="soumettre";
						break;
					case 'modifier' :
						$result = recupArticlesModifiables($connexion);
						$fonction="modifier";
				}	
				include(dirname(__FILE__).'/../vues/v_choisir_article.php');
				// on affiche les différents articles à l'utilisateur en fonction de son choix				
			}
			else{
				// on doit gérer la volonté de l'utilisateur
				$titreArticle = $_POST["titre"];
				$fonction = $_POST["fonction"];
				switch($fonction){
					case 'restaurer' :
						restaurerArticle($connexion,$titreArticle);
						$messageReussite = "L'article $titreArticle a bien été récupéré";
						break;
					case 'supprimer' :
						supprimerArticle($connexion,$titreArticle);
						$messageReussite = "L'article $titreArticle a bien été supprimé";
					// le cas de la soumission est géré via un autre controlleur
					// le cas de la modification sera géré via un autre controlleur
				}
				include(dirname(__FILE__).'/../vues/v_choisir_article.php');
				// on affiche un message d'information pour l'utilisateur				
			}
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