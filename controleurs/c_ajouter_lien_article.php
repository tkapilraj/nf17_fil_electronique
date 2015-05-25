<?php
    include(dirname(__FILE__) . '/../modeles/m_ajouter_lien_article.php');



if(!empty($_POST['param'])){
    // affichage de la confirmation de la creation

    $art1 = $_POST["article1"];
    $art2 = $_POST["article2"];

    $result = ajouterLien($connexion, $art1, $art2);





}else{
    //formulaire d'ajout de lien

    $result = 2;

    $articles1 = getAllArticles($connexion);
    $articles2 = getAllArticles($connexion);



}

include(dirname(__FILE__) . '/../vues/v_ajouter_lien_article.php');
