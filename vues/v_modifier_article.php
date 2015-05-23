<?php  
	echo"<h2>Que souhaitez vous-réaliser avec l'article $titreArticle ?</h2>";
?>
<form method="POST" action="index.php?action=modifier_article" >
	<p>
		<?php
			echo "<input type='hidden' name='titre' value ='$titreArticle'>";
		?>		
		<input type="radio" name="choix" value="modifier_bloc_texte" id="modifier_bloc_texte" checked/>
		<label for="ajouter_bloc_image">Modifier un bloc de texte</label> <br/>
		<input type="radio" name="choix" value="modifier_bloc_image" id="modifier_bloc_image" />
		<label for="modifier_bloc_image">Modifier un bloc d'image</label> <br/>
		<input type="radio" name="choix" value="supprimer_bloc" id="supprimer_bloc" />
		<label for="supprimer_bloc">Supprimer un bloc</label> <br/>
		<input type="radio" name="choix" value="ajouter_bloc_texte" id="ajouter_bloc_texte" />
		<label for="ajouter_bloc_texte">Ajouter un bloc de texte</label> <br/>
		<input type="radio" name="choix" value="ajouter_bloc_image" id="ajouter_bloc_image" />
		<label for="ajouter_bloc_image">Ajouter un bloc d'image</label> <br/>
		<input type = "submit" value="envoyer">
	</p>
</form>