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
			<form method="post" enctype="multipart/form-data">
			<div id="reqtec">
				<br>
				<p>Requerimientos</p><br><br>
				<textarea name="message" rows="5" cols="30"></textarea><br>
				<p>Requerimientos PDF</p>
				<input name='pdf' type='file' accept='application/pdf'>
				<br>
				<input type="submit" name="agrega" value="Continuar">
				<br>
				</form>
			</div>
			</section>
		</div>
		<?php
			function generateRandomString($length = 6)
			{
				$possibleChars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$id = '';
				for($i = 0; $i < $length; $i++)
				{
					$rand = rand(0, strlen($possibleChars) - 1);
					$id .= substr($possibleChars, $rand, 1);
				}
				return $id;
			}
			if(isset($_POST['agrega']))
			{
				if(isset($_POST['message']))
					$requrimientotecnico = $_POST['message'];
				else
					$requrimientotecnico ="";
				if($_FILES['pdf']['tmp_name'])
				{
					$requrimientotecnicoPdf = $_FILES['pdf']['name'];
					$direccionPdf = "../pdfs/".generateRandomString()."__".$requrimientotecnicoPdf;
					move_uploaded_file($_FILES['pdf']['tmp_name'],$direccionPdf);
				}
				else
					$direccionPdf ="";
				$servidor = "localhost";
            	$nombreusuario = "root";
            	$password = "QQWWEERR1";
            	$db = "prueba";
				$conexion = new mysqli($servidor, $nombreusuario, $password, $db);
				$sql = "INSERT INTO `requerimientotecnico`( `requerimiento`,`direccionPdf`) VALUES ('$requrimientotecnico','$direccionPdf')";
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
