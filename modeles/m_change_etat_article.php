<?php
  //permet de changer l'état d'un article
  function change_etat_article_ed($connexion, $article, $option, $explication) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $formatPHP = "d-m-Y H:i:s:u";
		$formatPostGreSQL = "DD-MM-YYYY HH24:MI:SS:US";
		$date = date($formatPHP);
    $requete = "INSERT INTO changement_etat_art_ed(_date,article,editeur,etat,explication)
    VALUES (to_timestamp('$date','$formatPostGreSQL'),'$article','$pseudo','$option','$explication')";
    $result=pg_query($requete);
    return $result;
  }
  
  //recupérer l'histoire d'état d'un article
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
  
  //permet de recupérer les articles et leurs derniers etats
  function getArticlesEtat($connexion) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $requete = "
    with etats as
    (
    SELECT a.titre article, c.etat etat, ROW_NUMBER() over(partition by c.article order by c._date desc) id
    FROM changement_etat_art_ed c RIGHT OUTER JOIN article a ON c.article = a.titre
    ) select article,etat from etats where id=1";
    $result = pg_query($requete);
    return $result;
  }
?>
