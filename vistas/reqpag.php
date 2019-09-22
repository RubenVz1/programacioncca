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
					<h1 id="h1pag">Requerimientos para pagos</h1>
			</section>
			<section id="cuerpo">
			<form method="post">
			<div id="reqpag">
				<p>Requerimientos</p><br><textarea name="req" rows="5" cols="30"></textarea><br>
				<p>Fecha en que cubrió toda la documentación</p><input type="date" name="documentacionok" value=""><input type="checkbox" id="si" value=1><br>
				<div id="ok"></div>
				<!--
				<p>Fecha tentativa de pago</p><input type="date" name="fechapago" value=""><br>
                <br>
				-->
                <input type="submit" name="agrega" value="Crear">
                <br>
			</div>
			</form>
			</section>
			<?php
				if(isset($_POST['agrega']))
				{
					if(isset($_POST['req']))
					{
						$requerimientos = $_POST['req'];
					}else $requerimientos="";
					if(isset($_POST['documentacionok']))
					{
						$fecha = $_POST['documentacionok'];
					}else $fecha="";
					if(isset($_POST['fechapago']))
					{
						$fechapago=$_POST['fechapago'];
					}else $fechapago="";
					$mysqli = new DBA();
                	$conexion = $mysqli->connect();
					$sqlreqpag = "INSERT INTO `requerimientoPago`(`requerimiento`, `fechaDocumentacion`, `fechaTentativa`) VALUES ('$requerimientos','$fecha','$fechapago')";
					$resultadoreqpag = $conexion->query($sqlreqpag);
					if($resultadoreqpag)
					{
						//trae el id del ultimo insert de requerimientos de programacion
						$getidprogramacion = "SELECT MAX(idRequerimientoActividad) as id FROM `requerimientoActividad`";
						$resprogramacion = $conexion->query($getidprogramacion);
						$objetoidprogramacion = $resprogramacion->fetch_assoc();
						$idprogramacion = $objetoidprogramacion['id'];
						//trae el id del ultimo insert de requerimientos de diseño
						$getiddiseño =  "SELECT MAX(idRequerimientoDiseno) as id FROM `requerimientoDiseno`";
						$resdiseno =  $conexion->query($getiddiseño);
						$objetoiddiseño = $resdiseno->fetch_assoc();
						$iddiseño = $objetoiddiseño['id'];
						//trae el id del ultimo insert de requerimientos técnicos
						$getidtecnico =  "SELECT MAX(idRequerimientoTecnico) as id FROM `requerimientoTecnico`";
						$restecnico =  $conexion->query($getidtecnico);
						$objetoidtecnico = $restecnico->fetch_assoc();
						$idtecnico = $objetoidtecnico['id'];
						//trae el id del ultimo insert de requerimientos para pagos
						$getidpagos =  "SELECT MAX(idRequerimientoPago) as id FROM `requerimientoPago`";
						$respago =  $conexion->query($getidpagos);
						$objetoidpago = $respago->fetch_assoc();
						$idpago = $objetoidpago['id'];
						//inset que junta todas las tablas de la fase de programacion
						$sqlprogramacion = "INSERT INTO `Programacion`(`idRequerimientoActividad`, `idRequerimientoDiseno`, `idRequerimientoTecnico`, `idRequerimientoPago`) VALUES ('$idprogramacion','$iddiseño','$idtecnico','$idpago')";
						$resultadofusion = $conexion->query($sqlprogramacion);

						
						header("location: ../vistas/fase2.php");
					}
					else
					{
						echo "<script>alert('error');</script>";
						die("Error al insertar datos: " . $conexion->error);
					}
				}
			?>
		</div>
		<script src="../js/reqpag.js"></script>
			</section>
		</div>
		<div id="abajo"></div>
	</body>
</html>