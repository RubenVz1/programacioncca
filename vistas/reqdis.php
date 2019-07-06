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
					<h1 id="h1dis">Requerimientos para diseño</h1>
			</section>
			<section id="cuerpo">
					<form id="reqdis" method="post" action="">
					<p>Fecha de entrega: </p><input type="date" name="entregareq" value=""><br>
					<p>Fotografias en alta resolucion:</p><input type="file" name="fotos" multiple><br>
					<p>Logotipos: </p><input type="file" name="logos" multiple><br><br>
					<p>Semblanza de la compañía grupo, artista, ponente, ciclo, etc:</p><br><textarea name="message" rows="5" cols="30"></textarea><br>
					<p>Semblanza de la actividad:</p><br><textarea name="message" rows="5" cols="30"></textarea><br>
					<p>Programa de mano: </p><input type="checkbox" name="programamano" value="1"><br>
					<br>
                    <a id="boton" href="reqtec.php">Continuar</a>
                    <?php
                    if($user->getCargo() == "Administrador")
                    {
                        echo "<a id = \"botonRegresar\" href=\"fase1.php\">Regresar</a><br>";
                    }
                    ?>
					</form>
			</section>
		</div>
			</section>
		</div>
	</body>
</html>


