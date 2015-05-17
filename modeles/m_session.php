<?php
	// AUTHENTIFICATION
	/* fonction pour s'authentifier, retourne un booléen .
	 * true si l'authentification réussi
	 * false si elle échoue
	 */
	function auth($connexion,$pseudo,$date_naissance)
	{
		$requete = "SELECT * FROM comptes
		WHERE pseudo='$pseudo' and date_naissance='$date_naissance';";
		$query = pg_query($connexion, $requete);
		$ret = pg_num_rows($query) != 0;
		return $ret;
	}
	//GESTION SESSION
	/* Retourne la liste des statuts possible
	 * TODO : à remplacer par partie par une table spécifique SQL
	 * ou une requête sur les "schéma" des tables ?
	 */
	function getAllStatuts($connexion)
	{
		$allStatuts = array ("lecteur","moderateur",
			"redacteur","editeur","administrateur");
		return $allStatuts;
	}
	/* fonction pour connaître les status d'un utilisateur
	 * si le résultat est vide, il y à un problème:
	 * on déconnecte donc l'utilisateur
	 * TODO : à remplacer pour partie une fonction pg/SQL ?
	 * */
	function getStatuts($connexion,$pseudo)
	{
		$allStatuts = getAllStatuts($connexion);
		$rStatuts = array();
		foreach ($allStatuts as $s)
		{
			$requete = "SELECT FROM $s WHERE pseudo='$pseudo'";
			$query = pg_query($connexion, $requete);
			if (pg_num_rows($query) != 0){
				$rStatuts[]=$s;
			}
		}
		// si pas de statut -> on déconnecte.
		if (empty($rStatus))
		{
			deconnect();
		};
		return $rStatuts;
	}
?>
