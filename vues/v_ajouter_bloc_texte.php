<?php  	
	if(!empty($message)){
		echo"<h3>$message</h3>";

	}
	else{
		echo"<h2>Création d'un nouveau bloc texte de l'article $titreArticle</h2>";
?>
<form method="POST" action="index.php?action=modifier_article" >
	<p>
		<?php
			echo "<input type='hidden' name='titre' value ='$titreArticle'>";
			echo "<input type='hidden' name='choix' value ='$choix'>";
		?>		
		<label for="titre_bloc_texte">Titre du bloc</label>
		<input type="text" name="titre_bloc_texte" maxlength="50" id="titre_bloc_texte" placeholder='ex : mon titre' required autofocus>
		<br/>
       	<label for="contenu_bloc_texte">Contenu du bloc</label><br />
        <textarea name="contenu_bloc_texte" id="contenu_bloc_texte" rows="10" cols="50" maxlength="1000" required></textarea>
        <br/>
		<input type = "submit" value="envoyer">
	</p>
</form>
<?php 
	}
?>