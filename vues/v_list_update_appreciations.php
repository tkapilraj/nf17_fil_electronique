<h3>Vos commentaires</h3>

<?php

	while($result = pg_fetch_array($appreciations)) {
		echo '<div class="cleaner_h10 horizon_divider"></div><div class="cleaner_h10"></div>';
		echo "<h4>Le ".$result['date']."</h4>";
		echo "<h5>".$result['titre']."</h5>";
		echo "<p>Note : ".$result['note']."</p>";
		echo "<p>".$result['texte']."</p>";
		echo "<p>Etat actuel : ".$result['etat']."</p>";
		echo '<form method="post" action="index.php?action=appreciations&param='.$article.'&option=update">
				<input type="hidden" name="appreciation" id="appreciation" value="'.$result['id'].'">
				<input type="hidden" name="etat" id="etat" value="'.$result['etat'].'">
				<input type="submit" value="Modifier">
			</form>';
	}

?>
<div class="cleaner_h10 horizon_divider"></div><div class="cleaner_h10"></div>
<a href="index.php?action=articles&param=<?php echo $article; ?>">Retour</a>