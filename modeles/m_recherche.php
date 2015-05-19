<?php


    function getAllRubriques($connect){
        $requete = "SELECT nom FROM rubrique";
        $query = pg_query($connect, $requete);
        return $query;
    }

    function getResultRecherche($connect, $mot, $rubr){
        // on protège les entrées
		$mot = pg_escape_string($mot);
        $rubr = pg_escape_string($rubr);
		// requête
        $requete = "SELECT * FROM article";
        $query = pg_query($connect,$requete);
        return $query;
    }
