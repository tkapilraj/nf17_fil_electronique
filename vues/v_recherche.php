<h2>Rechercher un article</h2>


<form method="post" action="index.php">
    <input type="hidden" name="action" value="recherche">
    <input type="hidden" name="param" value="affichage">
    <table>
        <tr>
            <td>Mot-clé :</td>
            <td><input type="text" name="motcle"
                       maxlength="32"
                       placeholder="Entrez un mot-clé"
                       required
                    ></td>
        </tr>
        <tr>
            <td>Rubrique :</td>
            <td><select name="rubrique" size="1">
                <option>tous</option>
                <?php
                    while($result = pg_fetch_array($rubriques)){
                        echo "<option value='";
                        echo $result["nom"].'\'';
                        echo '>'.$result["rubrique_mere"].'->'.$result["nom"].'</option>';
                    }

                ?>


                </select></td>
        </tr>
        <tr>
            <td><input type=submit></td>
        </tr>
    </table>
</form>
