<?php
	if(!empty($result)){
		echo "<h2>Veuillez sélectionner l'article que vous souhaitez consulter</h2>";
		echo "<form action = 'index.php?action=consulter_article' method='POST'>";
		echo "<p>";
		$i = 1;
		while($res = pg_fetch_array($result)) {
				if($i==1){
					echo "<input type = 'radio' name ='titre' value ='".$res['article']."' id ='".$res['article']."'checked/>";
				}
				else{
					echo "<input type = 'radio' name ='titre' value ='".$res['article']."' id ='".$res['article']."'/>";
				}
				echo "<label for ='".$res['article']."'>".$res['article']."</label> <br/>";
				$i++;
		}	
		echo "<input type ='submit' value = 'envoyer'>";
		echo "</p>";
		echo "</form>";
	}
	else{		
		// affichage de l'article en question
		echo "<h2>$titreArticle</h2>";		
		if(pg_num_rows($result1) == 0 && pg_num_rows($result2) == 0){
			echo "<h3>L'article $titreArticle ne contient pas de bloc</h3>";
		}
		else{
			$i = 1;
			while($result = pg_fetch_array($result1)) {
				if($i == 1){
					echo "<h3>Bloc d'image</h3>";
				}
				echo '<div class="cleaner_h10"></div>';
				echo "<h3>".$result['titre']."</h3>";
				$cheminFichier = 'images_articles/'.$result['contenu'];
				echo "<figure>";
				echo "<a href='$cheminFichier' target='_blank'><img src='$cheminFichier' alt='image ".$result['titre']." $titreArticle' height='100' width='100' title='cliquez pour agrandir' ></a>";
				echo"</figure>";
				$i++;
			}
			$i = 1;
			while($result = pg_fetch_array($result2)) {
				if($i == 1){
					echo "<h3>Bloc de textes</h3>";
				}
				echo '<div class="cleaner_h10"></div>';
				echo "<h3>".$result['titre']."</h3>";
				echo "<p>".$result['contenu']."</p>";
				$i++;
			}	
		}			
	}
?>