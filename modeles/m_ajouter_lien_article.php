<?php

    function getAllArticles($connect){

        $requete = "WITH MostRecentState AS(

                            SELECT titre, etat, date,ROW_NUMBER() OVER (PARTITION BY titre ORDER BY date DESC) AS rowNumber
                            FROM (SELECT article as titre, cast(etat as varchar), _date as date
                                  FROM changement_etat_art_red
                            UNION (SELECT article as titre,'soumis' as etat, soumis as date
                                  FROM art_appartient_soum
                            UNION (SELECT article as titre, cast(etat as varchar), _date as date
                                  FROM changement_etat_art_ed))) AS req
                        )

                        SELECT m.titre
                        FROM MostRecentState m, text t
                        WHERE m.rowNumber = 1 AND (etat='publie' OR etat='valide')  AND m.titre=t.titreArticle
                        GROUP BY m.titre";

        $query = pg_query($connect, $requete);
        return $query;
    }

    function ajouterLien($connect, $art1, $art2){

        $art1 = pg_escape_string($art1);
        $art2 = pg_escape_string($art2);


        if($art1 == $art2)
            return -1;

        $query = "SELECT * FROM lien WHERE article1 = '$art1' AND article2 = '$art2'";
        $result = pg_query($connect,$query);

        if(pg_num_rows($result)>0)
            return 0;

        $pseudo = $_SESSION["pseudo"];
        $query = "INSERT INTO lien(_date,editeur,article1,article2)
                  VALUES (NOW(),'$pseudo','$art1','$art2')";
        $result = pg_query($connect,$query);
        return 1;
    }

