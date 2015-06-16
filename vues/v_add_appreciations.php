<a href="index.php?action=appreciations&param=<?php echo $article; ?>">Modifier le statut de vos commentaires</a>

<form method="post" action="index.php?action=appreciations&param=<?php echo $article; ?>&option=add">
	<fieldset>
		<legend>Note</legend> <!-- Titre du fieldset -->
		
		<input type="number" name="note" id="note" min="0" max="10" required/>
	</fieldset>

	<fieldset>
		<legend>Commentaire</legend> <!-- Titre du fieldset -->		
		<p>
			<label for="titre">Titre</label></br>
			<input type="text" name="titre" id="titre" required/>
		</p>
		<p>
			<label for="texte">Texte</label></br>
			<textarea name="texte" id="texte" rows=10 COLS=40 required></textarea>
		</p>
	</fieldset>

	<input type="submit" value="Envoyer" />
</form>