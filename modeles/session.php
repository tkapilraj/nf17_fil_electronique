<?php
	/* fonction pour s'avoir si un utilisateur est connecter
	 * true si connecté.
	 * false si non connecté.
	 */
	function isConnect($session)
	{
		$ret = ! empty($session["pseudo"]);
		return $ret;
	}
	/* fonction pour déconnecter un utilisateur
	 * et le renvoyer à l'accueil.
	 */
	function deconnect()
	{
		session_destroy();
		header("Location:index.php");
		return;
	}
	function isLecteur($session){		
		return $session["lecteur"];
	}
	function isRedacteur($session){
		return $session["redacteur"];
	}
	function isEditeur($session){
		return $session["editeur"];
	}
	function isModerateur($session){
		return $session["moderateur"];
	}
	function isAdministrateur($session){
		return $session["administrateur"];
	}
?>
