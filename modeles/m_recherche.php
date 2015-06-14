<?php


    function getAllRubriques($connect){
        $requete = "SELECT * FROM rubrique";
        $query = pg_query($connect, $requete);
        return $query;
    }

    function getResultRecherche($connect, $mot, $rubr){
        // on protège les entrées
        $mot = pg_escape_string($mot);
        $rubr = pg_escape_string($rubr);


        if($rubr == "tous"){

            $query = "SELECT titre as titre, (array_agg(contenu_txt))[1] as texte
                      FROM (SELECT A.titre AS titre
                            FROM mot_cle C, indexation I, mc_appartient_index M,article A, art_faipartie_indexation P
                            WHERE C.mot = M.mc AND M._index = I._date AND I._date = P._index AND P.article = A.titre AND C.mot='$mot') as req
                      LEFT JOIN text ON titre=titreArticle

                      WHERE titre IN

                      (
                        WITH MostRecentState AS(

                        SELECT titre, etat, date,	ROW_NUMBER() OVER (PARTITION BY titre ORDER BY date DESC) AS rowNumber
                        FROM (SELECT article as titre, cast(etat as varchar), _date as date
                              FROM changement_etat_art_red
                        UNION (SELECT article as titre,'soumis' as etat, soumis as date
                              FROM art_appartient_soum
                        UNION (SELECT article as titre, cast(etat as varchar), _date as date
                              FROM changement_etat_art_ed))) AS req
                              )

                        SELECT m.titre
                        FROM MostRecentState m, text t
                        WHERE m.rowNumber = 1 AND etat='publie'  AND m.titre=t.titreArticle
                        GROUP BY m.titre
                      )
                      GROUP BY titre";

            $result = pg_query($connect,$query);

        }else{

            $query = "
                      SELECT titre as titre, (array_agg(contenu_txt))[1] as texte
                      FROM (SELECT a.article as titre
                          FROM association a, assoc_appartient_rub r
                          WHERE rubrique='$rubr' AND a._date=r._date) as req INNER JOIN text
                          ON titre=titreArticle AND req.titre IN (
                                SELECT A.titre AS titre
                                FROM mot_cle C, indexation I, mc_appartient_index M,article A, art_faipartie_indexation P
                                WHERE C.mot = M.mc AND M._index = I._date AND I._date = P._index AND P.article = A.titre AND C.mot='$mot')
                      WHERE titre IN

                      (
                        WITH MostRecentState AS(

                        SELECT titre, etat, date,	ROW_NUMBER() OVER (PARTITION BY titre ORDER BY date DESC) AS rowNumber
                        FROM (SELECT article as titre, cast(etat as varchar), _date as date
                              FROM changement_etat_art_red
                        UNION (SELECT article as titre,'soumis' as etat, soumis as date
                              FROM art_appartient_soum
                        UNION (SELECT article as titre, cast(etat as varchar), _date as date
                              FROM changement_etat_art_ed))) AS req
                              )

                        SELECT m.titre
                        FROM MostRecentState m, text t
                        WHERE m.rowNumber = 1 AND m.etat='publie' AND m.titre=t.titreArticle
                        GROUP BY m.titre
                      )

                      GROUP BY titre";

            $result = pg_query($connect,$query);
        }
        return $result;
    }



