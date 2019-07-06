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
					<br><p id="diadehoy">Fecha de programacion: </p>
					<br>
					<p id="fcheve">Fecha del evento: </p>
					<input type="date" id="fch" name="fechaeve" value=""><br>
					<div id="retraso"></div>
					<p>Nombre de la la compañía, grupo, artista, ponente, ciclo, etc: </p><input type="text" id="activa"name="nomcom" value="Nombre compañia" onFocus="if (this.value=='Nombre compañia') this.value='';"><br>
					<p>Nombre de la actividad: </p><input type="text" id="actividad" name="nomact" value="Nombre actividad" onFocus="if (this.value=='Nombre actividad') this.value='';"><br>
					<p>Disciplina: </p><input type="text" id="disc" name="disciplina" value="Diciplina"  onFocus="if (this.value=='Diciplina') this.value='';"><br>
					<p>Lugar: </p><input type="text" id="place" name="lugar" value="Lugar"  onFocus="if (this.value=='Lugar') this.value='';"><br>
					<br><p>Horario: </p><button type="button" id = "mas">Agregar</button><button type="button" id = "menos">Quitar</button>
					<div id='agrhor'>
						<input type="number" min="0" max="24" step="1" id="horas" name="horariohoras" value="0">hrs<input type="number" min="0" max="60" step="5" id="minutos" name="horariominutos" value="0">min
					</div>
					<br>
					<p>Tipo de entrada:</p>
					<p>libre:</p><p id="silbr"><input id="lbr" type="checkbox" name="elibre" value="1"></p>
					<p>cortesia:</p><input type="checkbox" name="ecortesia" value="1">
					<p>costo:</p><p id="sicst"><input type="checkbox" id="cst" name="ecosto" value="1"></p><br>
					<div id='cstvalor'></div>
					<p>Duracion: </p><input type="number" id="durh" name="duracionh" min="0" max="5" step="1" value="1"><p>horas</p><input type="number" id="durmin" min="0" max="60" step="5" name="duracionm" value="0" ><p>minutos</p><br>
					<br>
					<div id="fin"></div>
					<a id ="boton" type="button" name="confirma">Continuar</a>
					<?php 
					if($user->getCargo() == "Administrador")
					{
						echo "<a type='button' id = \"boton\" href=\"home.php\">Regresar</a><br>";
					}
					if(isset($_POST['confirma']))
					{
						if(isset($_POST['fechaeve']))
						{
							$fechaeve = $_POST['fechaeve'];
						}
						if(isset($_POST['nomcom']))
						{
							$nomcom = $_POST['nomcom'];
						}
						if(isset($_POST['nomact']))
						{
							$nomact = $_POST['nomact'];
						}
						if(isset($_POST['diciplina']))
						{
							$diciplina = $_POST['diciplina'];
						}
						if(isset($_POST['lugar']))
						{
							$lugar = $_POST['lugar'];
						}
						if(isset($_POST['horariohoras']))
						{
							$horariohoras = $_POST['horariohoras'];
						}
						if(isset($_POST['horariominutos']))
						{
							$horariominutos = $_POST['horariominutos'];
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
						
						/*echo "<p>Fecha de programacion:</p>".$fechapro."<br>
							<p>Fecha del evento: </p>".$fechaeve."<br>
							<p>Nombre de la compañia: </p>".$nomcom."<br>
							<p>Nombre de la actividad: </p>".$nomact."<br>
							<p>Duracion: </p>".$duracion."<br>
							<p>Lugar: </p>".$lugar."<br>
							<p>Horario: </p>".$horarioi."-".$horariof."<br>
							<p>Tipo de entrada:</p>
							<p>libre </p>".$elibre."
							<p>cortesia </p>".$ecortesia."
							<p>costo </p>".$ecosto."<br>
							<p>Costo: $</p>".$costo."<br>
							<p>Disciplina: </p>".$diciplina."<br>
							<p>Fotografias: </p>".$fotografias."<br>
							<p>Logotipo: </p>".$logotipos."<br>
							<p>Programa de mano: </p>".$programamano."<br>
							<p>Observaciones: </p>".$observaciones."<br>";*/
						/*$insertar = "INSERT INTO actividad(fechapro,fechaeve,nomcom,nomact,duracion,lugar,horarioi,horariof,elibre,ecortesia,ecosto,costo,diciplina,observaciones)VALUES ('$fechapro','$fechaeve','$nomcom','$nomact','$duracion','$lugar','$horarioi','$horariof','$elibre','$ecortesia','$ecosto','$costo','$diciplina','$observaciones')";
						$resultado = mysqli_query($connection,$insertar);
						if(!$resultado)
						{
							echo "Error al registrarse";
						}else
						{
							echo '<script>alert("registrado correctamente");</script>';
						}
						mysqli_close($connection);*/
						echo '<script>alert("registrado correctamente");</script>';
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


