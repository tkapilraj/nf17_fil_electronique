<?php
	// pour getAllRubriques
	include(dirname(__FILE__).'/../modeles/m_recherche.php');
	// modèle
	include(dirname(__FILE__).'/../modeles/m_assoc_rub_article.php');
	// afin d'etre sur que la personne cherchant à accèder à la page
	//est connectée est qu'elle est un rédacteur
	if (isConnect($_SESSION)  && $_SESSION['editeur'] ){
		// listage des rubriques et des articles
		$recupRub=getAllRubriques($connexion);
		while($result = pg_fetch_array($recupRub))
		{
			$rubriques[]=$result['nom'];
		}
		$recupArt=getAllArticles($connexion);
		while($result = pg_fetch_array($recupArt))
		{
			$articles[]=$result['titre'];
		}
		// on vérifie si on à reçu un formulaire
		$bCreerAssoc=false;
		if( ! empty($_POST["action"])){
			$bCreerAssoc=true; //mode création rubrique
		}
		if ($bCreerAssoc)
		{
			//normalement les champs insérés ne peuvent pas être vide
			assert('! empty($_POST["article"]);');
			assert('! empty($_POST["rubriques"]);');
			// ces conditions aussi doivent être respectés
			foreach ($_POST["rubriques"] as $rubrique){
				assert('strlen($rubrique)<=64;');
			};
			assert('strlen($_POST["article"])<=64;');
		}
		//test article
		if ($bCreerAssoc)
		{
			if (! in_array($_POST["article"],$articles))
			{
				$bCreerAssoc=false;
				$erreur="cet article n'existe pas.";
			}
		}
		//test rubriques
		if ($bCreerAssoc)
		{
			foreach ($_POST["rubriques"] as $rubrique){
				if (! in_array($rubrique,$rubriques))
				{
					$bCreerAssoc=false;
					$erreur="certaines rubriques associés n'existe pas.";
					break;
				}
			};
		}
		if ($bCreerAssoc) // création de la rubrique
		{
			associer($connexion,$_POST['article'],$_POST['rubriques']);
			$message="association crée avec succés.";
		}
		include(dirname(__FILE__).'/../vues/v_assoc_rub_article.php');
	}
	else{
		// redirection vers l'index
		header('Location: index.php');
	}
?>
