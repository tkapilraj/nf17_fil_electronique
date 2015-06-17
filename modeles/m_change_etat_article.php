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
  function getArticlesEtat($connexion,$pseudo) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $requete = "
    with etats as
    (
      (SELECT a.titre article, c.etat etat, ROW_NUMBER() over(partition by a.titre order by c._date desc) id
      FROM changement_etat_art_ed c, article a, soumission s, editeur e, art_appartient_soum aa
      WHERE c.article = a.titre AND s.comite_editorial = e.comite AND e.pseudo = '$pseudo' AND aa.article = a.titre
      )
    ) select article,etat,id from etats WHERE id=1 AND etat <> 'a_reviser' OR etat IS NULL";
    $result = pg_query($requete);
    return $result;
  }
  
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
