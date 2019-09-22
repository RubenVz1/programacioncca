<?php
	include_once '../includes/user.php';
    include_once '../includes/user_session.php';
    include_once '../includes/dbA.php';
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
					<input type="hidden" name="numeroImagenes" id="numeroImagenes" value="0" size="1" ><br>
					<p>Añadir fotografia</p><br>
					<input id="masImagenes" name="masImagenes" type="button"value="+">
					<input id="menosImagenes" name="menosImagenes" type="button" value="--"><br>
					<div id="imagenes">
					</div>
					<input type="hidden" name="numeroLogos" id="numeroLogos" value="0" size="1" ><br>
					<p>Añadir logo</p><br>
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
				function isImageValid($imagen)
				{
					switch ($imagen['type']) 
					{
						case 'image/jpeg':
							return true;
						break;
						case 'image/jpg':
							return true;
						break;
						case 'image/png':
							return true;
						break;
						default:
							return false;
						break;
					}
				}
				if(isset($_POST['agrega']))
				{
					$mysqli = new DBA();
                	$conexion = $mysqli->connect();
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
							if(!isImageValid($_FILES[$nombre]))
							{
								echo "<script>alert('La imagen ".($i+1)." tiene un formato invalido, no se guardara en la base de datos')</script>";
								$imagenes[] = "";
								continue;
							}
							$imagen = "../images/".generateRandomString()."__".$_FILES[$nombre]['name'];
							move_uploaded_file($_FILES[$nombre]['tmp_name'],$imagen);
							$imagenes[] = $imagen;
						}
						else
							$imagenes[] = "";
					}
					$numeroLogos = $_POST['numeroLogos'];
					for($i = 0; $i < $numeroLogos; $i++)
					{
						$nombre = "logo".$i;
						if($_FILES[$nombre]['tmp_name'])
						{
							if(!isImageValid($_FILES[$nombre]))
							{
								echo "<script>window.location='reqtec.php';</script>";
								$imagenes[] = "";
								continue;
							}
							$logo = "../images/".generateRandomString()."__".$_FILES[$nombre]['name'];
							move_uploaded_file($_FILES[$nombre]['tmp_name'],$logo);
							$logos[] = $logo;
						}
						else
							$logos[] = "";
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
					$sql = "INSERT INTO `requerimientoDiseno`(`fechaEntrega`, `semblanzaCompania`, `semblanzaActividad`, `programaMano`) VALUES ('$fechaentrega','$semblanzacom','$semblanzaact','$programamano');";
					$resultado = $conexion->query($sql);
					$sql = "SELECT MAX(idRequerimientoDiseno) as id FROM requerimientoDiseno;";
					$resultado = $conexion->query($sql);
					$row = $resultado->fetch_assoc();
					$idk = $row['id'];
					if($numeroImagenes != 0)
						for($i = 0; $i < $numeroImagenes; $i++)
						{
							if($imagenes[$i] == "")
								continue;
							$imgk = $imagenes[$i];
							$sql = "INSERT INTO `Fotografia`(`fotografia`, `idRequerimientoDiseno`) VALUES ('$imgk','$idk');";
							$resultado = $conexion->query($sql);
						}
					if($numeroLogos != 0)
						for($i = 0; $i < $numeroLogos; $i++)
						{
							if($logos[$i] == "")
								continue;
							$logok = $logos[$i];
							$sql = "INSERT INTO `Logotipo`(`logotipo`, `idRequerimientoDiseno`) VALUES ('$logok','$idk');";
							$resultado = $conexion->query($sql);
						}
					if($resultado)
					{
						header("location: ../vistas/reqtec.php");
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


