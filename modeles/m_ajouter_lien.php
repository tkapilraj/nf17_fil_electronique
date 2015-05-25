<?php

    function getAllArticles($connect){
        $requete = "SELECT titre FROM article";
        $query = pg_query($connect, $requete);
        return $query;
    }