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
                    <li><a href="index.php?action=creer_article">Créer un article</a></li>
                    <li><a href="index.php?action=choisir_article&fonction=restaurer">Restaurer un article supprimé</a></li>
                    <li><a href="index.php?action=choisir_article&fonction=supprimer">Supprimer un article</a></li>
                    <li><a href="index.php?action=choisir_article&fonction=soumettre">Soumettre un article</a></li>
                    <li><a href="index.php?action=consulter_article">Consulter un article</a></li>
                    <li><a href="index.php?action=choisir_article&fonction=modifier">Modifier un article</a></li>
                <?php
                    }
                    if (isEditeur($_SESSION)){
                ?>
                    <li><a href="#">Consulter les articles soumis</a></li>
                    <li><a href="#">Changer l'état des articles</a></li>
                    <li><a href="#">Indexer des articles</a></li>
                    <li><a href="index.php?action=ed_modifier_article">Modifier un article</a></li>
                    <li><a href="index.php?action=assoc_rub_article">Classifier des articles</a></li>
                    <li><a href="index.php?action=ajouter_lien">Lier des articles</a></li>
                    <li><a href="index.php?action=creer_rubrique">Créer des rubriques</a></li>
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
