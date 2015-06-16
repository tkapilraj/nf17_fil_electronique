<?php
//fonction pour permettre l'editeur de consulter les articles soumission
  function getArticleSoumis($connexion,$pseudo){
    $pseudo   = pg_escape_string($pseudo);
    $requete  = "SELECT aa.article article, aa.soumis soumis
    FROM editeur e, Soumission s, art_appartient_soum aa
    WHERE e.pseudo = '$pseudo' AND e.comite = s.comite_editorial AND s._date = aa.soumis AND aa.article NOT IN (
    SELECT article FROM changement_etat_art_ed WHERE aa.soumis < _date
    );";
    $resultat = pg_query($connexion,$requete);
    return $resultat;
  }
?>
