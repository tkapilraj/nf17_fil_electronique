<?php	
	if (isConnect($_SESSION)  && ($_SESSION['redacteur'] || $_SESSION['editeur'])  ){ 
		// afin d'etre sur que la personne cherchant à accèder à la page est connectée est qu'elle est soit un rédacteur, soit un éditeur
		if(!empty($_GET["action"]) && $_GET["action"] == "modifier_article" && !empty($_POST["titre"])){
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
						// echo "modifier_bloc_texte";// ->test
						// ini_set('display_errors', TRUE); // -> test
						// error_reporting(-1);//  -> test
						include(dirname(__FILE__).'/../modeles/m_modifier_article.php');
						if(empty($_POST['titre_bloc_texte'])){
							// on doit afficher une liste afin que l'utilisateur puisse choisir le bloc qu'il souhaite modifier 
							$listeBlocsTextes = recupererBlocsArticleTexte($connexion,$titreArticle);
							if($listeBlocsTextes == FALSE){
								$messageEchec = "Nous n'avons pas réussi à générer une liste des blocs de l'article $titreArticle. Veuillez nous en excuser et réessayer.";
							}	
						
						}
						elseif(empty($_POST['new_titre_bloc_texte']) || empty($_POST['new_contenu_bloc_texte']) || empty($_POST['contenu_bloc_texte'])){
							$titreBlocTexte = $_POST['titre_bloc_texte'];
							$blocTexteActuel = recupererBlocTexteActuel($connexion, $titreArticle, $titreBlocTexte);
							if($blocTexteActuel == FALSE){
								$messageEchec = "Nous n'avons pas réussi à vous afficher le bloc texte $titreBlocTexte de l'article $titreArticle. Veuillez nous en excuser et réessayer.";
							}	
						}
						else{
							$oldTitreBlocTexte = $_POST['titre_bloc_texte'];
							$oldContenuBlocTexte = $_POST['contenu_bloc_texte'];
							$newTitreBlocTexte = $_POST['new_titre_bloc_texte'];
							$newContenuBlocTexte = $_POST['new_contenu_bloc_texte'];
							$message = remplacerBlocTexte($connexion, $titreArticle, $oldTitreBlocTexte, $oldContenuBlocTexte, $newTitreBlocTexte, $newContenuBlocTexte);
							if($message == "ok"){
								$messageReussite = "Nous avons bien pris en compte vos modifications du bloc texte $newTitreBlocTexte de l'article $titreArticle";
							}
							else{
								$messageEchec = $message;
							}
						}
						include(dirname(__FILE__).'/../vues/v_modifier_bloc_texte.php');
						break;
					case 'modifier_bloc_image' :
						// ini_set('display_errors', TRUE); // -> test
						// error_reporting(-1);//  -> test
						include(dirname(__FILE__).'/../modeles/m_modifier_article.php');
						// echo "modifier_bloc_image";// -> test
						if(empty($_POST['titre_bloc_image'])){
							// on doit afficher une liste afin que l'utilisateur puisse choisir le bloc qu'il souhaite modifier 
							$listeBlocsImages = recupererBlocsArticleImage($connexion,$titreArticle);
							if($listeBlocsImages == FALSE){
								$messageEchec = "Nous n'avons pas réussi à générer une liste des blocs de l'article $titreArticle. Veuillez nous en excuser et réessayer.";
							}	
						
						}
						elseif(empty($_POST['new_titre_bloc_image']) || !isset($_FILES['new_contenu_bloc_image']) || $_FILES['new_contenu_bloc_image']['error'] > 0){
							$titreBlocImage = $_POST['titre_bloc_image'];
							$blocImageActuel = recupererBlocImageActuel($connexion,$titreArticle,$titreBlocImage);
							if($blocImageActuel == FALSE){
								$messageEchec = "Nous n'avons pas réussi à vous afficher le bloc image $titreBlocImage de l'article $titreArticle. Veuillez nous en excuser et réessayer.";
							}	
						}
						else{
							$maxsize = 10485760; // on autorise une image de taille maximum 10 mo
							$maxwidth = 10000; // largeur maximale
							$maxheight = 10000; // hauteur maximale
							$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp');
							$oldTitreBlocImage = $_POST['titre_bloc_image'];
							$newTitreBlocImage = $_POST['new_titre_bloc_image'];
							$indexNewContenuBlocImage = 'new_contenu_bloc_image';
							$message = remplacerBlocImage($connexion, $titreArticle, $oldTitreBlocImage, $newTitreBlocImage, 
								$indexNewContenuBlocImage,$maxsize,$extensions_valides, $maxwidth, $maxheight);
							if($message == "ok"){
								$messageReussite = "Nous avons bien pris en compte vos modifications du bloc image $newTitreBlocImage de l'article $titreArticle";
							}
							else{
								$messageEchec = $message;
							}
						}
						include(dirname(__FILE__).'/../vues/v_modifier_bloc_image.php');
						break;
					case 'supprimer_bloc' :
						include(dirname(__FILE__).'/../modeles/m_modifier_article.php');
						// echo "supprimer_bloc"; // -> test
						if(empty($_POST['titre_bloc'])){
							$result1 = recupererBlocsArticleTexte($connexion,$titreArticle);
							$result2 = recupererBlocsArticleImage($connexion,$titreArticle);
							if(!$result1 || !$result2){
								$messageEchec = "La requête n'a pas abouti désolé. Veuillez réessayer.";
							}		
							elseif(pg_num_rows($result1) == 0  && pg_num_rows($result2) == 0){
								$messageEchec = "L'article $titreArticle ne contient pas encore de blocs.";
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
