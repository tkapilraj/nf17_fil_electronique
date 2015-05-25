<h2>S'inscrire</h2>
<?php
if (! empty($erreur)){
	print "<h3 class=\"erreur\">$erreur</h3>";
}
if (! empty($message)){
	print "<h3 class=\"message\">$message</h3>";
}
?>
<form method="post" action="index.php">
	Ici vous pouvez associé des articles à des rubriques.
	<input type="hidden" name="action" value="assoc_rub_article">
	<table>
		<tr>
			<th>
			article
			</th>
			<th>
			rubriques associés
			</th>
		</tr>
		<tr>
			<td>
				<select name="article" >
					<?php
						foreach ($articles as $article)
						{
							print "<option value=\"$article\">
							$article
							</option>";
						}
					?>
				</select>
			</td>
			<td>
				<select name="rubriques[]" multiple >
					<?php
						foreach ($rubriques as $rubrique)
						{
							print "<option value=\"$rubrique\">
							$rubrique
							</option>";
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