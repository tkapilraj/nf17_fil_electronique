<?php
	/* fonction pour récupérer l'ensemble des articles*/
	function getAllArticles($connexion)
	{
		$requete = "SELECT titre FROM article";
        $query = pg_query($connexion, $requete);
        return $query;
	}
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
		$requete1 = "INSERT INTO association(_date, article)
		VALUES (to_timestamp('$date','$formatPostGreSQL'), '$article');";
		$query = pg_query($connexion, $requete1);
		/// traçabilité du créateur de l'association
		$requete2 = "INSERT INTO ed_cree_assoc(editeur, _date)
		VALUES ('$pseudo',to_timestamp('$date','$formatPostGreSQL'));";
		$query = pg_query($connexion, $requete2);
		/// ajout des rubriques à l'association
		foreach ($rubriques as $rubrique)
		{
			$requete3 = "INSERT INTO assoc_appartient_rub(_date, rubrique)
			VALUES (to_timestamp('$date','$formatPostGreSQL'),'$rubrique');";
			$query = pg_query($connexion, $requete3);
		}
	}


?>
