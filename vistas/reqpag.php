<?php
	include_once '../includes/user.php';
    include_once '../includes/user_session.php';
    $userSession = new UserSession();
    $user = new User();
	if(isset($_SESSION['user']))
    {
        $user->setUser($userSession->getCurrentUser());
    }
    else
    {
        include_once 'vistas/login.php';
    }
    if($user->getCargo()!="Administrador")
    {
    	header("location: calendar.php");
    }
?>
<!DOCTYPE html>
<html lang = "es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Fase 1</title>

		<link rel="stylesheet" href="../styles/Fase1c.css">
		<link href="../img/icon.ico" type="image/ico" rel="shortcut icon">
		<script src="../js/jquery.min.js"></script>
		<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="../styles/Fase1Stylo.css">
		<link href="../img/icon.ico" type="image/ico" rel="shortcut icon">
	</head>
	<body>
		<script></script>
		<div id="inicioSesion">
			<section id="cabecera">
					<h1 id="h1pag">Requerimientos para pagos</h1>
			</section>
			<section id="cuerpo">
			<div id="reqpag">
				<p>Requerimientos</p><br><textarea name="message" rows="5" cols="30"></textarea><br>
				<p>Fecha en que cubrió toda la documentación</p><input type="date" name="documentacionok" value=""><input type="checkbox" id="si" value=1><br>
				<div id="ok"></div>
				<!--
				<p>Fecha tentativa de pago</p><input type="date" name="fechapago" value=""><br>
                <br>
				-->
                <a id="boton" href="home.php">Crear</a>
                <br>
				</div>
			</section>
		</div>
		<script src="../js/reqpag.js"></script>
			</section>
		</div>
	</body>
</html>


