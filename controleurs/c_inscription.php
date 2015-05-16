<?php
//On inclut le modèle
include(dirname(__FILE__).'/../modeles/m_compte.php');
/* TODO : déterminer quoi faire si déjà connecter
 * - Retour page
 * - Accepter l'inscription d'autre utilisateurs ?
 * ? */
/* on vérifie si on arrive d'un formulaire post */
$bInscription=false;
if ( ! empty( $_POST["action"])){
	$bInscription=true; // on est en phase inscription
}

//test validité de la date
if ($bInscription)
{
	$date=explode("-", $_POST["date_naissance"]);
	$bOk = checkdate($date[1],$date[2],$date[0]);
	// traitement message erreur
	if (!$bOk)
	{
		$erreur="la date entrée n'est pas valide.";
	}
	$bInscription=$bOk;
}
// test existence compte
if ($bInscription)
{
	$bOk = ! hasCompte($connexion,$_POST["pseudo"]);
	if (! $bOk){
		$erreur = "Le compte ".$_POST["pseudo"]." existe déjà,
		veuillez choisir un autre pseudonyme";
	}
	$bInscription=$bOk;
}

//inscription
if ($bInscription)
{
	$bOk =inscrire($connexion,$_POST["pseudo"],$_POST["nom"],
	$_POST["prenom"],$_POST["date_naissance"],$_POST["statuts"]);
	if ($bOk){
		$message = "Inscription effectuée.";
	}
	else{
		$message = "Inscription échoué";
	}
}
include(dirname(__FILE__).'/../vues/v_inscription.php');
?>
