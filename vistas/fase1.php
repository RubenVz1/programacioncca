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
		<link href="../images/icon.ico" type="image/ico" rel="shortcut icon">
		<script src="../js/jquery.min.js"></script>
		<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="../styles/Fase1Stylo.css">
	</head>
	<body>
		<div id="arriba"></div>
		<div id="inicioSesion">
			<section id="cabecera">
				<h1 id="h1pro" >Programación</h1>
			</section>
			<section id="cuerpo">
				<form id="pro" method="post" action="">
					<br><p id="diadehoy">Fecha de programacion: </p>
					<br>
					<p id="fcheve">Fecha del evento: </p>
					<input type="date" id="fch" name="fechaeve" value="" required><br>
					<div id="retraso"></div>
					<p>Nombre de la la compañía, grupo, artista, ponente, ciclo, etc: </p><input type="text" id="compañia"name="nomcom" value="" required><br>
					<p>Nombre de la actividad: </p><input type="text" id="actividad" name="nomact" value=""required><br>
					<p>Disciplina: </p><input type="text" id="disc" name="disciplina" value=""required><br>
					<p>Lugar: </p><input type="text" id="place" name="lugar" value=""required><br>
					<input type="hidden" name="numeroHorarios" id="numeroHorarios" value="1" size="1" ><br>
					<br><p>Horario: </p>
					<button type="button" id="mas">Agregar</button>
					<button type="button" id="menos">Quitar</button>
					<div id='agrhor'>
						<input type="number" min="0" max="24" step="1" id="horas1" name="horariohoras1" value=""required> hrs <input type="number" min="0" max="60" step="5" id="minutos1" name="horariominutos1" value=""required> min
					</div>
					<br>
					<p>Tipo de entrada:</p>
					<p>libre:</p><p id="silbr"><input id="lbr" type="checkbox" name="elibre" ></p>
					<p>cortesia:</p><p id="sicort"><input id="cort" type="checkbox" id="cort"name="ecortesia" ></p>
					<p>costo:</p><p id="sicst"><input type="checkbox" id="cst" name="ecosto" ></p><br>
					<div id='cstvalor'></div>
					<p>Duracion: </p><input type="number" id="durh" name="duracionh" min="0" max="5" step="1" value=""><p>horas</p><input type="number" id="durmin" min="0" max="60" step="5" name="duracionm" value="" ><p>minutos</p><br>
					<br>
					<p>Observacion:</p><br><textarea name="observacion" rows="5" cols="30"></textarea>
					<div id="fin"></div>
					<?php 
					if($user->getCargo() == "Administrador")
					{
						echo "<a type='button' id = \"boton\" href=\"home.php\">Regresar</a><br>";
						echo "<button id ='crea' type='submit' name='confirma'>Confirmar</button>";
					}
					if(isset($_POST['confirma']))
					{
						$mysqli = new DBA();
						$conexion = $mysqli->connect();
						if($conexion->connect_error)
						{
             			   die("Conexión fallida: " . $conexion->connect_error);
						}
						
						if(isset($_POST['fechaeve']))
						{
							$fechaeve = $_POST['fechaeve'];
						}
						if(isset($_POST['nomcom']))
						{
							$nomcom = utf8_decode($_POST['nomcom']);
						}
						if(isset($_POST['nomact']))
						{
							$nomact = utf8_decode($_POST['nomact']);
						}
						if(isset($_POST['disciplina']))
						{
							$disciplina = utf8_decode($_POST['disciplina']);
						}
						if(isset($_POST['lugar']))
						{
							$lugar = utf8_decode($_POST['lugar']);
						}
						$numeroHorarios = $_POST['numeroHorarios'];
						for($i = 1; $i <= $numeroHorarios; $i++)
						{
							$nombreHoras = "horariohoras".$i;
							$nombreMinutos = "horariominutos".$i;
							if(isset($_POST[$nombreHoras]) && isset($_POST[$nombreMinutos]))
							{
								$horarioHoras = $_POST[$nombreHoras];
								$horarioMinutos = $_POST[$nombreMinutos];
							}
							$horarios[] = $horarioHoras.":".$horarioMinutos.":00";
						}
						if(isset($_POST['elibre']))
						{
							$elibre = $_POST['elibre'];
						}
						else $elibre = "0";
						if(isset($_POST['ecortesia']))
						{
							$ecortesia = $_POST['ecortesia'];
						}
						else $ecortesia = "0";
						if(isset($_POST['ecosto']))
						{
							$ecosto = $_POST['ecosto'];
						}
						else $ecosto = "0";
						if(isset($_POST['costo']))
						{
							$costo = $_POST['costo'];
						}
						else $costo=0;
						if(isset($_POST['duracionh']))
						{
							$duracionh = $_POST['duracionh'];
						}
						if(isset($_POST['duracionm']))
						{
							$duracionm = $_POST['duracionm'];
						}
						
						$sql = "INSERT INTO `requerimientoactividad`(`fechaProgramacion`, `fechaEvento`, `nombreCompania`, `nombreActividad`, `disciplina`, `lugar`, `tipoEntrada`, `duracion`,`costo`,`observacion`) VALUES (CURRENT_DATE(),'".$fechaeve."','".$nomcom."','".$nomact."','".$disciplina."','".$lugar."',1,'".$duracionh.":".$duracionm.":00',".$costo.",'".utf8_decode($_POST['observacion'])."')"; 
						$resultado = $conexion->query($sql);
						$sql = "SELECT MAX(idRequerimientoActividad) as id FROM requerimientoactividad;";
						$resultado = $conexion->query($sql);
						$row = $resultado->fetch_assoc();
						$idk = $row['id'];
						for($i = 0; $i < $numeroHorarios; $i++)
						{
							$hrk = $horarios[$i];
							$sql = "INSERT INTO `horario`(`horario`, `idRequerimientoActividad`) VALUES ('$hrk','$idk');";
							$resultado = $conexion->query($sql);
						}
						if($resultado)
						{
							header("location: ../vistas/reqdis.php");
						}
						else
						{
                    		die("Error al insertar datos: " . $conexion->error);
               			}
						$conexion->close();
					}
					?>
				</form>
			</section>
		</div>
			</section>
		</div>
		<div id="abajo"></div>
	</body>
	<script src="../js/fase1a.js"></script>

</html>