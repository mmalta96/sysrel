	<?php 
		session_start();
		unset($_SESSION["ID_USUARIO"]);
		unset($_SESSION["TIPO_USUARIO"]);
		session_destroy();

		header("location: index.php");
	?>