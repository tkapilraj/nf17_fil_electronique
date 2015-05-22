<?php
	// pour getAllRubriques
	include(dirname(__FILE__).'/../modeles/m_recherche.php');
	// modèle
	include(dirname(__FILE__).'/../modeles/m_creer_rubrique.php');
	// afin d'etre sur que la personne cherchant à accèder à la page
	//est connectée est qu'elle est un rédacteur
	if (isConnect($_SESSION)  && $_SESSION['editeur'] ){
		// listage des rubriques
		$recupRub=getAllRubriques($connexion);
		while($result = pg_fetch_array($recupRub))
		{
			$rubriques[]=$result['nom'];
		}
		// on vérifie si on à reçu un formulaire
		$bCreerRub=false;
		if( ! empty($_POST["action"])){
			$bCreerRub=true; //mode création rubrique
		}
		if ($bCreerRub)
		{
			//normalement les champs insérés ne peuvent pas être vide
			assert('! empty($_POST["rubrique"]);');
			assert('! empty($_POST["mere"]);');
			// ces conditions aussi doivent être respectés
			assert('strlen($_POST["rubrique"])<=64;');
			assert('strlen($_POST["mere"])<=64;');
			//test nom rubrique mère
			if ($_POST["mere"] !="NULL")
			{
				if (! in_array($_POST["mere"],$rubriques))
				{
					$bCreerRub=false;
					$erreur="rubrique mère invalide";
				}
			}
		}
		if ($bCreerRub)
		{
			if (in_array($_POST["rubrique"],$rubriques))
			{
				$bCreerRub=false;
				$erreur="nom de rubrique déjà utilisé.";
			}
		}
		if ($bCreerRub) // création de la rubrique
		{
			creer_rubrique($connexion,$_POST["rubrique"],$_POST["mere"]);
			$message="rubrique ".$_POST["rubrique"]." crée avec succés.";
		}
		include(dirname(__FILE__).'/../vues/v_creer_rubrique.php');
	}
	else{
		// redirection vers l'index
		header('Location: index.php');
	}
?>
