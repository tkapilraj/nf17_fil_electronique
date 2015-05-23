<?php
	if(isset($mere)) {
		echo "<h2>Rubrique <em>$mere</em></h2>";
		echo "Ensemble des articles et sous rubriques de <em>$mere</em>";
	}else {
		echo "<h2>Rubriques</h2><p>Ensemble des rubriques du journal.</p>";
	}
?>
<ul class="list">            
	<?php
		$i=0;
		while($result = pg_fetch_array($rubriques)) {
			if(($i % 2) == 0) {
				echo '<div class="cleaner_h30 horizon_divider"></div><div class="cleaner_h30"></div>';
				echo '<div class="col_w270 float_l">';
			} else {
				echo '<div class="col_w270 float_r">';
			}
			echo "<li><a href='index.php?action=rubriques&param=".$result['nom']."'><em>".$result['nom']."</em></a></li>";
			echo "</div>";
			$i++;
		}			
	?>
</ul>