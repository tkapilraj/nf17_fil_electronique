<?php
	//modele
	include(dirname(__FILE__).'/../modeles/m_indexation_article.php');
	// afin d'etre sur que la personne cherchant à accèder à la page
	//est connectée est qu'elle est un rédacteur
	if (isConnect($_SESSION)  && $_SESSION['editeur'] ){
		if(!empty($_GET['fonction'])){
		// listage des articles
		  $fonction = $_GET['fonction'];
      if($fonction == 'creer_index') {
        $listArt=getListArticle($connexion);
      }else if($fonction == 'ajout_index') {
        $listMot=getListMot($connexion);
      }else if($fonction == 'insertion') {
        
        $mot[1] = $_POST['mot1'];
        $mot[2] = $_POST['mot2'];
        $mot[3] = $_POST['mot3'];
        $mot[4] = $_POST['mot4'];
        $mot[5] = $_POST['mot5'];
        $titre  = $_POST['titre'];
        $insertion = creer_index($connexion, $titre, $mot);
      }else if($fonction == 'consulter') {
        $article = $_POST['article'];
        $consultation = getIndex($connexion, $article);
      }else if($fonction == 'consultDetail') {
        $article = $_GET['article'];
        $consultation = getIndexDetail($connexion, $article);
      }
    }else {
        $recupArt=getAllArticle($connexion);
    }
		// on vérifie si on à reçu un formulaire
		include(dirname(__FILE__).'/../vues/v_indexation_article.php');
  }
	else{
		// redirection vers l'index
		header('Location: index.php');
	}
?>
