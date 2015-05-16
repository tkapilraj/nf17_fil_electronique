<?php
	//INFORMATION
	/* fonction permettant de savoir si l'utilisateur
	 * à un compte. retourne un booleen.
	 */
	function hasCompte($connexion,$pseudo)
	{
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
		$requete = "INSERT INTO comptes (pseudo,nom,prenom,date_naissance)
		VALUES ('$pseudo','$nom','$prenom','$date_naissance');";
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
		$allStatuts = array ("lecteur","moderateur",
		"redacteur","editeur","administrateur");
		if ( ! in_array($statut,$allStatuts))
		{
			return false;
		}
		elseif ($statut == "editeur"){
			return false;
		}
		else{
			$requete = "INSERT INTO $statut (pseudo)
			VALUES ('$pseudo');";
			$query = pg_query($connexion, $requete);
			return true;
		}
		return false;
	}
?>
