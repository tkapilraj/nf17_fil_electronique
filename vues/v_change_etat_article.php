<?php
  if(!empty($result2)){
    echo "<h2>Veuillez sélectionner l'article que vous souhaitez changer état</h2>";
		echo "<form action = 'index.php?action=change_etat_article' method='POST'>";
		echo "<p>";
		$i = 1;
		while($res = pg_fetch_array($result2)) {
				if($i==1){
					echo "<input type = 'radio' name ='titre' value ='".$res['article']."' id ='".$res['article']."'checked/>";
				}
				else{
					echo "<input type = 'radio' name ='titre' value ='".$res['article']."' id ='".$res['article']."'/>";
				}
				echo "<label for ='".$res['article']."'>".$res['article']."</label>  ".$res['etat']."<br/>";
				$i++;
		}	
		echo "<input type ='submit' value = 'envoyer'>";
		echo "</p>";
		echo "</form>";
  }else {
    if(!empty($result1)) {
      echo "<h2>Histoire d'état de l'article $titre</h2>";
      echo "<table>";
      $formatPHP = "d-m-Y H:i:s:u";
      echo "<tr><th>editeur</th><th>état</th><th>date d'édition</th><th>Explication</th></tr>";
      while($res = pg_fetch_array($result1)) {
        echo "<tr><td>$res[editeur]</td><td>$res[etat]</td><td>".$res['_date']."</td><td>$res[explication]</td></tr>";
      }
      echo "</table>";
      echo "</br><h2>Changer état de cet article</h2>";
      echo "<form action='index.php?action=change_etat_article' method='POST'>";
      echo "<p>";
      echo "<input type = 'radio' name='etat' value='en_relecture' id='en_relecture' checked/><label for='en_relecture'>En relecture</label></br>";
      echo "<input type = 'radio' name='etat' value='rejete' id='rejete'/><label for='rejete'>Rejeté</label></br>";
      echo "<input type = 'radio' name='etat' value='valide' id='valide'/><label for='valide'>Validé</label></br>";
      echo "<input type = 'radio' name='etat' value='publie' id='publie'/><label for='publie'>Publié</label></br>";
      echo "<input type = 'radio' name='etat' value='a_reviser' id='a_reviser'/><label for='a_reviser'>à Reviser</label></br>";
      echo "<input type = 'hidden' name='change_etat' id='change_etat' value='$titre'/>";
      echo "explication<input type = 'textbox' name='explication' id='explication'/>";
      echo "<input type = 'submit' value = 'envoyer'/>";
      echo "</p>";
      echo "</form>";
    }else {
      if(!empty($result)) {
        echo "<h2>Changement d'état de l'article $article</h2>";
        if($result!=false){
        echo "<p>changement réussi.</p>";
      }else{
        echo "<p>changement échoué</p>";
      }
        echo "<a href='index.php?action=change_etat_article'>Retour</a>";
      }
    }
  }
?>
