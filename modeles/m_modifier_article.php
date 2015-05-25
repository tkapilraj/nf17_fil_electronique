<?php


	function uploadAndSave($connexion,$titreArticle,$titre_bloc_image,$index,$maxsize=FALSE,$extensions=FALSE, $maxwidth=FALSE, $maxheight=FALSE)
	{
		//Test1: fichier correctement uploadé
	    if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) 
	     	return "erreur lors du transfert";
	 	//Test2: taille limite
	    if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) 
	    	return "le fichier est trop gros";
		//Test3: extension
	    $ext = strtolower(  substr(  strrchr($_FILES[$index]['name'], '.')  ,1)  );
	    if ($extensions !== FALSE AND !in_array($ext,$extensions)) 
	     	return "extension non valide";
		$image_sizes = getimagesize($_FILES[$index]['tmp_name']);
		if ( ($maxwidth !== FALSE && $image_sizes[0] > $maxwidth) OR ($maxheight !== FALSE && $image_sizes[1] > $maxheight) ){
			// echo "largeur : $image_sizes[0], $maxwidth"; // -> test
			// echo "<br/>"; // -> test
			// echo "hauteur : $image_sizes[1], $maxheight"; // -> test 
			return "image trop grande";
		}
		//Déplacement
		$formatPHP = "Y_m_d_H_i_s";
		$date = date($formatPHP);
		$nomFichier = $date.'.'.$ext;
		$nom = $_SERVER["DOCUMENT_ROOT"] .'/nf17_fil_electronique/images_articles/'.$nomFichier;

		// ini_set('display_errors', TRUE); -> test
		// error_reporting(-1); -> test
		$resultat = move_uploaded_file($_FILES[$index]['tmp_name'],$nom);
		if (!$resultat){
			return "echec de copie de l'image";
		}	
		$requete = "INSERT INTO image(titreBloc, titreArticle, contenu_img) 
		VALUES('$titre_bloc_image', '$titreArticle', '$nomFichier');";
		// echo "$requete"; -> test
		$query = pg_query($connexion, $requete); 
		if (!$query){
			return "votre titre de bloc image $titre_bloc_image existe déjà";
		}
    	return  "ok";
	}

	function ajouterBlocTexte($connexion,$titreArticle,$titre_bloc_texte, $contenu_bloc_texte){
		$titreArticle = pg_escape_string($titreArticle);
		$titre_bloc_texte = pg_escape_string($titre_bloc_texte);
		$contenu_bloc_texte = pg_escape_string($contenu_bloc_texte);
		$texte = "text";
		$requete = "INSERT INTO $texte(titreBloc, titreArticle, contenu_txt)
		VALUES('$titre_bloc_texte','$titreArticle', '$contenu_bloc_texte');";
		// echo "$requete"; -> test
		$query = pg_query($connexion, $requete);
		if (!$query){
			return "votre titre de bloc texte $titre_bloc_texte ou votre contenu de bloc texte existe déjà";
		}
    	return  "ok";
	}

	function recupererBlocsArticleTexte($connexion,$titreArticle){
		$titreArticle = pg_escape_string($titreArticle);
		$texte = "text";
		$requete = "SELECT titreBloc FROM $texte WHERE titreArticle = '$titreArticle';";
  		// echo "$requete"; -> test
		$query = pg_query($connexion, $requete);
		return $query;
	}

	function recupererBlocsArticleImage($connexion,$titreArticle){
		$titreArticle = pg_escape_string($titreArticle);
		$requete = "SELECT titreBloc FROM image WHERE titreArticle = '$titreArticle';";
  		// echo "$requete"; -> test
		$query = pg_query($connexion, $requete);
		return $query;
	}

	function supprimerBlocArticleTexte($connexion, $titreArticle, $titreBloc){
		$titreArticle = pg_escape_string($titreArticle);
		$titreBloc = pg_escape_string($titreBloc);
		$text = "text";
		$requete = "DELETE FROM $text 
		WHERE titreArticle = '$titreArticle' AND titreBloc = '$titreBloc';";
		// echo "$requete"; -> test
		$query = pg_query($connexion,$requete);
		return $query;
	}

	function supprimerBlocArticleImage($connexion, $titreArticle, $titreBloc){
		$titreArticle = pg_escape_string($titreArticle);
		$titreBloc = pg_escape_string($titreBloc);
		$requete1 = "SELECT contenu_img 
		FROM image
		WHERE titreArticle = '$titreArticle' AND titreBloc = '$titreBloc';";
		// echo "$requete1 <br/>"; // -> test
		$result = pg_query($connexion,$requete1);
		if(pg_num_rows($result) == 1){
			// echo "bonjour <br/>";
			$res = pg_fetch_array ($result);
			$nomFichier = $_SERVER["DOCUMENT_ROOT"] .'/nf17_fil_electronique/images_articles/'.$res['contenu_img'];
			// echo "$nomFichier <br/>"; // -> test
			// on efface le fichier
			// ini_set('display_errors', TRUE); // -> test
			// error_reporting(-1); // -> test
			$bool = unlink($nomFichier);
			if(!$bool){
				return FALSE;
			}
		}
		else{
			return FALSE;
		}
		$requete2 = "DELETE FROM image
		WHERE titreArticle = '$titreArticle' AND titreBloc = '$titreBloc';";
		// echo "$requete <br/>"; // -> test
		$result = pg_query($connexion,$requete2);
		return $result;
	}

	function recupererBlocImageActuel($connexion,$titreArticle,$titreBlocImage){
		$titreArticle = pg_escape_string($titreArticle);
		$titreBlocImage = pg_escape_string($titreBlocImage); 
		$requete = "SELECT contenu_img 
		FROM image
		WHERE titreBloc = '$titreBlocImage'
		AND titreArticle = '$titreArticle';";
		$result = pg_query($connexion, $requete);
		return $result;
	}

	function presenceTitreBlocImage($connexion,$titreArticle,$titreBlocImage){
		$titreArticle = pg_escape_string($titreArticle);
		$titreBlocImage = pg_escape_string($titreBlocImage); 
		$requete = "SELECT * 
		FROM image
		WHERE titreBloc = '$titreBlocImage'
		AND titreArticle = '$titreArticle';";
		$result = pg_query($connexion, $requete);
		if ($result == FALSE || pg_num_rows($result) > 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function presenceTitreBlocTexte($connexion,$titreArticle,$newTitreBlocTexte){
		$titreArticle = pg_escape_string($titreArticle);
		$newTitreBlocTexte = pg_escape_string($newTitreBlocTexte); 
		$text = "text";
		$requete = "SELECT * 
		FROM $text
		WHERE titreBloc = '$newTitreBlocTexte'
		AND titreArticle = '$titreArticle';";
		$result = pg_query($connexion, $requete);
		if ($result == FALSE || pg_num_rows($result) > 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function presenceContenuBlocTexte($connexion, $newContenuBlocTexte){
		$newContenuBlocTexte = pg_escape_string($newContenuBlocTexte); 
		$text = "text";
		$requete = "SELECT * 
		FROM $text
		WHERE contenu_txt = '$newContenuBlocTexte';";
		$result = pg_query($connexion, $requete);
		if ($result == FALSE || pg_num_rows($result) > 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function remplacerBlocImage($connexion, $titreArticle, $oldTitreBlocImage, $newTitreBlocImage, 
		$indexNewContenuBlocImage,$maxsize,$extensions, $maxwidth, $maxheight){
		if($oldTitreBlocImage != $newTitreBlocImage){
			if(presenceTitreBlocImage($connexion,$titreArticle,$newTitreBlocImage)){
				return "Le titre du bloc image $newTitreBlocImage existe déjà dans l'article $titreArticle. Veuillez en choisir un autre.";
			}			
		}
		if(!supprimerBlocArticleImage($connexion, $titreArticle, $oldTitreBlocImage)){
			return "Veuillez nous excuser, la modification de l'article a échoué. Veuillez réessayer.";
		}
		return uploadAndSave($connexion,$titreArticle,$newTitreBlocImage,$indexNewContenuBlocImage,$maxsize, $extensions, $maxwidth, $maxheight);
	}

	function recupererBlocTexteActuel($connexion, $titreArticle, $titreBlocTexte){
		$titreArticle = pg_escape_string($titreArticle);
		$titreBlocTexte = pg_escape_string($titreBlocTexte);
		$text = "text"; 
		$requete = "SELECT contenu_txt 
		FROM $text
		WHERE titreBloc = '$titreBlocTexte'
		AND titreArticle = '$titreArticle';";
		$result = pg_query($connexion, $requete);
		return $result;
	}

	function remplacerBlocTexte($connexion, $titreArticle, $oldTitreBlocTexte, $oldContenuBlocTexte, $newTitreBlocTexte, $newContenuBlocTexte){
		$titreArticle = pg_escape_string($titreArticle);
		$oldTitreBlocTexte = pg_escape_string($oldTitreBlocTexte);
		$oldContenuBlocTexte = pg_escape_string($oldContenuBlocTexte);
		$newTitreBlocTexte = pg_escape_string($newTitreBlocTexte);
		$newContenuBlocTexte = pg_escape_string($newContenuBlocTexte);
		if( ($oldTitreBlocTexte == $newTitreBlocTexte) && ($oldContenuBlocTexte == $newContenuBlocTexte) ){
			return "ok";
		}
		if( ($oldTitreBlocTexte != $newTitreBlocTexte) ){
			if(presenceTitreBlocTexte($connexion,$titreArticle,$newTitreBlocTexte)){
				return "Le titre du bloc texte $newTitreBlocTexte existe déjà dans l'article $titreArticle. Veuillez en choisir un autre.";
			}		
		}
		if( $oldContenuBlocTexte != $newContenuBlocTexte ){
			if(presenceContenuBlocTexte($connexion,$titreArticle,$newContenuBlocTexte)){
				return "Le contenu du bloc texte $newTitreBlocTexte existe déjà dans l'article $titreArticle. Veuillez en choisir un autre.";
			}	
		}
		if(!supprimerBlocArticleTexte($connexion, $titreArticle, $oldTitreBlocTexte)){
			return "Veuillez nous excuser, la modification de l'article a échoué. Veuillez réessayer.";
		}
		return ajouterBlocTexte($connexion,$titreArticle,$newTitreBlocTexte, $newContenuBlocTexte);
	}
?>
