<?php

    function getAllArticles($connect){
        $requete = "SELECT titre FROM article";
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

