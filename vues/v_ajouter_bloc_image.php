<?php  	
	if(!empty($message)){
		echo "<h3>$message</h3>";

	}
	else{
		echo "<h2>Création d'un nouveau bloc image de l'article $titreArticle</h2>";
?>
<form method="POST" action="index.php?action=modifier_article" enctype="multipart/form-data" >
	<p>
		<?php
			echo "<input type='hidden' name='titre' value ='$titreArticle'>";
			echo "<input type='hidden' name='choix' value ='$choix'>";
		?>		
		<label for="titre_bloc_image">Titre du bloc</label>
		<input type="text" name="titre_bloc_image" maxlength="50" id="titre_bloc_image" placeholder='ex : mon titre' required autofocus>
		<br/>
		<input type="hidden" name="MAX_FILE_SIZE" value="10485760" /> 
		<!--on n'autorise pas l'utilisateur d'uploader plus de 10 mo-->
		<label for="contenu_bloc_image">Sélectionner votre image</label>
		<input type="file" name="contenu_bloc_image" id="contenu_bloc_image" required/>
		<br/>
		<input type = "submit" value="envoyer">
	</p>
</form>
<?php 
	}
?>