<?php
//fonction qui permet de creer un nouvelle indexation d'un article
  function creer_index_article($connexion,$article) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $formatPHP = "d-m-Y H:i:s:u";
		$formatPostGreSQL = "DD-MM-YYYY HH24:MI:SS:US";
		$date = date($formatPHP);
    $requete1= "INSERT INTO indexation(_date) 
    VALUES(to_timestamp($date,$formatPostGreSQL)";
    pg_query($connexion,$requete1);
    $requete2="INSERT INTO ed_creer_index(ed,_index)
    VALUES($pseudo,to_timestamp($date,$formatPostGreSQL))";
    pg_query($connexion,$requete2);
    $requete3="INSERT INTO art_faipartie_indexation(article,_index)
    VALUES($article,to_timestamp($date,$formatPostGreSQL))";
    pg_query($connexion,$requete3);
  }
  
//fonction qui permet de relier un mot cle avec une indexation
  function ajout_motcle_indexation($connexion,$indexation,$motcle) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $requete = "INSERT INTO mc_appartient_index(mc,_index)
    VALUES($motcle,$indexation)";
    pg_query($connexion,$requete);
  }
  
//fonction qui permet de creer un nouveau mot cle  
  function creer_motcle($connexion,$motcle) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $requete = "INSERT INTO mot_cle
    VALUES($motcle)";
    pg_query($connexion,$requete);
  }
?>
