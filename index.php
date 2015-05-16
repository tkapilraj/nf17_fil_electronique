<?php
include('modeles/session.php');
session_start();
require('header.php');
?>
<div id="main">
	<div id="content">
		<?php
			include('modeles/connect.php');
			$connexion = connect();
			//On inclut le contrôleur s'il spécifié et s'il existe
			/* $_POST en priorité sur $_GET */
			if (!empty($_POST['action']) && is_file('controleurs/c_'.$_POST['action'].'.php')) {
				include('controleurs/c_'.$_POST['action'].'.php');
			}
			else if (!empty($_GET['action']) && is_file('controleurs/c_'.$_GET['action'].'.php')) {
				include('controleurs/c_'.$_GET['action'].'.php');
			}
			else {
				include('controleurs/c_honneur.php');
			}
			pg_close($connexion);
		?>
	</div>
	<?php require('menu.php'); ?>
</div>
<?php require('footer.html'); ?>
