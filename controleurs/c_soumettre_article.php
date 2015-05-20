<?php	
	if (isConnect($_SESSION)  && $_SESSION['redacteur'] ){ 
		// afin d'etre sur que la personne cherchant à accéder à la page est connectée est qu'elle est un rédacteur
		if( !empty($_POST["titre"]) && 
			( ( !empty($_POST["fonction"]) && $_POST["fonction"]== 'soumettre' )
			|| ( !empty($_POST["comite_editorial"])  )     )    )  {
			// si on dispose des paramètres suffisants
			$titreArticle = $_POST["titre"];
			include(dirname(__FILE__).'/../modeles/m_soumettre_article.php'); 
			// inclusion du modèle
			if( !empty($_POST["fonction"]) && $_POST["fonction"]== 'soumettre' ){
				$result = afficherComiteEditorial($connexion);
			}
			else{
				// gestion de la volonté de l'utilisateur
				$comiteEditorial = $_POST["comite_editorial"];
				soumettreArticle($connexion,$titreArticle,$comiteEditorial);
				$messageReussite = "L'article $titreArticle a bien été soumis au comité éditorial $comiteEditorial";
			}
			include(dirname(__FILE__).'/../vues/v_soumettre_article.php');
			// on affiche un message d'information pour l'utilisateur				
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