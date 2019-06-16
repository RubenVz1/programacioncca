<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Home</title>
	<link rel="stylesheet" href="styles/homeStylo.css">
</head>
<body>

	<header>
		<?php echo "<p>Bienvenido ".$user->getNombre()."</p>"?>
		<a id = "boton"href="includes/logout.php">Cerrar sesion</a>
	</header>
	<div id="ventana">
		<div id="cabecera">
			<p>Menu</p>
		</div>
		<ul id="menu">
			<li><a href="">Calendario</a></li>
			<li><a href="">Nueva actividad</a></li>
		</ul>
	</div>
</body>
</html>