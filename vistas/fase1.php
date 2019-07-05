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
				<h1 id="h1pro" >Programación</h1>
			</section>
			<section id="cuerpo">
				<form id="pro" method="" action="">
					<br><p>Fecha de programacion: </p>
					<?php 
						echo date("Y-m-d");
					?>
					<br>
					<p id="fcheve">Fecha del evento: </p>
					<input type="date" id="fch" name="fechaeve" value="2019-01-02" required="required"><br>
					<p>Nombre de la la compañía, grupo, artista, ponente, ciclo, etc: </p><input type="text" id="activa"name="nomcom" value="Nombre compañia" required="required" onFocus="if (this.value=='Nombre compañia') this.value='';"><br>
					<p>Nombre de la actividad: </p><input type="text"  name="nomact" value="Nombre actividad" required="required" onFocus="if (this.value=='Nombre actividad') this.value='';"><br>
					<p>Disciplina: </p><input type="text" name="diciplina" value="Diciplina" required="required" onFocus="if (this.value=='Diciplina') this.value='';"><br>
					<p>Lugar: </p><input type="text" name="lugar" value="Lugar" required="required" onFocus="if (this.value=='Lugar') this.value='';"><br>
					<br><p>Horario: </p><button id = "mas">Agregar</button><button id = "menos">Quitar</button>
					<div id='agrhor'>
						<input type="text" name="horario" value="horas" required="required" onFocus="if (this.value=='horas') this.value='';"><input type="text" name="horarioi" value="minutos" required="required" onFocus="if (this.value=='minutos') this.value='';">
						
					</div>
					<br>
					<p>Tipo de entrada:</p>
					<p>libre</p><input type="checkbox" name="elibre" value="1">
					<p>cortesia</p><input type="checkbox" name="ecortesia" value="1">
					<p>costo</p><input type="checkbox" id="cst" name="ecosto" value="1"><br>
					<div id='cstvalor'></div>
					<p>Duracion: </p><input type="text" id="ingnum" name="duracionh" value="" required="required"><p>horas</p><input type="text" id="ingnum" name="duracionm" value="" required="required"><p>minutos</p><br>
					<br>
					<a id = "boton" href="reqdis.php">Continuar</a>
					<?php 
					if($user->getCargo() == "Administrador")
					{
						echo "<a id = \"botonRegresar\" href=\"home.php\">Regresar</a><br>";
					}
					?>
				</form>
			</section>
		</div>
	<script src="../js/fase1e.js"></script>
			</section>
		</div>
	</body>
</html>


