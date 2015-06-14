<?php

    echo '<INPUT TYPE="button" VALUE="<= Retour" onClick="history.back()"><br>';
    echo "<br><h2> Résultats de la recherche : </h2>";


    echo "<ul>";
    echo "<li><i>mot-clé : $motcle</i></li>";
    echo "<li><i>rubrique : $rubrique</i></li>";


    if($nb<=0)
        echo "<h5><br>Aucun résultat</h5>";
    else{
        echo "<li>$nb résultat(s)</li>";
    }

    echo "</ul>";