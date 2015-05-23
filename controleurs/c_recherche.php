<?php
    include(dirname(__FILE__).'/../modeles/m_recherche.php');



if(!empty($_POST['param'])){
    // affichage des resultat de la recherche

    $p = $_POST['param'];
    echo "affichage resultats $p";

    $motcle = $_POST['motcle'];
    $rubrique = $_POST['rubrique'];

    echo "<br>recherche de mot cle:  $motcle rubrique : $rubrique <br>";


    $articles = getResultRecherche($connexion,$motcle ,$rubrique);


    include(dirname(__FILE__).'/../vues/v_liste_articles.php');

}else{
    //formulaire de recherche


    $rubriques = getAllRubriques($connexion);


    include(dirname(__FILE__).'/../vues/v_recherche.php');
}