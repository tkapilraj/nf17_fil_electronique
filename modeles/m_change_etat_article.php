<?php
  function change_etat_article_ed($connexion, $article, $option, $explication) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $formatPHP = "d-m-Y H:i:s:u";
		$formatPostGreSQL = "DD-MM-YYYY HH24:MI:SS:US";
		$date = date($formatPHP);
    $requete = "INSERT INTO changement_etat_art_ed(_date,article,editeur,etat,explication)
    VALUES ($date,$article,$option,$explication)";
    $result=pg_query($requete);
    return $result;
  }
  
  function get_etat_article_ed($connexion, $article) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    //récupérer la liste d'états d'un article
    $requete = "SELECT *
    FROM changement_etat_art_ed
    WHERE article='$article'
    ORDER BY _date DESC";
    $result=pg_query($requete);
    return $result;
  }
?>
