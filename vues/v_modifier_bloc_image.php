<h2>Modification d'un bloc image</h2>
<?php
	if(!empty($messageReussite)){
		// la demande de l'utilisateur a abouti
		echo "<h3>$messageReussite</h3>";
	}
	else{
		if(!empty($messageEchec)){
			echo "<h3>$messageEchec</h3>";
		}
		if(!empty($listeBlocsImages) && $listeBlocsImages != FALSE){
			if(pg_num_rows($listeBlocsImages) == 0){
				echo "L'article $titreArticle ne contient pas encore de blocs d'image";
			}
			else{
				$i=1;
				while($res = pg_fetch_array($listeBlocsImages)) {
						if($i==1){
							echo "<h3>Liste des blocs image</h3>";
							echo "<form action = 'index.php?action=modifier_article' method='POST'>";
							echo "<input type='hidden' name='titre' value ='$titreArticle'>";
							echo "<input type='hidden' name='choix' value ='$choix'>";
							echo "<p>";
							echo "<input type = 'radio' name ='titre_bloc_image' value ='".$res['titrebloc']."' id ='".$res['titrebloc']."'checked/>";
						}
						else{
							echo "<input type = 'radio' name ='titre_bloc_image' value ='".$res['titrebloc']."' id ='".$res['titrebloc']."'/>";
						}
						echo "<label for ='".$res['titrebloc']."'>".$res['titrebloc']."</label> <br/>";
						$i++;
				}
				echo "<input type ='submit' value = 'envoyer'>";
				echo "</p>";
				echo "</form>";	
			}
		}
		if(!empty($blocImageActuel) && $blocImageActuel != FALSE){			
			if(pg_num_rows($blocImageActuel) == 0){
				echo "Désolé, nous n'avons pas trouvé le bloc image $titreBlocImage de l'article $titreArticle";
			}
			else{
				$res = pg_fetch_array($blocImageActuel,0);
				echo "<h3>Modifications du bloc image $titreBlocImage de l'article $titreArticle</h3>";
				echo "<form action = 'index.php?action=modifier_article' method='POST' enctype='multipart/form-data'>";
				echo "<input type='hidden' name='titre' value ='$titreArticle'>";
				echo "<input type='hidden' name='choix' value ='$choix'>";
				echo "<input type='hidden' name='titre_bloc_image' value ='$titreBlocImage'>";
				echo "<p>";
				echo "<label for='new_titre_bloc_image'>Titre du bloc</label>";
				echo "<input type='text' name='new_titre_bloc_image'  id='new_titre_bloc_image' value ='$titreBlocImage' required autofocus>";
				echo "<br/>";
				// $cheminFichier = dirname(__FILE__).'/../images_articles/'.$res['contenu_img'];
				$cheminFichier = 'images_articles/'.$res['contenu_img'];
				echo "<figure>";
				echo "<a href='$cheminFichier' target='_blank'><img src='$cheminFichier' alt='image $titreBlocImage $titreArticle' height='100' width='100' title='cliquez pour agrandir' ></a>";
				echo "<figcaption>Votre ancienne image</figcaption>";			
				echo"</figure>";
?>
				<input type="hidden" name="MAX_FILE_SIZE" value="10485760" /> 
				<!--on n'autorise pas l'utilisateur d'uploader plus de 10 mo-->
				<label for="new_contenu_bloc_image">Sélectionner votre nouvelle image</label>
				<input type="file" name="new_contenu_bloc_image" id="new_contenu_bloc_image" required/>
				<br/>
				<input type = "submit" value="envoyer">
				</p>
				</form>
<?php
			}
		}


	}
?>
