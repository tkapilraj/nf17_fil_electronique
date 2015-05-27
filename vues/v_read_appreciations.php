<div class="cleaner_h30 horizon_divider"></div>
<div class="cleaner_h30"></div>
<div class="cleaner_h30"></div>
<h4>Commentaires</h4>
<?php
	while($result = pg_fetch_array($appreciations)) {
		echo "<h5>Par <em>".$result['lecteur']."</em> le ".$result['date']."</h5>";
		echo "<h6>".$result['titre']."</h6>";
		echo "<p>Note : ".$result['note']."</p>";
		echo "<p>".$result['texte']."</p>";
		echo '<div class="cleaner_h10 horizon_divider"></div><div class="cleaner_h10"></div>';
	}
?>