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
		$pseudo = pg_escape_string($pseudo);
		$nom    = pg_escape_string($nom);
		$prenom = pg_escape_string($prenom);
		$date_naissance=pg_escape_string($date_naissance);
		// requête
		$requete ="begin;\n";
		$requete .= "INSERT INTO comptes (pseudo,nom,prenom,date_naissance)
		VALUES ('$pseudo','$nom','$prenom','$date_naissance');\n";
		foreach($statuts as $s)
		{
			$requete .= addStatutStr($connexion,$pseudo,$s);
		}
		$requete .="commit;\n";
		$query=pg_query($connexion, $requete);
		return $query != false;
	}
	// création et retour de la requête sql d'ajout
	// de status à un utilisateur sous forme de string.
	// le pseudo doit être préalablement echappé.
	//* TODO : Support du status editeur

	function addStatutStr($connexion,$pseudo,$statut)
	{
		$str="";
		$allStatuts = getAllStatuts($connexion);
		if ( ! in_array($statut,$allStatuts))
		{
			$str.="rollback;\n";
		}
		elseif ($statut == "editeur"){
			//
			// on protège les entrées
			// $pseudo = pg_escape_string($pseudo);
			// $statut = '"'.$statut.'"';
			// requête
			$str.="rollback;\n"; // désactivée pour le moment
		}
		else{
			// on protège les entrées
			$statut = '"'.$statut.'"'; // protèqe l' identifiant de table
			// requête
			$str .= "INSERT INTO $statut (pseudo)
			VALUES ('$pseudo');\n";
		}
		return $str;
	}
	/* Ajoute un status
	 * retourne un booleen selon si l'action s'est bien réalisé
	 * ou non.
	 */
	function addStatut($connexion,$pseudo,$statut)
	{
		$pseudo   = pg_escape_string($pseudo);
		$requete  ="begin;\n";
		$requete .= addStatutStr($connexion,$pseudo,$statut);
		$requete .="commit;\n";
		$query    = pg_query($connexion, $requete);
		return $query != false;
	}
?>
