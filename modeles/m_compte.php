<?php
	include_once(dirname(__FILE__).'/../modeles/m_session.php');
	//INFORMATION
	/* fonction permettant de savoir si l'utilisateur
	 * à un compte. retourne un booleen.
	 */
	function hasCompte($connexion,$pseudo)
	{
		// on protège les entrée
		$pseudo =pg_escape_string($pseudo);
		// requête
		$requete = "SELECT * FROM comptes
		WHERE pseudo = '$pseudo';";
		$query = pg_query($connexion, $requete);
		$ret = pg_num_rows($query) != 0;
		return $ret;
	}

	// MODIFICATEURS
	/*fonction pour inscrire un utilisateur
	 * ainsi que lui attribué ses status initiaux
	 */
	function inscrire($connexion,$pseudo,$nom,$prenom,$date_naissance,
		$statuts=array())
	{
		// on protège les entrées
		$pseudo_esc = pg_escape_string($pseudo);
		$nom = pg_escape_string($nom);
		$prenom = pg_escape_string($prenom);
		$date_naissance=pg_escape_string($date_naissance);
		// requête
		$requete = "INSERT INTO comptes (pseudo,nom,prenom,date_naissance)
		VALUES ('$pseudo_esc','$nom','$prenom','$date_naissance');";
		$query=pg_query($connexion, $requete);

		foreach($statuts as $s)
		{
			addStatut($connexion,$pseudo,$s);
		}
		return true;
	}
	/* Ajoute un status
	 * retourne un booleen selon si l'action s'est bien réalisé
	 * ou non.
	 * TODO : Support du status editeur
	 */
	function addStatut($connexion,$pseudo,$statut)
	{
		// code requête
		$allStatuts = getAllStatuts($connexion);
		if ( ! in_array($statut,$allStatuts))
		{
			return false;
		}
		elseif ($statut == "editeur"){
			//
			// on protège les entrées
			// $pseudo = pg_escape_string($pseudo);
			// $statut = '"'.$statut.'"';
			// requête
			return false;
		}
		else{
			// on protège les entrées
			$pseudo = pg_escape_string($pseudo);
			$statut = '"'.$statut.'"'; // protèqe l' identifiant de table
			// requête
			$requete = "INSERT INTO $statut (pseudo)
			VALUES ('$pseudo');";
			$query = pg_query($connexion, $requete);
			return true;
		}
		return false;
	}
?>
