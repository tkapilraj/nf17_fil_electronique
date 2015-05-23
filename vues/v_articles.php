<?php 
	echo "<h2>$article</h2>";      
	
	while($result = pg_fetch_array($textes)) {
		echo '<div class="cleaner_h10"></div>';
		echo "<h3>$result[titre]</h3>";
		echo "<p>$result[contenu]</p>";
	}			
?>