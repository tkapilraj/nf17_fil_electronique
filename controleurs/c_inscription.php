<?php
//On inclut le modèle
include_once(dirname(__FILE__).'/../modeles/m_session.php');
include_once(dirname(__FILE__).'/../modeles/m_compte.php');

// si on est déjà connecté
if (isConnect($_SESSION)){
	header("Location:index.php");
}

/* on vérifie si on arrive d'un formulaire post */
$bInscription=false;
if ( ! empty( $_POST["action"])){
	$bInscription=true; // on est en phase inscription

	//normalement les champs insérés ne peuvent pas être vide
	assert('! empty($_POST["pseudo"]);');
	assert('! empty($_POST["nom"]);');
	assert('! empty($_POST["prenom"]);');
	assert('! empty($_POST["statuts"]);');
	assert('! empty($_POST["date_naissance"]);');
	assert('! empty($_POST["statuts"]);');

	// ils doivent aussi vérifier certaines conditions :
	assert('strlen($_POST["pseudo"])<=32;');
	assert('strlen($_POST["nom"])<=64;');
	assert('strlen($_POST["prenom"])<=64;');
	assert('preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$_POST["date_naissance"])');
	$allStatuts=getAllStatuts($connexion);
	foreach ($_POST["statuts"] as $s){
		assert('in_array($s,$allStatuts); // le statut n\'est pas valide.');
	}

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
		$message = "Inscription échouée.Veuillez réessayer puis contacter l'administrateur.";
	}
}
include(dirname(__FILE__).'/../vues/v_inscription.php');
?>
