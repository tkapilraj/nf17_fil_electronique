<h2>Rechercher un article</h2>


<form method="post" action="index.php">
    <input type="hidden" name="action" value="recherche">
    <input type="hidden" name="param" value="afficahge">
    <table>
        <tr>
            <td>Mot-clé :</td>
            <td><input type="text" name="motcle"
                       maxlength="32"
                       placeholder="Entrez un mot-clé"
                    ></td>
        </tr>
        <tr>
            <td>Rubrique :</td>
            <td><select name="rubrique" size="1">

                <?php
                    while($result = pg_fetch_array($rubriques)){
                        echo '<option>'.$result["nom"];
                    }

                ?>


                </select></td>
        </tr>
        <tr>
            <td><input type=submit></td>
        </tr>
    </table>
</form>
