<div id="sidebar">
    <h2>Menu</h2>
    <ul class="list">
        <?php
        if (isConnect($_SESSION)){
        ?>
        Connecté en tant que :</br> <strong><?php print $_SESSION["pseudo"]?></strong>
        (<a href="index.php?action=deconnexion">déconnexion</a>)            
                <?php 
                    if (isLecteur($_SESSION)) {
                ?>
                    <li><a href="#">Commentaires</a></li>
                    <li><a href="#">Recherches</a></li>
                <?php
                    }
                    if (isRedacteur($_SESSION)) {
                ?>
                    <li><a href="#">Créer un article</a></li>
                    <li><a href="#">Restaurer un article supprimé</a></li>
                    <li><a href="#">Supprimer un article</a></li>
                    <li><a href="#">Soumettre un article</a></li>
                    <li><a href="#">Consulter un de mes articles</a></li>
                    <li><a href="#">Modifier un article</a></li>
                <?php 
                    }
                    if (isEditeur($_SESSION)){
                ?>
                    <li><a href="#">Consulter les articles soumis</a></li>
                    <li><a href="#">Changer l'état des articles</a></li>
                    <li><a href="#">Indexer des articles</a></li>
                    <li><a href="#">Modifier des articles</a></li>
                    <li><a href="#">Classifier des articles</a></li>
                    <li><a href="#">Lier des articles</a></li>
                    <li><a href="#">Créer des rubriques</a></li>
                <?php 
                    }
                    if (isModerateur($_SESSION)) {
                ?>
                    <li><a href="#">Consulter tous les commentaires</a></li>
                    <li><a href="#">Modérer les commentaires</a></li>
                <?php 
                    }
                    if (isAdministrateur($_SESSION)) {
                ?>                
                    <li><a href="#">Gérer les comptes</a></li>
                    <li><a href="#">Historique</a></li>
                <?php 
                    }
                ?>
                <li><a href="index.php?action=deconnexion">Déconnexion</a></li>  
        <?php 
        }
        else{
        ?>           
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?action=rubriques">Rubriques</a></li>
            <li><a href="index.php?action=recherche">Recherche</a></li>
            <li><a href="index.php?action=connexion">Connexion</a></li>
            <li><a href="index.php?action=inscription">Inscription</a></li>      
        <?php
        }
        ?>
    </ul>

</div>
<div class="cleaner"></div>