<?php


    function getAllRubriques($connect){
        $requete = "SELECT nom FROM rubrique";
        $query = pg_query($connect, $requete);
        return $query;
    }

    function getResultRecherche($connect, $mot, $rubr){
        $requete = "SELECT * FROM article";
        $query = pg_query($connect,$requete);
        return $query;
    }