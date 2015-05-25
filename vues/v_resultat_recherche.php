<?php

    echo '<INPUT TYPE="button" VALUE="<= Retour" onClick="history.back()"><br>';
    echo "<br><h2> Résultats de la recherche : </h2>";



    echo "<i>mot-clé : $motcle</i><br>";
    echo "<i>rubrique : $rubrique</i><br>";


    if($nb<=0)
        echo "<h5><br>Aucun résultat</h5>";
    else{
        echo "<br><br><i>$nb résultat(s)</i>";
    }