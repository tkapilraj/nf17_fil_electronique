<a href="" onClick="javascript:window.history.go(-1)">Retour</a>
<div class="cleaner_h30"></div>

<?php
	echo "<h2>$article</h2>";

    // affichage des articles lies
    echo "<i>Article(s) lié(s) : ";
    if(pg_num_rows($result_articles_lies)<=0)
        echo "aucun";
    else {
        while ($res = pg_fetch_array($result_articles_lies)) {
            echo $res["article2"];
            echo ", ";
        }
    }
    echo "</i><br><br>";
	
	echo '<div class="cleaner_h30 horizon_divider"></div><div class="cleaner_h30"></div>';
	
	if(pg_num_rows($result1) == 0 && pg_num_rows($result2) == 0){
		echo "<h3>L'article $article n'a aucun contenu</h3>";
	}
	else{
		while($result = pg_fetch_array($result1)) {
			echo '<div class="cleaner_h10"></div>';
			echo "<h3>".$result['titre']."</h3>";
			$cheminFichier = 'images_articles/'.$result['contenu'];
			echo "<figure>";
			echo "<a href='$cheminFichier' target='_blank'><img src='$cheminFichier' alt='image ".$result['titre']." $article' height='100' width='100' title='cliquez pour agrandir' ></a>";
			echo"</figure>";
		}
		if(pg_num_rows($result1) != 0) {
			echo '<div class="cleaner_h30 horizon_divider"></div><div class="cleaner_h30"></div>';
		}
		while($result = pg_fetch_array($result2)) {
			echo '<div class="cleaner_h10"></div>';
			echo "<h3>".$result['titre']."</h3>";
			echo "<p>".$result['contenu']."</p>";
		}	
	}	
?>