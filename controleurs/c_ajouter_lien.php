<?php
    include(dirname(__FILE__).'/../modeles/m_ajouter_lien.php');



if(!empty($_POST['param'])){
    // affichage de la confirmation de la creation

    $art1 = $_POST["article1"];
    $art2 = $_POST["article2"];

    echo "<p>Le lien entre les articles $art1 et $art2 a bien été créé.</p>";

}else{
    //formulaire d'ajout de lien

    $articles1 = getAllArticles($connexion);
    $articles2 = getAllArticles($connexion);

    include(dirname(__FILE__).'/../vues/v_ajouter_lien.php');
}