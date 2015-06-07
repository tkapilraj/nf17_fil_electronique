<h2>Ajout de rubriques</h2>
<?php
if (! empty($erreur)){
	print "<h3 class=\"erreur\">$erreur</h3>";
}
if (! empty($message)){
	print "<h3 class=\"message\">$message</h3>";
}
?>
<form method="post" action="index.php">
	<input type="hidden" name="action" value="creer_rubrique">
	<table>
		<tr>
			<th>
			nouvelle rubrique
			</th>
			<th>
			rubrique mère
			</th>
		</tr>
		<tr>
			<td><input type="text" name="rubrique"
			maxlength="64" required
			placeholder="Entrez le nom de la rubrique"
			></td>
			<td>
				<select name="mere" >
					<option value="NULL">aucune</option>
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
