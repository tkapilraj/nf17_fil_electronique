<?php
  if (isConnect($_SESSION)  && $_SESSION['editeur'] ){ 
		// afin d'etre sur que la personne cherchant à accèder à la page est connectée est qu'elle est un editeur
		if( !empty($_GET["action"]) && $_GET["action"] == "change_etat_article"){
			// si on dispose des paramètres suffisants et que le visiteur accède à la page intentionnellement
			$pseudo = $_SESSION['pseudo'];
			if(!empty($_POST["titre"]) ){
        $titre = $_POST["titre"];
				include(dirname(__FILE__).'/../modeles/m_change_etat_article.php'); 
				// inclusion du modèle
				$result1 = get_etat_article_ed($connexion, $titre);
			}
			else{
			include(dirname(__FILE__).'/../modeles/m_change_etat_article.php');
			  if(!empty($_POST['change_etat'])){
			    $article=$_POST['change_etat'];
			    $option=$_POST['etat'];
			    $explication=$_POST['explication'];
			    $result=change_etat_article_ed($connexion,$article,$option,$explication);
			  }else{
        
        $result2 = getArticlesEtat($connexion, $pseudo);
			  }
		  }
      include(dirname(__FILE__).'/../vues/v_change_etat_article.php');
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
