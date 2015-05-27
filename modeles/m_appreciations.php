<?php

	//retourne toutes les appréciations de l'article
	function getAllAppreciations($connexion, $article) {
		// on protège les entrées
		$article = pg_escape_string($article);
		// requête
		$requete = "SELECT lecteur, date, note, titre, texte
					FROM changement_etat_app_lec e, (SELECT a._id as id, a.lecteur, a.dateCreation as date, n.valeur as note, c.titre, c.texte, MAX(e.dateModification) as modif
														FROM appreciation a, note n, commentaire c, changement_etat_app_lec e 
														WHERE a._id=n.appreciation AND a._id=c.appreciation AND a._id=e.appreciation AND article='$article'
														GROUP BY a._id, a.lecteur, a.dateCreation, n.valeur, c.titre, c.texte) as req
					WHERE e.etat='visible' AND req.modif=e.dateModification AND req.id=e.appreciation";
		$query = pg_query($connexion, $requete);
		return $query;
	}
	
	//retourne les appréciations du lecteur sur l'article
	function getAppreciationsLecteur($connexion, $lecteur, $article) {
		// on protège les entrées
		$article = pg_escape_string($article);
		// requête
		$requete = "SELECT req.id, req.date, req.note, req.titre, req.texte, e.etat
					FROM changement_etat_app_lec e, (SELECT a._id as id, a.dateCreation as date, n.valeur as note, c.titre, c.texte, MAX(e.dateModification) as modif
														FROM appreciation a, note n, commentaire c, changement_etat_app_lec e 
														WHERE a._id=n.appreciation AND a._id=c.appreciation AND a._id=e.appreciation AND lecteur='$lecteur' AND article='$article'
														GROUP BY a._id, a.dateCreation, n.valeur, c.titre, c.texte) as req
					WHERE req.id=e.appreciation AND req.modif=e.dateModification";
		$query = pg_query($connexion, $requete);
		return $query;
	}
	
	function insertAppreciation($connexion, $lecteur, $article, $note, $titre, $texte) {
		// on protège les entrées
		$lecteur = pg_escape_string($lecteur);
		$article = pg_escape_string($article);
		$note = pg_escape_string($note);
		$titre = pg_escape_string($titre);
		$texte = pg_escape_string($texte);
		// requête
		$requete = "INSERT INTO appreciation (_id, dateCreation, lecteur, article) VALUES (DEFAULT, NOW(), '$lecteur', '$article')";
		$query = pg_query($connexion, $requete);
		if($note!=NULL) {
			$requete = "INSERT INTO note (appreciation, valeur) SELECT currval(pg_get_serial_sequence('appreciation', '_id')), $note";
			$query = pg_query($connexion, $requete);
		}
		if($titre!=NULL && $texte!=NULL) {
			$requete = "INSERT INTO commentaire (appreciation, titre, texte) SELECT currval(pg_get_serial_sequence('appreciation', '_id')), '$titre', '$texte'";
			$query = pg_query($connexion, $requete);
		}
	}
	
	function updateEtatAppreciation($connexion, $appreciation, $etat) {
		$appreciation = pg_escape_string($appreciation);
		$etat = pg_escape_string($etat);
		
		$requete = "INSERT INTO changement_etat_app_lec (appreciation, dateModification, etat) VALUES ($appreciation, NOW(), '$etat')";
		$query = pg_query($connexion, $requete);
	}

?>