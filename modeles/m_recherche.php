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
                      GROUP BY titre";

            $result = pg_query($connect,$query);

        }else{

            $query = "SELECT titre as titre, (array_agg(contenu_txt))[1] as texte
                      FROM (SELECT a.article as titre
                          FROM association a, assoc_appartient_rub r
                          WHERE rubrique='$rubr' AND a._date=r._date) as req LEFT JOIN text
                          ON titre=titreArticle AND req.titre IN (
                                SELECT A.titre AS titre
                                FROM mot_cle C, indexation I, mc_appartient_index M,article A, art_faipartie_indexation P
                                WHERE C.mot = M.mc AND M._index = I._date AND I._date = P._index AND P.article = A.titre AND C.mot='$mot')
                          GROUP BY titre";

            $result = pg_query($connect,$query);
        }
        return $result;
    }


