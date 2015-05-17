<?php
//On inclut le modèle
include(dirname(__FILE__).'/../modeles/m_session.php');

// si on est déjà connecté
if (isConnect($_SESSION)){
	header("Location:index.php");
}

$bAuth=false;
if ( ! empty( $_POST["action"])){
	$bAuth=true; // on est en phase authentification
}
//test validité de la date
if ($bAuth)
{
	$date=explode("-", $_POST["date_naissance"]);
	$bOk = checkdate($date[1],$date[2],$date[0]);
	// traitement message erreur
	if (!$bOk)
	{
		$erreur="la date entrée n'est pas valide.";
	}
	$bAuth=$bOk;
}
if ($bAuth)
{
	$bOk = auth($connexion,$_POST["pseudo"],$_POST["date_naissance"]);
	// traitement message erreur
	if (!$bOk)
	{
		$erreur="authentification échoué.";
	}
	$bAuth=$bOk;
}
if ($bAuth)
{
	// on crée une nouvelle session
	session_destroy();
	session_start();
	$_SESSION['pseudo'] = $_POST["pseudo"];
	$tableauDeStatuts = getStatuts($connexion,$_POST["pseudo"]);
	$_SESSION['lecteur'] = hasStatut($tableauDeStatuts,"lecteur");
	$_SESSION['moderateur'] = hasStatut($tableauDeStatuts,"moderateur");
	$_SESSION['redacteur'] = hasStatut($tableauDeStatuts,"redacteur");
	$_SESSION['editeur'] = hasStatut($tableauDeStatuts,"editeur");
	$_SESSION['administrateur'] = hasStatut($tableauDeStatuts,"administrateur");
}
if (isConnect($_SESSION)){
	//On inclut la vue
	header("Location:index.php");
}
else{
	//On inclut la vue
	include(dirname(__FILE__).'/../vues/v_connexion.php');
}
?>
