<form method="post" action="index.php?action=appreciations&param=<?php echo $article; ?>&option=updated">
	<input type="hidden" name="appreciation" id="appreciation" value="<?php echo $appreciation; ?>">
	<input type="radio" name="etat" value="visible" <?php if($etat == 'visible') { echo "checked";} ?> >Visible<br>
	<input type="radio" name="etat" value="supprime" <?php if($etat == 'supprime') { echo "checked";} ?>>Supprimé
	<p><input type="submit" value="Envoyer" /></p>
</form>