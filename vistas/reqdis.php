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
	ini_set('mysql.connect_timeout',300);
	ini_set('default_socket_timeout',30);
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
					<form id="reqdis" method="post" action="" enctype="multipart/form-data">
					<p>Fecha de entrega: </p><input type="date" name="entregareq" value=""><br>
					<p>Fotografias en alta resolucion:</p><input type="file" name="foto1"><br>
					<p>Logotipos: </p><input type="file" name="logos"><br><br>
					<p>Programa de mano: </p><input type="checkbox" id="pm" name="programamano" value="1"><br>
					<div id="cstvalor"></div>
					<br>
                    <input id="boton" type="submit" name="agrega" value="agregar">
					</form>
			</section>
			<?php
				if(isset($_POST['agrega']))
				{
					$servidor = "localhost";
            		$nombreusuario = "root";
            		$password = "QQWWEERR1";
            		$db = "prueba";
					$conexion = new mysqli($servidor, $nombreusuario, $password, $db);
					if($_POST['entregareq'])
					{
						$fechaentrega = $_POST['entregareq'];
					}
					else{$fechaentrega = "";}
					/******************************************************************/
					/*
					for($i = 0; $i < 3; $i++)
					{
						if($_FILES['fotos']['tmp_name'])
						{
							$imagen = addslashes(file_get_contents($_FILES['fotos']['tmp_name']));
						}
						else
						{
							$imagen = "";
						}
					}
					*/
					/******************************************************************/
					if($_FILES['foto1']['tmp_name'])
					{
						$imagen = addslashes(file_get_contents($_FILES['foto1']['tmp_name']));
						echo $imagen;
					}
					else{$imagen = "";}
					if($_FILES['logos']['tmp_name'])
					{
						$logo = addslashes(file_get_contents($_FILES['logos']['tmp_name']));
						echo $logo;
					}
					else{$logo = "";}
					if(isset($_POST['semcom']))
					{
						$semblanzacom = $_POST['semcom'];
					}
					else{$semblanzacom = "";}
					if(isset($_POST['semact']))
					{
						$semblanzaact = $_POST['semact'];
					}
					else{$semblanzaact = "";}
					if(isset($_POST['programamano']))
					{
						$programamano = "1";
					}
					else{$programamano = "0";}
					$sql = "INSERT INTO `requerimientodiseno`(`fechaEntrega`, `semblanzaCompania`, `semblanzaActividad`, `programaMano`) VALUES ('$fechaentrega','$semblanzacom','$semblanzaact','$programamano');";
					$resultado = $conexion->query($sql);
					if($resultado)
					{
					    echo "<script>window.location='reqtec.php';</script>";
					    //echo "<script>alert('se realizo la consulta');</script>";

					}
					else
					{
						echo "<script>alert('error');</script>";
						die("Error al insertar datos: " . $conexion->error);
					}
				}
			?>
		</div>
		<script src="../js/reqdis.js"></script>
			</section>
		</div>
	</body>
</html>


