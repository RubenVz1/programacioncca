<?php
	include_once '../includes/user.php';
    include_once '../includes/user_session.php';
    $userSession = new UserSession();
    $user = new User();

	if(isset($_SESSION['user']))
    {
        $user->setUser($userSession->getCurrentUser());
    }
?>
<!DOCTYPE html>
<html lang = "es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Fase 1</title>
		<link rel="stylesheet" href="../styles/Fase1Stylo.css">
	</head>
	<body>
		<div id="inicioSesion">
			<section id="cabecera">
				<h1>Fase 1 (Parte I)</h1>
			</section>
			<section id="cuerpo">
				<form action="">
					<p>Fecha de programacion:</p><input type="text" name="usuario" value="dd/mm/aaaa"><p> Calendario</p><br>
					<p>Fecha del evento: </p><input type="text" name="usuario" value="dd/mm/aaaa"><p> Calendario</p><br>
					<p>Nombre de la compañia: </p><input type="text" name="usuario" value="Nombre"><br>
					<p>Nombre de la actividad: </p><input type="text" name="usuario" value="Nombre"><br>
					<p>Duracion: </p><input type="text" name="usuario" value="hh-mm"><br>
					<p>Lugar: </p><input type="text" name="usuario" value="Nombre"><br>
					<p>Horario: </p><input type="text" name="usuario" value="Contraseña"><br>
					<p>Tipo de entrada:</p>
					<p>libre</p><input type="checkbox" name="vehicle1" value="Bike">
					<p>cortesia</p><input type="checkbox" name="vehicle1" value="Bike">
					<p>costo</p><input type="checkbox" name="vehicle1" value="Bike"><br>
					<p>Costo: </p><input type="text" name="usuario" value="$"><br>
					<p>Disciplina: </p><input type="text" name="usuario" value="Nombre"><br>
					<p>Observaciones: </p><br>
					<textarea name="message" rows="5" cols="30">Observaciones...</textarea><br>
					<input id = "boton"type="submit" value="Continuar">
				</form>
			</section>
		</div>
	</body>
</html>


