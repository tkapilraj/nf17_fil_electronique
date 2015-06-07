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
		$nom    = pg_escape_string($nom);
		$prenom = pg_escape_string($prenom);
		$date_naissance=pg_escape_string($date_naissance);
		// requête
		$requete ="begin;\n";
		$requete .= "INSERT INTO comptes (pseudo,nom,prenom,date_naissance)
		VALUES ('$pseudo_esc','$nom','$prenom','$date_naissance');\n";
		$query=pg_query($connexion, $requete);

		if($query){
			foreach($statuts as $s)
			{
				$query = addStatut($connexion,$pseudo,$s);
				if(! $query){
					break;
				}
			}
		}

		if ($query){
			$requete ="commit;\n";

		} else {
			$requete ="rollback;\n";
		}
		pg_query($connexion, $requete);
		return $query;
	}
	// Ajoute un status
	//* TODO : Support du status editeur
	function addStatut($connexion,$pseudo,$statut)
	{
		$pseudo = pg_escape_string($pseudo);
		$allStatuts = getAllStatuts($connexion);
		if ( ! in_array($statut,$allStatuts))
		{
			$query=false;
		}
		elseif ($statut == "editeur"){
			//
			// on protège les entrées
			// $pseudo = pg_escape_string($pseudo);
			// $statut = '"'.$statut.'"';
			// requête
			$query=false; // désactivée pour le moment
		}
		else{
			// on protège les entrées
			$statut = '"'.$statut.'"'; // protèqe l' identifiant de table
			// requête
			$requete= "INSERT INTO $statut (pseudo)
			VALUES ('$pseudo');\n";
			$query=pg_query($connexion, $requete);
		}
		return $query;
	}
?>
