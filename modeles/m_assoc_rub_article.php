<?php
	/* fonction pour associer un article à un ensemble de rubriques
	 * l'utilisateur utilisant la fonction doit être un éditeur
	 * cette paternité est tracé dans la table ed_cree_assoc.
	 */
	function associer($connexion,$article,$rubriques)
	{
		// on protège les entrée
		$article =pg_escape_string($article);
		$pseudo=pg_escape_string($_SESSION['pseudo']);
		for ($cpt=0, $size=count($rubriques); $cpt<$size; $cpt++)
		{
			$rubriques[$cpt]=pg_escape_string($rubriques[$cpt]);
		}
		// requête
		$formatPHP = "d-m-Y H:i:s:u";
		$formatPostGreSQL = "DD-MM-YYYY HH24:MI:SS:US";
		$date = date($formatPHP);
		/// création association
		$requete ="begin;\n";
		$requete .= "INSERT INTO association(_date, article)
		VALUES (to_timestamp('$date','$formatPostGreSQL'), '$article');\n";
		/// traçabilité du créateur de l'association
		$requete .= "INSERT INTO ed_cree_assoc(editeur, _date)
		VALUES ('$pseudo',to_timestamp('$date','$formatPostGreSQL'));\n";
		/// ajout des rubriques à l'association
		foreach ($rubriques as $rubrique)
		{
			$requete .= "INSERT INTO assoc_appartient_rub(_date, rubrique)
			VALUES (to_timestamp('$date','$formatPostGreSQL'),'$rubrique');\n";
		}
		$requete .= "commit;\n";
		$query = pg_query($connexion, $requete);
		return $query != False;
	}


?>
