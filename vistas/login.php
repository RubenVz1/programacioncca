<!DOCTYPE html>
<html lang = "es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Inicio de sesion</title>
		<link rel="stylesheet" href="styles/indexStylo.css">
	</head>
	<body>
		<?php 
			if(isset($errorLogin))
			{
				echo $errorLogin;
			}
		?>
		<div id="inicioSesion">
			<section id="cabecera">
				<h1>Iniciar sesion</h1>
			</section>
			<section id="cuerpo">
				<form action="index.php" method="post">
					<p>Usuario: </p><input type="text" name="username" value="Usuario"><br>
					<p>Contraseña: </p><input type="password" name="password" value="Contraseña"><br>
					<input id = "boton"type="submit" value="Iniciar sesion">
				</form>
			</section>
		</div>
	</body>
</html>