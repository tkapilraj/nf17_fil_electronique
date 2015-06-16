<?php

	// fonction retournant la liste des articles restaurables
	function recupArticleRestaurables($connexion){
		// on protège les entrées
		$pseudo = pg_escape_string($_SESSION['pseudo']);
		// requête
		$requete =
"SELECT R2.article FROM
	(
		SELECT MAX(_date) AS date, article, redacteur
		FROM changement_etat_art_red
		WHERE redacteur = '$pseudo'
		GROUP BY article, redacteur
	) R1, changement_etat_art_red R2
WHERE R1.date = R2._date
	AND R1.article = R2.article
	AND R1.redacteur = R2.redacteur
	AND R2.etat = 'supprime';";
		// echo "$requete"; -> test
		$query = pg_query($connexion, $requete);
		return $query;
	}

	// fonction retournant la liste des articles retouchables
	function recupArticlesRetouchables($connexion){
		// on protège les entrées
		$pseudo = pg_escape_string($_SESSION['pseudo']);
		// requête
		$requete =
"(
	SELECT R6.article FROM
	(
		SELECT MAX(_date) AS date, article, redacteur
		FROM changement_etat_art_red
		WHERE redacteur = '$pseudo'
		GROUP BY article, redacteur
	) R5, changement_etat_art_red R6
	WHERE R5.date = R6._date
		AND R5.article = R6.article
		AND R5.redacteur = R6.redacteur
		AND R6.etat = 'en_redaction'
	EXCEPT
	SELECT  A.article AS article
	FROM art_appartient_soum A
	WHERE A.article IN
	(
		SELECT R2.article FROM
		(
			SELECT MAX(_date) AS date, article, redacteur
			FROM changement_etat_art_red
			WHERE redacteur = '$pseudo'
			GROUP BY article, redacteur
		) R1, changement_etat_art_red R2
		WHERE R1.date = R2._date
			AND R1.article = R2.article
			AND R1.redacteur = R2.redacteur
			AND R2.etat = 'en_redaction'
	)
)
UNION
(
	SELECT SR4.article
	FROM
	(
		SELECT R7.article AS article, MAX(R7._date) AS _date
		FROM changement_etat_art_ed R7
		WHERE article IN
		(
			SELECT SR1.article
			FROM
			(
				SELECT  A.article AS article, MAX(A.soumis) AS date
				FROM art_appartient_soum A
				WHERE A.article IN
				(
					SELECT R2.article FROM
					(
						SELECT MAX(_date) AS date, article, redacteur
						FROM changement_etat_art_red
						WHERE redacteur = '$pseudo'
						GROUP BY article, redacteur
					) R1, changement_etat_art_red R2
					WHERE R1.date = R2._date
						AND R1.article = R2.article
						AND R1.redacteur = R2.redacteur
						AND R2.etat = 'en_redaction'
				)
				GROUP BY A.article
			)SR1,
			(
				SELECT  C.article AS article, MAX(C._date) AS date
				FROM changement_etat_art_ed C
				WHERE C.article IN
				(
					SELECT R2.article FROM
					(
						SELECT MAX(_date) AS date, article, redacteur
						FROM changement_etat_art_red
						WHERE redacteur = '$pseudo'
						GROUP BY article, redacteur
					) R1, changement_etat_art_red R2
					WHERE R1.date = R2._date
						AND R1.article = R2.article
						AND R1.redacteur = R2.redacteur
						AND R2.etat = 'en_redaction'
				)
				GROUP BY C.article
			)SR2
			WHERE SR2.date > SR1.date AND SR2.article = SR1.article
		)
		GROUP BY R7.article
	)SR4, changement_etat_art_ed R8
	WHERE SR4.article = R8.article
	AND SR4._date = R8._date
	AND R8.etat = 'a_reviser'
);";
	$query = pg_query($connexion,$requete);
	return $query;
	}

	// fonction retournant la liste des articles supprimables
	function recupArticlesSupprimables($connexion){
		return recupArticlesRetouchables($connexion);
	}

	// fonction retournant la liste des articles soumettables
	function recupArticlesSoumettables($connexion){
		// on protège les entrées
		$pseudo = pg_escape_string($_SESSION['pseudo']);
		// requête
		$requete =
"SELECT SR6.article 
FROM
(
	(
		SELECT R6.article FROM 
		(
			SELECT MAX(_date) AS date, article, redacteur
			FROM changement_etat_art_red
			WHERE redacteur = '$pseudo'
			GROUP BY article, redacteur
		) R5, changement_etat_art_red R6
		WHERE R5.date = R6._date 
			AND R5.article = R6.article
			AND R5.redacteur = R6.redacteur
			AND R6.etat = 'en_redaction'		
		EXCEPT 
		SELECT  A.article AS article
		FROM art_appartient_soum A
		WHERE A.article IN
		(
			SELECT R2.article FROM 
			(
				SELECT MAX(_date) AS date, article, redacteur 
				FROM changement_etat_art_red
				WHERE redacteur = '$pseudo'
				GROUP BY article, redacteur
			) R1, changement_etat_art_red R2
			WHERE R1.date = R2._date 
				AND R1.article = R2.article
				AND R1.redacteur = R2.redacteur
				AND R2.etat = 'en_redaction'
		)
	)
	UNION
	(
		SELECT SR4.article
		FROM
		(
			SELECT R7.article AS article, MAX(R7._date) AS _date
			FROM changement_etat_art_ed R7
			WHERE article IN 
			(
				SELECT SR1.article 
				FROM 
				(
					SELECT  A.article AS article, MAX(A.soumis) AS date 
					FROM art_appartient_soum A
					WHERE A.article IN
					(
						SELECT R2.article FROM
						(
							SELECT MAX(_date) AS date, article, redacteur
							FROM changement_etat_art_red
							WHERE redacteur = '$pseudo'
							GROUP BY article, redacteur
						) R1, changement_etat_art_red R2
						WHERE R1.date = R2._date 
							AND R1.article = R2.article
							AND R1.redacteur = R2.redacteur
							AND R2.etat = 'en_redaction'
					)
					GROUP BY A.article
				)SR1,
				(
					SELECT  C.article AS article, MAX(C._date) AS date 
					FROM changement_etat_art_ed C
					WHERE C.article IN 
					(
						SELECT R2.article FROM 
						(
							SELECT MAX(_date) AS date, article, redacteur
							FROM changement_etat_art_red
							WHERE redacteur = '$pseudo'
							GROUP BY article, redacteur
						) R1, changement_etat_art_red R2
						WHERE R1.date = R2._date 
							AND R1.article = R2.article
							AND R1.redacteur = R2.redacteur
							AND R2.etat = 'en_redaction'
					) 
					GROUP BY C.article
				)SR2
				WHERE SR2.date > SR1.date AND SR2.article = SR1.article
			)
			GROUP BY R7.article
		)SR4, changement_etat_art_ed R8
		WHERE SR4.article = R8.article 
		AND SR4._date = R8._date
		AND R8.etat = 'a_reviser'
	)

)SR6, 
(
	SELECT titreArticle, titreBloc
	FROM image
	UNION
	SELECT titreArticle, titreBloc
	FROM text
) SR7
WHERE SR6.article = SR7.titreArticle
GROUP BY SR6.article
HAVING COUNT(SR7.titreBloc)>0;";
		$query = pg_query($connexion,$requete);
		return $query;
	}

	// fonction retournant la liste des articles modifiables
	function recupArticlesModifiables($connexion){
		return recupArticlesRetouchables($connexion);
	}

	function restaurerArticle($connexion,$titreArticle){
		// on protège les entrées
		$pseudo = pg_escape_string($_SESSION['pseudo']);
		$titreArticle = pg_escape_string($titreArticle);
		// requête
		$requete = "INSERT INTO changement_etat_art_red(redacteur, article, _date, etat)
		VALUES ('$pseudo','$titreArticle',NOW(),'en_redaction');";
		pg_query($connexion,$requete);
	}

	function supprimerArticle($connexion,$titreArticle){
		// on protège les entrées
		$pseudo = pg_escape_string($_SESSION['pseudo']);
		$titreArticle = pg_escape_string($titreArticle);
		// requête
		$requete = "INSERT INTO changement_etat_art_red(redacteur, article, _date, etat)
		VALUES ('$pseudo','$titreArticle',NOW(),'supprime');";
		pg_query($connexion,$requete);
	}

	function recupArticleModifiablesEditeur($connexion, $editeur){
		$requete = "SELECT CE.article 
		FROM changement_etat_art_ed CE
		WHERE CE._date IN(
			SELECT SR1._date 
			FROM
			(
				SELECT C.article, MAX(C._date) AS _date 
				FROM changement_etat_art_ed C
				WHERE C.editeur IN
				( 
					SELECT E.pseudo 
					FROM editeur E
					WHERE E.comite IN 
					(
						SELECT comite		
						FROM editeur
						WHERE pseudo='$editeur'
					)
				)
				GROUP BY C.article
			)SR1
		)AND CE.etat='en_relecture';";
		$result = pg_query($connexion,$requete);
		return $result;
	}
?>
