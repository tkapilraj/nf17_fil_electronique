<h2>Modification d'un bloc texte</h2>
<?php
	if(!empty($messageReussite)){
		// la demande de l'utilisateur a abouti
		echo "<h3>$messageReussite</h3>";
	}
	else{
		if(!empty($messageEchec)){
			echo "<h3>$messageEchec</h3>";
		}
		if(!empty($listeBlocsTextes) && $listeBlocsTextes != FALSE){
			if(pg_num_rows($listeBlocsTextes) == 0){
				echo "L'article $titreArticle ne contient pas encore de blocs de texte";
			}
			else{
				$i=1;
				while($res = pg_fetch_array($listeBlocsTextes)) {
						if($i==1){
							echo "<h3>Liste des blocs texte</h3>";
							echo "<form action = 'index.php?action=modifier_article' method='POST'>";
							echo "<input type='hidden' name='titre' value ='$titreArticle'>";
							echo "<input type='hidden' name='choix' value ='$choix'>";
							echo "<p>";
							echo "<input type = 'radio' name ='titre_bloc_texte' value ='".$res['titrebloc']."' id ='".$res['titrebloc']."'checked/>";
						}
						else{
							echo "<input type = 'radio' name ='titre_bloc_texte' value ='".$res['titrebloc']."' id ='".$res['titrebloc']."'/>";
						}
						echo "<label for ='".$res['titrebloc']."'>".$res['titrebloc']."</label> <br/>";
						$i++;
				}
				echo "<input type ='submit' value = 'envoyer'>";
				echo "</p>";
				echo "</form>";	
			}
		}
		if(!empty($blocTexteActuel) && $blocTexteActuel != FALSE){			
			if(pg_num_rows($blocTexteActuel) == 0){
				echo "Désolé, nous n'avons pas trouvé le bloc texte $titreBlocTexte de l'article $titreArticle";
			}
			else{
				$res = pg_fetch_array($blocTexteActuel,0);
				$contenuBlocTexte = $res['contenu_txt'];
				echo "<h3>Modifications du bloc texte $titreBlocTexte de l'article $titreArticle</h3>";
				echo "<form action = 'index.php?action=modifier_article' method='POST'>";
				echo "<input type='hidden' name='titre' value ='$titreArticle'>";
				echo "<input type='hidden' name='choix' value ='$choix'>";
				echo "<input type='hidden' name='titre_bloc_texte' value ='$titreBlocTexte'>";
				echo "<input type='hidden' name='contenu_bloc_texte' value ='$contenuBlocTexte'>";
				echo "<p>";
				echo "<label for='new_titre_bloc_texte'>Titre du bloc</label>";
				echo "<input type='text' name='new_titre_bloc_texte'  id='new_titre_bloc_texte' value ='$titreBlocTexte' required autofocus>";
				echo "<br/>";
		       	echo "<label for='contenu_bloc_texte'>Contenu du bloc</label><br />";
		        echo "<textarea name='new_contenu_bloc_texte' id='new_contenu_bloc_texte' rows='10' cols='50' required>$contenuBlocTexte</textarea>";
?>
				<br/>
				<input type = "submit" value="envoyer">
				</p>
				</form>
<?php
			}
		}


	}
?>
