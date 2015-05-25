<h2> Ajouter un lien entre deux articles</h2>


<form method="post" action="index.php">
    <input type="hidden" name="action" value="ajouter_lien">
    <input type="hidden" name="param" value="aff_confirmation">
    <table>
        <tr>
            <td> Premier article : </td>
            <td>
                <select name="article1" size="1">
                <?php
                    while($r = pg_fetch_array($articles1)) {
                        echo '<option>'.$r["titre"].'</option>';
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td> Second article : </td>
            <td><select name="article2" size="1">

                <?php
                    while($r = pg_fetch_array($articles2)) {
                        echo '<option>'.$r["titre"].'</option>';
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type=submit></td>
        </tr>
    </table>
</form>