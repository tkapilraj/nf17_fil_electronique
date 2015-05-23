<?php
	if(empty($messageReussite) && empty($messageEchec)){
		echo "<h2>Veuillez sélectionner le titre de bloc de l'article que vous souhaitez supprimer</h2>";
		echo "<form action = 'index.php?action=modifier_article' method='POST'>";
		echo "<p>";
		echo "<input type='hidden' name='titre' value ='$titreArticle'>";
		echo "<input type='hidden' name='choix' value ='$choix'>";
		$i = 1;
		while($res = pg_fetch_array($result1)) {
				if($i==1){
					echo "<h3>Liste des blocs texte</h3>";
					echo "<input type = 'radio' name ='titre_bloc' value ='t-".$res['titrebloc']."' id ='t-".$res['titrebloc']."'checked/>";
				}
				else{
					echo "<input type = 'radio' name ='titre_bloc' value ='t-".$res['titrebloc']."' id ='t-".$res['titrebloc']."'/>";
				}
				echo "<label for ='t-".$res['titrebloc']."'>".$res['titrebloc']."</label> <br/>";
				$i++;
		}	
		$i=1;
		while($res = pg_fetch_array($result2)) {
				if($i==1){
					echo "<h3>Liste des blocs image</h3>";
					echo "<input type = 'radio' name ='titre_bloc' value ='i-".$res['titrebloc']."' id ='i-".$res['titrebloc']."'checked/>";
				}
				else{
					echo "<input type = 'radio' name ='titre_bloc' value ='i-".$res['titrebloc']."' id ='i-".$res['titrebloc']."'/>";
				}
				echo "<label for ='i-".$res['titrebloc']."'>".$res['titrebloc']."</label> <br/>";
				$i++;
		}	
		echo "<input type ='submit' value = 'envoyer'>";
		echo "</p>";
		echo "</form>";
	}
	else if (!empty($messageReussite) && empty($messageEchec) ) {
		echo "<h2>$messageReussite</h2>";
	}
	else{
		echo "<h2>$messageEchec</h2>";
	}
?>