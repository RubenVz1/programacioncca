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
		<link href="../img/icon.ico" type="image/ico" rel="shortcut icon">
		<script src="../js/jquery.min.js"></script>
		<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="../styles/Fase1Stylo.css">
	</head>
	<body>
	<div id="arriba"></div>
        <div id="inicioSesion">
			<section id="cabecera">
					<h1 id="h1tec">Requerimientos técnicos</h1>
			</section>
			<section id="cuerpo">
			<form method="post">
			<div id="reqtec">
				<p>Requerimientos</p><br><textarea name="message" rows="5" cols="30"></textarea><br>
				<br>
				<input type="submit" name="agrega" value="Continuar">
				<br>
				</form>
			</div>
			</section>
		</div>
		<?php
			if(isset($_POST['agrega']))
			{
				if(isset($_POST['message']))
				{
					$requrimientotecnico = $_POST['message'];
				}else $requrimientotecnico ="";
				$servidor = "localhost";
            	$nombreusuario = "root";
            	$password = "QQWWEERR1";
            	$db = "prueba";
				$conexion = new mysqli($servidor, $nombreusuario, $password, $db);
				$sql = "INSERT INTO `requerimientotecnico`( `requerimiento`) VALUES ('$requrimientotecnico')";
				$resultado = $conexion->query($sql);
				if($resultado)
				{
					echo "<script>window.location='reqpag.php';</script>";
				}
				else
				{
					echo "<script>alert('error');</script>";
					die("Error al insertar datos: " . $conexion->error);
				}

			}
		?>
		</div>
		<div id="abajo"></div>
	</body>
</html>
