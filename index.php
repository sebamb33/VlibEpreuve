<?php
@session_start();
    require_once 'lib/autoLoader.php';
	require_once 'lib/dispatcher.php';
	require_once 'modele/DAO/param.php';
	require_once 'modele/DAO/accesDonnes.php';


?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Vlib</title>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Varela+Round:ital,wght@1,300&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" href="styles/style.css">

	</head>
	<body >
		<?php
			require_once 'controleurs/controleurPrincipal.php';	
		?>
	</body>
</html>
