<?php
//fonction pour permettre l'editeur de consulter les articles soumission
  function getArticleSoumis($connexion,$pseudo){
    $pseudo   = pg_escape_string($pseudo);
    $requete  = "SELECT article,soumis 
    FROM art_appartient_soum";
    $resultat = pg_query($connexion,$requete);
    return $resultat;
  }
?>
