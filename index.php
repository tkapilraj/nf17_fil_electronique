<?php require('header.html'); ?>
<div id="main">
	<div id="content">
		<?php
			session_start();
			include('modeles/connect.php');
			$connexion = connect();
			//On inclut le contrôleur s'il spécifié et s'il existe
			if (!empty($_GET['action']) && is_file('controleurs/c_'.$_GET['action'].'.php')) {
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
	