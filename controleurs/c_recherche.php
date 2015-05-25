<?php
    include(dirname(__FILE__).'/../modeles/m_recherche.php');



if(!empty($_POST['param'])){
    // affichage des resultats de la recherche

    echo '<INPUT TYPE="button" VALUE="<= Back" onClick="history.back()"><br>';
    echo "<br><h2> Résultats de la recherche : </h2>";

    $motcle = $_POST['motcle'];
    $rubrique = $_POST['rubrique'];

    echo "<i>mot-clé : $motcle</i><br>";
    echo "<i>rubrique : $rubrique</i><br>";


    $articles = getResultRecherche($connexion,$motcle ,$rubrique);
    $nb = pg_num_rows($articles);
    if(pg_fetch_all($articles) == false)
        echo "<h5><br>Aucun résultat</h5>";
    else {
        echo "<br><br><i>$nb résultat(s)</i>";
        include(dirname(__FILE__) . '/../vues/v_liste_articles.php');
    }
}else{
    //formulaire de recherche


    $rubriques = getAllRubriques($connexion);

    include(dirname(__FILE__).'/../vues/v_recherche.php');
}