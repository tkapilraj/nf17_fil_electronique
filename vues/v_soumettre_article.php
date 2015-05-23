<?php
	if(empty($messageReussite)){
		$action = "index.php?action=soumettre_article";
		echo "<h2>Veuillez sélectionner le comité éditorial auquel vous souhaitez soumettre l'article $titreArticle</h2>";
		echo "<form action = '$action' method='POST'>";
		echo "<p>";
		echo "<input type = 'hidden' name = 'titre' value='$titreArticle'>";
		$i = 1;
		while($res = pg_fetch_array($result)) {
				if($i==1){
					echo "<input type = 'radio' name ='comite_editorial' value ='".$res['nom']."' id ='".$res['nom']."'checked/>";
				}
				else{
					echo "<input type = 'radio' name ='comite_editorial' value ='".$res['nom']."' id ='".$res['nom']."'/>";
				}
				echo "<label for ='".$res['nom']."'>".$res['nom']."</label> <br/>";
				$i++;
		}	
		echo "<input type ='submit' value = 'envoyer'>";
		echo "</p>";
		echo "</form>";
	}
	else{
		echo "<h2>$messageReussite</h2>";
	}
?>