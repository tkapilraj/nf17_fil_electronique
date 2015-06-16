<?php
//
function creer_index($connexion,$titre,$mot){
  pg_query("START TRANSACTION");
  $formatPHP = "d-m-Y H:i:s:u";
  $date = date($formatPHP);
  $transaction = true;
  $insertion = creer_index_article($connexion,$titre,$date);
  if($insertion){
    for($i=1;$i<6;$i++){
		  if($mot[$i] !== ''){
		    $duplicate = false;
		    for($j=1;$j<$i+1;$j++){
		      if($mot[$i]==$mot[$j]){
		        $duplicate = true;
		      }
		    }
		    if(!$duplicate){
		      if(!verifyMot($connexion,$mot[$i])){
		        creer_motcle($connexion,$mot[$i]);
		        if(!ajout_motcle_indexation($connexion,$date,$mot[$i])){
		          $transaction = false;
		        }
		      }else {
		        if(!ajout_motcle_indexation($connexion,$date,$mot[$i])){
		        $transaction = false;
		        }
		      }
		    }else {
		        $n--;
		    }
		  }else {
		        $n--;
		  }
		}
  }else {
    $transaction = false;
  }
  if($transaction&&$n>0){
    pg_query("COMMIT");
    return true;
  }else {
    pg_query('ROLLBACK');
    return false;
  }
}

//permet de consulter un index
function getIndex($connexion, $titre){
  $requete = "SELECT DISTINCT e.ed editeur,  m.mc motcle
  FROM ed_creer_index e, art_faipartie_indexation a LEFT OUTER JOIN mc_appartient_index m ON a._index = m._index
  WHERE a.article='$titre' AND e._index = a._index AND a._index IN (
    SELECT a._index
    FROM art_faipartie_indexation a LEFT OUTER JOIN mc_appartient_index m ON a._index = m._index
    GROUP BY a._index
    HAVING count(m._index) > 0
  )";
  return pg_query($connexion, $requete);
}

function getIndexDetail($connexion, $titre){
  $requete = "SELECT e.ed editeur,a._index _index, m.mc motcle
  FROM ed_creer_index e, art_faipartie_indexation a LEFT OUTER JOIN mc_appartient_index m ON a._index = m._index
  WHERE a.article='$titre' AND e._index = a._index AND a._index IN (
    SELECT a._index
    FROM art_faipartie_indexation a LEFT OUTER JOIN mc_appartient_index m ON a._index = m._index
    GROUP BY a._index
    HAVING count(m._index) > 0
  )";
  return pg_query($connexion, $requete);
}


//fonction qui permet de creer un nouvelle indexation d'un article
  function creer_index_article($connexion,$article,$date) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    //$formatPHP = "d-m-Y H:i:s:u";
		$formatPostGreSQL = "DD-MM-YYYY HH24:MI:SS:US";
		//$date = date($formatPHP);
    $result = false;
    $requete1= "INSERT INTO indexation(_date) 
    VALUES(to_timestamp('$date','$formatPostGreSQL'))";
    if(pg_query($connexion,$requete1)){
      $requete2="INSERT INTO ed_creer_index(ed,_index)
      VALUES('$pseudo',to_timestamp('$date','$formatPostGreSQL'))";
      if(pg_query($connexion,$requete2)){
        $requete3="INSERT INTO art_faipartie_indexation(article,_index)
        VALUES('$article',to_timestamp('$date','$formatPostGreSQL'))";
        if(pg_query($connexion,$requete3)){
          $result = true;
        }
      }
    }
    return $result;
  }
  
//fonction qui permet de relier un mot cle avec une indexation
  function ajout_motcle_indexation($connexion,$indexation,$motcle) {
    $formatPostGreSQL = "DD-MM-YYYY HH24:MI:SS:US";
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $requete = "INSERT INTO mc_appartient_index(mc,_index)
    VALUES('$motcle',to_timestamp('$indexation','$formatPostGreSQL'))";
    return pg_query($connexion,$requete);
  }
  
//fonction qui permet de creer un nouveau mot cle  
  function creer_motcle($connexion,$motcle) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $values['mot']=$motcle;
    return pg_insert($connexion,"mot_cle",$values);
  }
  
  function verifyMot($connexion,$motcle) {
    $existe = false;
    if($motcle !== ''){
      $pseudo = pg_escape_string($_SESSION['pseudo']);
      $requete = "SELECT mot
      FROM mot_cle
      WHERE mot='$motcle'";
      
      if($result = pg_fetch_array(pg_query($connexion,$requete))){
        if($result['mot'] == $motcle){
          $existe = true;
        }
      }
      
    }
    return $existe;
  }
  
  function getListMot($connexion) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $requete = "SELECT mot 
    FROM mot_cle";
    return pg_query($connexion,$requete);    
  }

//fonction qui permet de recuperer tous les articles
  function getAllArticle($connexion) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $requete = "SELECT DISTINCT a.titre article, count(i._index) qte,
    CASE 
      WHEN count(i._index) > 0 THEN 'indexe'
      WHEN count(i._index) = 0 THEN 'non indexe'
    END AS categorie
    FROM Article a LEFT JOIN art_faipartie_indexation i
    ON a.titre = i.article
    WHERE a.titre IN (
      with etats as
      (
      SELECT a.titre article, c.etat etat, ROW_NUMBER() over(partition by c.article order by c._date desc) id
      FROM changement_etat_art_ed c RIGHT OUTER JOIN article a ON c.article = a.titre
      ) select article from etats where id=1 AND etat = 'valide'
    )
    GROUP BY a.titre
    ORDER BY a.titre";
    
    //$requete ="SELECT titre FROM article;";
    return pg_query($connexion,$requete);
  }
  
  function getListArticle($connexion) {
    $pseudo = pg_escape_string($_SESSION['pseudo']);
    $requete = "SELECT DISTINCT titre
    FROM Article
    WHERE a.titre IN (
      with etats as
      (
      SELECT a.titre article, c.etat etat, ROW_NUMBER() over(partition by c.article order by c._date desc) id
      FROM changement_etat_art_ed c RIGHT OUTER JOIN article a ON c.article = a.titre
      ) select article from etats where id=1 AND etat = 'valide'
    )";
    return pg_query($connexion,$requete);
  }
?>
