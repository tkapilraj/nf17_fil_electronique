<?php	
	if (isConnect($_SESSION)  && $_SESSION['redacteur'] ){ 
		// afin d'etre sur que la personne cherchant à accèder à la page est connectée est qu'elle est un rédacteur
		if(!empty($_GET["action"]) && $_GET["action"] == "modifier_article" && !empty($_POST["titre"]) ){
			//&& ( 
			//	()
			//	||()
			//	||()
			//	){
			$pseudo = pg_escape_string($_SESSION['pseudo']);
			$titreArticle = $_POST['titre'];
			if(empty($_POST['choix'])){
				// l'utilisateur n'a pas encore fait son choix
				include(dirname(__FILE__).'/../vues/v_modifier_article.php');
			}
			else{				
				// l'utilisateur vient d'effectuer son choix d'action				
				$choix = $_POST["choix"];
				$result  = 0;
				switch($choix){
					case 'modifier_bloc_texte' :
						// $result = recupArticleRestaurables($connexion);
						echo "modifier_bloc_texte";// ->test
						break;
					case 'modifier_bloc_image' :
						// $result = recupArticlesSupprimables($connexion);
						echo "modifier_bloc_image";// -> test
						break;
					case 'supprimer_bloc' :
						include(dirname(__FILE__).'/../modeles/m_modifier_article.php');
						// echo "supprimer_bloc"; // -> test
						if(empty($_POST['titre_bloc'])){
							$result1 = recupererBlocsArticleTexte($connexion,$titreArticle);
							$result2 = recupererBlocsArticleImage($connexion,$titreArticle);
							if(!result1 && !result2){
								$messageEchec = "La requête n'a pas abouti désolé. Veuillez réessayer.";
							}		
						}
						else{
							$titreBloc = $_POST['titre_bloc'];
							$firstCaracter = $titreBloc[0];
							$titreBloc = substr(  strstr($titreBloc, '-')  ,1);					
							if($firstCaracter == 't'){
								// c'est un bloc texte
								$result = supprimerBlocArticleTexte($connexion, $titreArticle, $titreBloc);

							}else{
								// c'est un bloc image
								$result = supprimerBlocArticleImage($connexion, $titreArticle, $titreBloc);
								
							}
							if($result == FALSE){
								$messageEchec = "Désolé, nous n'avons pas réussi à supprimer le bloc $titreBloc de l'article $titreArticle. Veuillez réessayer.";
							}
							else{
								$messageReussite = "Le bloc $titreBloc de votre article $titreArticle a été supprimé avec succès.";
							}
						}
						include(dirname(__FILE__).'/../vues/v_supprimer_bloc.php');				
						break;
					case 'ajouter_bloc_image' :
						// $result = recupArticlesModifiables($connexion);
						if(!empty($_POST['choix']) && !empty($_POST['titre_bloc_image']) && isset($_FILES['contenu_bloc_image']) ){
							include(dirname(__FILE__).'/../modeles/m_modifier_article.php');
							$choix = $_POST['choix'];
							$titre_bloc_image = $_POST['titre_bloc_image'];
							$maxsize = 10485760; // on autorise une image de taille maximum 10 mo
							$maxwidth = 10000; // largeur maximale
							$maxheight = 10000; // hauteur maximale
							$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp');
							$mess= uploadAndSave($connexion,$titreArticle,$titre_bloc_image,'contenu_bloc_image',$maxsize,$extensions_valides, $maxwidth, $maxheight);
							if($mess == 'ok'){
								$message = "Votre bloc image $titre_bloc_image a bien été ajouté à l'article $titreArticle";
							}
							else{
								$message = "Votre bloc image $titre_bloc_image n'a pas été ajouté à l'article $titreArticle : $mess";
							}
						}
						include(dirname(__FILE__).'/../vues/v_ajouter_bloc_image.php');
						break;

					case 'ajouter_bloc_texte' :
						if(!empty($_POST['choix']) && !empty($_POST['titre_bloc_texte']) && !empty($_POST['contenu_bloc_texte'])){
							// l'utilisateur vient de saisir son nouveau bloc de texte
							include(dirname(__FILE__).'/../modeles/m_modifier_article.php');
							$titre_bloc_texte = $_POST['titre_bloc_texte'];
							$contenu_bloc_texte = $_POST['contenu_bloc_texte'];
							$mess= ajouterBlocTexte($connexion,$titreArticle,$titre_bloc_texte, $contenu_bloc_texte);
							if($mess == 'ok'){
								$message = "Votre bloc texte $titre_bloc_texte a bien été ajouté à l'article $titreArticle";
							}
							else{
								$message = "Votre bloc texte $titre_bloc_texte n'a pas été ajouté à l'article $titreArticle : $mess";
							}
						}
						include(dirname(__FILE__).'/../vues/v_ajouter_bloc_texte.php');
						// echo "ajouter_bloc_image"; -> test
				}				
			}
		}
		else{
			// redirection vers l'index
			header('Location: index.php'); 
		}
	}
	else{
		// redirection vers l'index
		header('Location: index.php'); 
	}
?>
