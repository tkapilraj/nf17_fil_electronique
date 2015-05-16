<?php
	$i=0;
	while($result = pg_fetch_array($articles)) {
		if(($i % 2) == 0) {
			echo '<div class="cleaner_h30 horizon_divider"></div><div class="cleaner_h30"></div>';
			echo '<div class="col_w270 float_l">';
		} else {
			echo '<div class="col_w270 float_r">';
		}
		echo "<h3>".$result['titre']."</h3>";
		echo "<p>".$result['texte']."</p>";
		echo '<div class="button float_r"><a href="index.php?action=articles&param='.$result['titre'].'">Plus</a></div></div>';
		$i++;
	}			
?>