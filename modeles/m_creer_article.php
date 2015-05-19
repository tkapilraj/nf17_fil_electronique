<?php
	// fonction permettant de savoir si le titre d'article proposé existe déjà en BDD
	function presenceTitre($connexion,$titre){
		// on protège les entrées
		$titre = pg_escape_string($titre);
		// requête
		$requete = "SELECT * from article WHERE titre = '$titre'";
		$query = pg_query($connexion, $requete);
		return pg_num_rows($query) != 0;
	}

	// fonction perttant la création d'un article en BDD
	function creerArticle($connexion,$titre){
		// on protège les entrées
		$titre = pg_escape_string($titre);
		// requête
		$requete1 = "INSERT INTO article(titre, _date)
		VALUES ('$titre',NOW());";
		// création de l'article
		$pseudo = $_SESSION['pseudo'];
		$query = pg_query($connexion, $requete1);
		$requete2 = "INSERT INTO red_concoit_art(redacteur,article)
		VALUES ('$pseudo','$titre');";
		$query = pg_query($connexion, $requete2);
		$requete3 = "INSERT INTO changement_etat_art_red(redacteur,article,_date, etat)
		VALUES ('$pseudo','$titre',NOW(),'en_redaction');";
		$query = pg_query($connexion, $requete3);
	}
?>
