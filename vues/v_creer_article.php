<h2>Création d'article</h2>

<?php
	if($affichageFormulaire){
?>
	<form method = "POST" action="index.php?action=creer_article">
		<?php
			$message = (empty($messageErreur))?"ex : mon titre":$messageErreur;
		?>
		<p>
			<label for="titre">
				Titre d'article :
			</label>
				<?php
					echo "<input type='text' maxlength='50' id ='titre' name='titre' placeholder='$message' required autofocus/>";
				?>
			<br/>
			<input type = "submit" value = "envoyer"/> <input type = "reset" value = "effacer"/>
		</p>
	</form>
<?php
	}
	else{
		echo "<h3>$messageReussite</h3>";

	}
?>
