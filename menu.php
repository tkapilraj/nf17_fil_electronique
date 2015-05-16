<div id="sidebar">
    <h2>Menu</h2>
    <?php
    if (isConnect($_SESSION)){
    ?>
    connecté en tant que :</br> <strong><?php print $_SESSION["pseudo"]?></strong>
    (<a href="index.php?action=deconnexion">déconnexion</a>)
    <?php
    }
    ?>
    <ul class="list">
		<li><a href="#">Créer un article</a></li>
		<li><a href="#">Modifier un article</a></li>
		<li><a href="#">Consulter l'état des articles</a></li>
		<li><a href="#">Soumettre un article</a></li>
    </ul>
</div>
<div class="cleaner"></div>
