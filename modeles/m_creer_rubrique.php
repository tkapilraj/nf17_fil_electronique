<?php
	/* fonction pour créer une rubrique
	 * l'utilisateur utilisant la fonction doit être un éditeur
	 * cette paternité est tracé dans la table ed_cree_rub.
	 */
	function creer_rubrique($connexion,$rubrique,$mere="NULL")
	{
		// on protège les entrée
		$rubrique =pg_escape_string($rubrique);
		$pseudo=pg_escape_string($_SESSION['pseudo']);
		// requête
		$formatPHP = "d-m-Y H:i:s:u";
		$formatPostGreSQL = "DD-MM-YYYY HH24:MI:SS:US";
		$date = date($formatPHP);
		/// création association
		if ($mere =="NULL") // as-t'on une rubrique mère ?
		{
			$requete1 = "INSERT INTO rubrique(nom)
			VALUES ('$rubrique');";
		}else{
			$mere=pg_escape_string($mere);
			$requete1 = "INSERT INTO rubrique(nom, rubrique_mere)
			VALUES ('$rubrique','$mere');";
		}
		$query = pg_query($connexion, $requete1);

		/// traçabilité du créateur de l'association
		$requete2 = "INSERT INTO ed_cree_rub (editeur, rubrique, _date)
		VALUES ('$pseudo', '$rubrique',to_timestamp('$date','$formatPostGreSQL'))";
		$query = pg_query($connexion, $requete2);

	}
?>
