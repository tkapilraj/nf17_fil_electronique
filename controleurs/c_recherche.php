<?php
    include(dirname(__FILE__).'/../modeles/m_recherche.php');



if(!empty($_POST['param'])){

       /* echo "-------------test---------------------<br>";
    $publie = getArticlesPublies($connexion);
    while($r = pg_fetch_array($publie))
        echo $r["titre"].'<br>';

    echo "-------------test---------------------<br>";
*/

    // affichage des resultats de la recherche

    $motcle = $_POST['motcle'];
    $rubrique = $_POST['rubrique'];

    $articles = getResultRecherche($connexion,$motcle ,$rubrique);
    $nb = pg_num_rows($articles);

    include(dirname(__FILE__) . '/../vues/v_resultat_recherche.php');
    include(dirname(__FILE__) . '/../vues/v_liste_articles.php');

}else{
    //formulaire de recherche


    $rubriques = getAllRubriques($connexion);

    include(dirname(__FILE__).'/../vues/v_recherche.php');
}