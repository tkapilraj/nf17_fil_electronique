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
?>
