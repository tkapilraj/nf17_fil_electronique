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
	<input type="hidden" name="action" value="inscription">
	<table>
		<tr>
			<td>Pseudo :</td>
			<td><input type="text" name="pseudo"
			maxlength="32" required
			placeholder="Entrez un pseudo"
			></td>
		</tr>
		<tr>
			<td>Nom :</td>
			<td><input type="text" name="nom"
			maxlength="64" required
			placeholder="Entrez votre nom"
			></td>

		</tr>
		<tr>
			<td>Prénom :</td>
			<td><input type="text" name="prenom"
			maxlength="64" required
			placeholder="Entrez votre prénom"
			></td>
		</tr>
		<tr>
			<td>date de naissance:</td>
			<td><input type="date" name="date_naissance"
			required
			pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
			placeholder="AAAA-MM-JJ"
			 ></td>
		</tr>
		<tr>
			<td>
				Rôles :
			</td>
			<td>
				<select name="statuts[]" multiple>
				  <option value="lecteur">Lecteur</option>
				  <option value="redacteur">Rédacteur</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><input type=submit></td>
		</tr>
	</table>
</form>
