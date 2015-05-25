<?php	
    if (isConnect($_SESSION)  && $_SESSION['editeur'] ){
		// afin d'etre sur que la personne cherchant à accèder à la page est connectée est qu'elle est un éditeur
		// ini_set('display_errors', TRUE); // -> test
		// error_reporting(-1);//  -> test
		$editeur = pg_escape_string($_SESSION['pseudo']);
		if(!empty($_GET["action"]) && $_GET["action"] == "ed_modifier_article"){  
				// l'éditeur n'a pas encore choisi l'article qu'il souhaite modifier
				include(dirname(__FILE__).'/../modeles/m_choisir_article.php'); 
				// inclusion du modèle
				$result  = recupArticleModifiablesEditeur($connexion, $editeur);
				include(dirname(__FILE__).'/../vues/v_choisir_article.php');
				// on affiche les différents articles à l'éditeur			
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