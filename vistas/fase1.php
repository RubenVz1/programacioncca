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
<?php include 'header.php' ?>
	<div class="container-fluid">
		<div class="row justify-content-center my-5">
			<div class="col-7">
				<div class="section-menu__container">
					<section class="section-menu__header text-center">
						<h1>Programación</h1>
					</section>
					<section class="section-menu__body fase-form__wrapper text-center">
						<form id="pro" method="post" action="">
							<p id="diadehoy">Fecha de programacion: </p>
							<div class="fase-input__container">
								<p id="fcheve">Fecha del evento: </p>
								<input type="date" id="fch" name="fechaeve" value="" required>
							</div>
							<div>
								<div id="retraso"></div>
							</div>
							<div class="fase-input__container">
								<p>Nombre de la la compañía, grupo, artista, ponente, ciclo, etc: </p>
								<input type="text" id="compañia"name="nomcom" value="" required>
							</div>
							<div class="fase-input__container">
								<p>Nombre de la actividad: </p>
								<input type="text" id="actividad" name="nomact" value=""required>
							</div>
							<div class="fase-input__container">
								<p>Disciplina: </p>
								<input type="text" id="disc" name="disciplina" value=""required>
							</div>
							<div class="fase-input__container">
								<p>Lugar: </p>
								<input type="text" id="place" name="lugar" value=""required>
							</div>
							<input type="hidden" name="numeroHorarios" id="numeroHorarios" value="1" size="1" >
							<div class="my-3">
								<p>Horario: </p>
								<div class="my-3">
									<button class="button-golden" type="button" id="mas">Agregar</button>
									<button class="button-golden" type="button" id="menos">Quitar</button>
								</div>
								<div class="hour__container" id='agrhor'>
									<div class="hour-element__container mb-2">
										<input type="number" min="0" max="24" step="1" id="horas1" name="horariohoras1" value=""required> <p>horas</p> <input type="number" min="0" max="60" step="5" id="minutos1" name="horariominutos1" value=""required> <p>minutos</p>
									</div>
								</div>
							</div>
							<div class="my-3">
								<p>Tipo de entrada:</p>
								<div class="fase-input__container check-input__container">
									<p>libre:</p><p id="silbr"><input id="lbr" type="checkbox" name="elibre" ></p>
									<p>cortesia:</p><p id="sicort"><input id="cort" type="checkbox" id="cort"name="ecortesia" ></p>
									<p>costo:</p><p id="sicst"><input type="checkbox" id="cst" name="ecosto" ></p>
								</div>
							</div>
							<div id='cstvalor'></div>
							<div class="my-3">
								<p>Duracion: </p>
								<div class="hour-element__container">
									<input type="number" id="durh" name="duracionh" min="0" max="5" step="1" value=""><p>horas</p><input type="number" id="durmin" min="0" max="60" step="5" name="duracionm" value="" ><p>minutos</p>
								</div>
							</div>
							<p>Observacion:</p><textarea name="observacion" rows="5" cols="30"></textarea>
							<div>
								<a class='button-golden' type='button' href=\"home.php\" style='margin: 10px'>Regresar</a>
								<button class='button-golden' type='submit' name='confirma' style='margin: 10px'>Siguiente</button>
							</div>
						</form>
					</section>
				</div>
			</div>
		</div>
</div>
<?php include 'footer.php' ?>
<?php
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
			$entrada = 1;
		}
		else $elibre = "0";
		if(isset($_POST['ecortesia']))
		{
			$entrada = 2;
		}
		else $ecortesia = "0";
		if(isset($_POST['ecosto']))
		{
			$entrada = 3;
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
		$sql = "INSERT INTO `requerimientoactividad`(`fechaProgramacion`, `fechaEvento`, `nombreCompania`, `nombreActividad`, `disciplina`, `lugar`, `tipoEntrada`, `duracion`,`costo`,`observacion`) VALUES (CURRENT_DATE(),'".$fechaeve."','$nomcom','$nomact','$disciplina','$lugar',$entrada,'".$duracionh.":".$duracionm.":00',".$costo.",'".utf8_decode($_POST['observacion'])."')"; 
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
			echo "<script> location.href='../vistas/reqdis.php'; </script>";
			exit;
		}
		else
		{
			die("Error al insertar datos: " . $conexion->error);
		}
		$conexion->close();
	}
?>