<h2>Se connecter</h2>
<?php
if (! empty($erreur)){
	print "<h3 class=\"erreur\">$erreur</h3>";
}
?>
<form method="post" action="index.php">
	<input type="hidden" name="action" value="connection">
	<table>
		<tr>
			<td>Pseudo :</td>
			<td><input type="text" name="pseudo"
			maxlength="32" required
			placeholder="Entrez un pseudo"
			></td>
		</tr>
		<tr>
			<td>date de naissance :</td>
			<td><input type="date" name="date_naissance"
			required
			pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
			placeholder="AAAA-MM-JJ"
			 ></td>
		</tr>
		<tr>
			<td><input type=submit></td>
		</tr>
	</table>
</form>

