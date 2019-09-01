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
		<link href="../img/icon.ico" type="image/ico" rel="shortcut icon">
		<script src="../js/jquery.min.js"></script>
		<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="../styles/Fase1Stylo.css">
	</head>
	<body>
	<div id="arriba"></div>
		<div id="inicioSesion">
			<section id="cabecera">
					<h1 id="h1dis">Requerimientos para diseño</h1>
			</section>
			<section id="cuerpo">
					<form id="reqdis" method="post" action="" enctype="multipart/form-data">
					<p>Fecha de entrega: </p><input type="date" name="entregareq" value=""><br>
					<input type="hidden" name="numeroImagenes" id="numeroImagenes" value="1" size="1" ><br>
					<p>Fotografia en alta resolucion:</p>
					<input type="file" name="foto0">
					<input id="masImagenes" name="masImagenes" type="button"value="+">
					<input id="menosImagenes" name="menosImagenes" type="button" value="--"><br>
					<div id="imagenes">
					</div>
					<input type="hidden" name="numeroLogos" id="numeroLogos" value="1" size="1" ><br>
					<p>Logo en alta resolucion:</p>
					<input type="file" name="logo0">
					<input id="masLogos" name="masLogos" type="button"value="+">
					<input id="menosLogos" name="menosLogos" type="button" value="--"><br>
					<div id="logos">
					</div>
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
					$numeroImagenes = $_POST['numeroImagenes'];
					for($i = 0; $i < $numeroImagenes; $i++)
					{
						$nombre = "foto".$i;
						if($_FILES[$nombre]['tmp_name'])
						{
							$imagen = addslashes(file_get_contents($_FILES[$nombre]['tmp_name']));
						}
						else
						{
							$imagen = "";
						}
						$imagenes[] = $imagen;
					}
					$numeroLogos = $_POST['numeroLogos'];
					for($i = 0; $i < $numeroLogos; $i++)
					{
						$nombre = "logo".$i;
						if($_FILES[$nombre]['tmp_name'])
						{
							$logo = addslashes(file_get_contents($_FILES[$nombre]['tmp_name']));
						}
						else
						{
							$logo = "";
						}
						$logos[] = $logo;
					}
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
					$sql = "SELECT MAX(idRequerimientoDiseno) as id FROM requerimientodiseno;";
					$resultado = $conexion->query($sql);
					$row = $resultado->fetch_assoc();
					$idk = $row['id'];
					for($i = 0; $i < $numeroImagenes; $i++)
					{
						$imgk = $imagenes[$i];
						$sql = "INSERT INTO `Fotografia`(`fotografia`, `idRequerimientoDiseno`) VALUES ('$imgk','$idk');";
						$resultado = $conexion->query($sql);
					}
					for($i = 0; $i < $numeroLogos; $i++)
					{
						$logok = $logos[$i];
						$sql = "INSERT INTO `Logotipo`(`logotipo`, `idRequerimientoDiseno`) VALUES ('$logok','$idk');";
						$resultado = $conexion->query($sql);
					}
					if($resultado)
					{
						echo "<script>window.location='reqtec.php';</script>";
					}
					else
					{
						echo "<script>alert('error');</script>";
						die("Error al insertar datos: " . $conexion->error);
					}
				}
			?>
		</div>
		<script src="../js/reqdiseño.js"></script>
			</section>
		</div>
		<div id="abajo"></div>
	</body>
</html>


