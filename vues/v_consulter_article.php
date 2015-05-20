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
		while($result = pg_fetch_array($result1)) {
			echo '<div class="cleaner_h10"></div>';
			echo "<h3>".$result['titre']."</h3>";
			echo "<p>".$result['contenu']."</p>";
		}
		while($result = pg_fetch_array($result2)) {
			echo '<div class="cleaner_h10"></div>';
			echo "<h3>".$result['titre']."</h3>";
			echo "<p>".$result['contenu']."</p>";
		}				
	}
?>