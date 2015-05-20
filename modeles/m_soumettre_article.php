<?php
	// fonction permettant d'affiche l'ensemble des comité éditorial disponible rangés par ordre alphabétiques
	// retourne le résultat de la requête
	function afficherComiteEditorial($connexion){
		$requete = "SELECT C.nom
		FROM comiteEditorial C
		ORDER BY C.nom;";
		// echo "$requete"; -> test
		$resultat = pg_query($connexion,$requete);
		return $resultat;
	}

	// fonction permettant de soumettre un article (en paramètre) à un comité éditorial (en paramètre)
	function soumettreArticle($connexion,$titreArticle,$comiteEditorial){
		// on protège les entrées
		$pseudo = pg_escape_string($_SESSION['pseudo']);
		$titreArticle= pg_escape_string($titreArticle);
		$comiteEditorial= pg_escape_string($comiteEditorial);
		// requête
		$formatPHP = "d-m-Y H:i:s:u";
		$formatPostGreSQL = "DD-MM-YYYY HH24:MI:SS:US";
		$date = date($formatPHP);
		$requete1 = "INSERT INTO soumission(_date, redacteur, comite_editorial)
		VALUES (to_timestamp('$date','$formatPostGreSQL'), '$pseudo', '$comiteEditorial');";
		pg_query($connexion,$requete1);
		$requete2 = "INSERT INTO art_appartient_soum(article,soumis)
		VALUES('$titreArticle', to_timestamp('$date','$formatPostGreSQL') );";
		pg_query($connexion,$requete2);
	}
?>
