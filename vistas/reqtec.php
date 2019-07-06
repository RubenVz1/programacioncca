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
        <div id="inicioSesion">
			<section id="cabecera">
					<h1 id="h1tec">Requerimientos técnicos</h1>
			</section>
			<section id="cuerpo">
			<div id="reqtec">
				<p>Requerimientos</p><br><textarea name="message" rows="5" cols="30"></textarea><br>
				<br>
				<a id="boton" href="reqpag.php">Continuar</a>
				<a id="boton" href="reqdis.php">Regresar</a>
				<br>
			</div>
			</section>
		</div>
			</section>
		</div>
	</body>
</html>
