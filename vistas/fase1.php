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
					<input id = "boton"type="submit" name="confirma" value="Continuar">
				</form>
				<?php
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
						if(isset($_POST['duracion']))
						{
							$duracion = $_POST['duracion'].":00";
						}
						if(isset($_POST['lugar']))
						{
							$lugar = $_POST['lugar'];
						}
						if(isset($_POST['horarioi']))
						{
							$horarioi = $_POST['horarioi'].":00";
						}
						if(isset($_POST['horariof']))
						{
							$horariof = $_POST['horariof'].":00";
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
						if(isset($_POST['diciplina']))
						{
							$diciplina = $_POST['diciplina'];
						}

						if(isset($_POST['observaciones']))
						{
							$observaciones = $_POST['observaciones'];
						}
						if(isset($_POST['programamano']))
						{
							$programamano = $_POST['programamano'];
						}
						else $programamano = "0";
						if(isset($_POST['fotografias']))
						{
							$fotografias = $_POST['fotografias'];
						}
						if(isset($_POST['logotipos']))
						{
							$logotipos = $_POST['logotipos'];
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
			</section>
			<section id="cabecera">
					<h1 id="h1dis">Requerimientos para diseño</h1>
			</section>
			<section id="cuerpo">
					<form id="reqdis" method="post" action="">
					<p>Fecha de entrega: </p><input type="date" name="entregareq" value=""><br>
					<p>Fotografias en alta resolucion:</p><input type="file" name="fotos" multiple><br>
					<p>Logotipos: </p><input type="file" name="logos" multiple><br><br>
					<p>Semblanza de la compañía grupo, artista, ponente, ciclo, etc:</p><br><textarea name="message" rows="5" cols="30"></textarea><br>
					<p>Semblanza de la actividad:</p><br><textarea name="message" rows="5" cols="30"></textarea><br>
					<p>Programa de mano: </p><input type="checkbox" name="programamano" value="1"><br>
					</form>
			</section>
			<section id="cabecera">
					<h1 id="h1tec">Requerimientos técnicos</h1>
			</section>
			<section id="cuerpo">
			<div id="reqtec">
				<p>Requerimientos</p><br><textarea name="message" rows="5" cols="30"></textarea><br>
			</div>
			</section>
			<section id="cabecera">
					<h1 id="h1pag">Requerimientos para pagos</h1>
			</section>
			<section id="cuerpo">
			<div id="reqpag">
				<p>Requerimientos</p><br><textarea name="message" rows="5" cols="30"></textarea><br>
				<p>Fecha en que cubrió toda la documentación</p><input type="date" name="documentacionok" value=""><br>
				<p>Fecha tentativa de pago</p><input type="date" name="fechapago" value=""><br>
				</div>
			</section>
		</div>
	<script src="../js/fase1e.js"></script>
			</section>
		</div>
	</body>
</html>


