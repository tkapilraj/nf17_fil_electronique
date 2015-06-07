<h2>Association Article-Rubriques</h2>
<?php
if (! empty($erreur)){
	print "<h3 class=\"erreur\">$erreur</h3>";
}
if (! empty($message)){
	print "<h3 class=\"message\">$message</h3>";
}
if (empty($articles)){
	print "<h3 class=\"message\">Pas d'articles à associer à des rubriques.</h3>";
}
elseif(empty($rubriques)){
	print "<h3 class=\"message\">Pas de rubriques à associable à un article.</h3>";
}
else{
?>
<form method="post" action="index.php">
	Ici vous pouvez associé des articles à des rubriques.
	<input type="hidden" name="action" value="assoc_rub_article">
	<table>
		<tr>
			<th>
			article
			</th>
			<th>
			rubriques associés
			</th>
		</tr>
		<tr>
			<td>
				<select name="article" >
					<?php
						foreach ($articles as $article)
						{
							print "<option value=\"$article\">
							$article
							</option>";
						}
					?>
				</select>
			</td>
			<td>
				<select name="rubriques[]" multiple >
					<?php
						$selected=true;
						foreach ($rubriques as $rubrique)
						{
							print "<option value=\"$rubrique\"";
							if ($selected){
								print " selected ";
								$selected=false;
							}
							print ">".$rubrique."</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td><input type=submit></td>
		</tr>
	</table>
</form>
<?php
}
?>
