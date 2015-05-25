<?php

if($result == -1 || $result == 0)
    echo '<INPUT TYPE="button" VALUE="<= Back" onClick="history.back()"><br><br>';


if($result == -1)
    echo "<h3>Impossible de lier un article à lui-même.</h3>";
else if($result == 0)
    echo "<h3>Le lien existe déjà.</h3>";
else if($result == 1)
    echo "<h3>Le lien entre les articles '$art1' et '$art2' a bien été créé.</h3>";
else {


    echo "<h2> Ajouter un lien entre deux articles</h2>";


    echo '<form method="post" action="index.php">
        <input type="hidden" name="action" value="ajouter_lien_article">
        <input type="hidden" name="param" value="aff_confirmation">
        <table>
            <tr>
                <td> Premier article : </td>
                <td>
                    <select name="article1" size="1">';

    while ($r = pg_fetch_array($articles1)) {
        echo '<option>' . $r["titre"] . '</option>';
    }

    echo '               </select>
                </td>
            </tr>
            <tr>
                <td> Second article : </td>
                <td><select name="article2" size="1">';


    while ($r = pg_fetch_array($articles2)) {
        echo '<option>' . $r["titre"] . '</option>';
    }

    echo '               </select>
                </td>
            </tr>
            <tr>
                <td><input type=submit></td>
            </tr>
        </table>
    </form>';

}


    ?>