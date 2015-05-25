<?php
	if(empty($messageReussite)){
		if(!empty($editeur) || $fonction ==  'modifier'){
			$action = "index.php?action=modifier_article";
			$fonction ==  'modifier';
		}
		elseif ($fonction == 'soumettre') {
			$action = "index.php?action=soumettre_article";
		}
		else{
			$action = "index.php?action=choisir_article";
		}
		if(pg_num_rows($result)==0 ){
			echo "<h2>Votre ne pouvez $fonction aucun article</h2>";
		}
		else{
			$i = 1;
			while($res = pg_fetch_array($result)) {
					if($i==1){
						echo "<h2>Veuillez sélectionner un article pour le $fonction</h2>";
						echo "<form action = '$action' method='POST'>";
						echo "<p>";
						echo "<input type = 'hidden' name = 'fonction' value='$fonction'>";
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

	}
	else{
		echo "<h2>$messageReussite</h2>";
	}
?>