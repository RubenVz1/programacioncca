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

    $mysqli = new mysqli("localhost","root","QQWWEERR1","prueba");
    if (mysqli_connect_errno()) {
    	printf("Conexión a base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}

    //---------------Variables a usar para el fetching de la base de datos y control de elementos
	
	//
	//TODOS LAS SIGUIENTES VARIABLES PODRIAN SER GUARDADAS EN UN ARREGLO,
	//PERO POR CUESTIONES DE ENTENDIMIENTOS LAS HE HECHO COMO ESTAN A CONTINUACION
    //

    $id_act = $_GET['id']; //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<ID PRINCIPAL: ACTIVIDAD

  	$consulta= "SELECT * FROM actividad WHERE idActividad = ".$id_act;
	if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
        	$id_prog = $obj->idProgramacion;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
        	$id_dis = $obj->idDiseno;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
        	$id_dif = $obj->idDifusion;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
  		  }
    	$resultado->close();
    }

    $consulta= "SELECT * FROM diseno WHERE iddiseno = ".$id_dis;
    if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$id_f2 = $obj->idFase2;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
        	$id_cartel = $obj->idCartelyCortesias;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
        	$id_corrector = $obj->idCorrector;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
  		  }
    	$resultado->close();
    }

    $consulta= "SELECT * FROM programacion WHERE idProgramacion = ".$id_prog;
    if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$id_req_act = $obj->idRequerimientoActividad;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
    		$id_req_dis = $obj->idRequerimientoDiseno;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
   			$id_req_tec = $obj->idRequerimientoTecnico;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
    		$id_req_pago = $obj->idRequerimientoPago;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
  		  }
    	$resultado->close();
    }

    $consulta= "SELECT * FROM difusion WHERE idDifusion = ".$id_dif;
    if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$id_f3 = $obj->idDifusion;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID  NOTA: (idDifusion = idDifusion)
  		  }
    	$resultado->close();
    }

    //===================================VARIABLES UTILIZADAS PARA ACTUALIZACION================================

    $consulta= "SELECT * FROM requerimientoactividad WHERE idRequerimientoActividad = ".$id_req_act;
    if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$event_date = $obj->fechaEvento;
    		$artist = $obj->nombreCompania;
    		$activity = $obj->nombreActividad;
    		$discipline = $obj->disciplina;
    		$fes_place = $obj->lugar;
    		$time1 = $obj->horario;
    		$ticket_type = $obj->tipoEntrada;
    		$price = $obj->costo;
    		$duration = $obj->duracion;
  		  }
    	$resultado->close();
    }


    //-----------------------------------------------

    $consulta= "SELECT * FROM requerimientodiseno WHERE idRequerimientoDiseno = ".$id_req_dis;
    if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$delivery_date = $obj->fechaEntrega ;
    		$program = $obj->programaMano ;
    		$artist_info = $obj->semblanzaCompania ;
    		$semblance = $obj->semblanzaActividad ;
  		  }
    	$resultado->close();
    }

    //------------------------------------------------

    $consulta= "SELECT * FROM requerimientotecnico WHERE idRequerimientoTecnico = ".$id_req_tec;
    if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$tech_req = $obj->requerimiento;
  		  }
    	$resultado->close();
    }

    //------------------------------------------------

    $consulta= "SELECT * FROM requerimientopago WHERE idRequerimientoPago = ".$id_req_pago;
    if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$payment_req = $obj->requerimiento;
    		$doc_date = $obj->fechaDocumentacion;
    		$payment_date = $obj->fechaTentativa;
  		  }
    	$resultado->close();
    }

    //------------------------------------------------

    $consulta= "SELECT * FROM fase2 WHERE idfase2 = ".$id_f2;
    if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$designer = $obj->nombreDisenador;
    		$des_date = $obj->fechaEntra;
   			$media_fotos = array($obj->fotos,$obj->vineta,$obj->logos);
    		$des_place = $obj->lugar;
   		 	$des_place_date = $obj->fecha;
    		$des_place_time = $obj->hora;
    		$repertory = $obj->leyenda;
    		$prob_del_date = $obj->fechaSalida;
    		$media_comp_array = array($obj->cartel,$obj->web,$obj->cortesias,$obj->programa,$obj->invitacion);
  		  }
    	$resultado->close();
    }

    //-------------------------------------------------

    $consulta= "SELECT * FROM cartelycortesias WHERE idcartelycortesias = ".$id_cartel;
    if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$dig_print = $obj->digital;
    		$offset_print = $obj->offset;
    		$serigraphy = $obj->serigrafia;
    		$out_date = $obj->fuera;
    		$hand_prog_date = $obj->entregaPrograma;
    		$inv_date = $obj->invitacion;
    		$broshure = $obj->volante;

  		  }
    	$resultado->close();
    }

    //-----------------------------------------------

    $consulta= "SELECT * FROM corrector WHERE idcorrector = ".$id_corrector;
    if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$cortext_init_date = $obj->fechaEntra;
    		$cortext_name = $obj->nombreCorrector;
    		$cortext_due_date = $obj->fechaSale;
  		  }
    	$resultado->close();
    }

    //-----------------------------------------------

    $consulta= "SELECT * FROM difusion WHERE idDifusion = ".$id_dif;
    if ($resultado = $mysqli->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$spread = $obj->fechaDifusion;
  		  }
    	$resultado->close();
    }


    $mysqli->close();
?>
<!DOCTYPE html>
<html lang = "es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Actualización de datos</title>

		<!--<link rel="stylesheet" href="../styles/Fase1c.css">-->
		<link href="../img/icon.ico" type="image/ico" rel="shortcut icon">
		<script src="../js/jquery.min.js"></script>
		<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="../styles/Fase1Stylo.css">
	</head>
	<!-- DECLARACION DE VARIABLES EN JS -->

	<script>
		var js_price = "<?php echo $price; ?>";
	</script>

	<body>
		<div id="inicioSesion">
			<section id="cabecera">
				<h1 id="h1pro" >Actualización</h1>
			</section>
			
			<section id="cuerpo">
				<!-- LISTA DE VARIABLES A CHECAR:
					NOTA: "HACER QUE LOS SCRIPTS CHEQUEN PRIMERO CHECKBOXES PARA EVITAR CONFUSION"

    				* $time1
    				/ $price
    				* $duration

    				* $photos
    				* $logotypes
    				* $program
    				* $artist_info
    				* $semblance

    				---

    				* $payment_date


    				* $des_place_time

				-->

				<form id="pro" method="post" action="">
					<br>
					<p id="diadehoy"><b>Fecha de actualización:</b> </p>
					<br>
					<p id="fcheve"><b>Fecha del evento: </b></p>
					<?php echo "<input type='date' id='fch' name='fechaeve' value='".$event_date."'><br>"?>
					<div id="retraso"></div>

						<!--//======================Elementos de: Requerimentos fase 1========================-->

						<p><b>Nombre de la la compañía, grupo, artista, ponente, ciclo, etc: </b></p>
						<?php echo"<input type='text' id='compañia' name='nomcom' value='".$artist."' ><br>"?>

						<p><b>Nombre de la actividad: </b></p>
							<?php echo "<input type='text' id='actividad' name='nomact' value='".$activity."'><br>"?>
						<p><b>Disciplina: </b></p>
							<?php echo "<input type='text' id='disc' name='disciplina' value='".$discipline."'><br>"?>
						<p><b>Lugar: </b></p>
							<?php echo "<input type='text' id='place' name='lugar' value='".$fes_place."'><br>"?>
						<br>
						<p><b>Horario: </b></p>
						<button type='button' id = 'mas'>Agregar</button>
						<button type='button' id = 'menos'>Quitar</button>


						<div id='agrhor'>
							<input type='number' min='0' max='24' step='1' id='horas1' name='horariohoras' value=''>hrs
							<input type='number' min='0' max='60' step='5' id='minutos1' name='horariominutos' value=''>min
						</div>


						<br>
						<p><b>Tipo de entrada:   </b></p>
						<p>  libre: </p><p id="nobox"></p><p id="silbr">
							<?php 
								if($ticket_type=='3')
								{
									echo "<input id='lbr' type='checkbox' name='elibre' checked>";
								}
								else
								{
									echo "<input id='lbr' type='checkbox' name='elibre'>";
								}
							?>	
							</p>
							
						<p>  cortesia: </p>
							<?php 
								if($ticket_type=='2')
								{
									echo "<input type='checkbox' id='cort'name='ecortesia' checked>";
								}
								else
								{
									echo "<input type='checkbox' id='cort'name='ecortesia' >";
								}
							?>	
							
						<p>  costo: </p><p id="nobox2"></p><p id="sicst">
							<?php 
								if($ticket_type=='1')
								{
									echo "<input type='checkbox' id='cst' name='ecosto' checked>";
								}
								else
								{
									echo "<input type='checkbox' id='cst' name='ecosto' >";
								}
							?>	
							</p><br>
						<div id="costval">
						</div>
							<script src="../js/actfase1.js"></script>
							<p><b>Duracion: </b></p>
								<input type='number' id='durh' name='duracionh' min='0' max='5' step='1' value=''>
							<p>horas</p>
								<input type='number' id='durmin' min='0' max='60' step='5' name='duracionm' value='' >
							<p>minutos</p><br>
							<br>


						<!--//======================Elementos de: Requerimentos diseño========================-->
						<div id="req-dis">
							<br>
							<hr>
							<br>
							<section id="cuerpo">
								<!--<form id="reqdis" method="post" action="" enctype="multipart/form-data">-->
								<p><b>Fecha de entrega:  </b></p>
									<?php echo"<input type='date' name='entregareq' value='".$delivery_date."'><br>"?>
								<p><b>Fotografias en alta resolucion:  </b></p>
									<input type='file' name='fotos'><br>
								<p><b>Logotipos: </b></p>
									<input type='file' name='logos'><br><br>
								<p><b>Programa de mano: </b></p>
									<input type='checkbox' id='pm' name='programamano' value='1'><br>
								<div id="cstvalor"></div>
								<!--</form>-->
							</section>
							<script src="../js/actreqdis.js"></script> <!-- =============OJO CON SCRIPT============= -->
						</div>	

						<!--//======================Elementos de: Requerimentos tecnicos========================-->
						<div id="req-tec">
							<br>
							<hr>
							<br>
							<section id="cuerpo">
								<div id="reqtec">
									<p><b>Requerimientos técnicos</b></p><br>
									<textarea name='message' rows='5' cols='30'><?php echo $tech_req; ?></textarea><br>
									<br>
								</div>
							</section>
						</div>	

						<!--//======================Elementos de: Requerimentos pagos========================-->
						<div id="req-pag">
							<br>
							<hr>
							<br>
							<section id="cuerpo">
									<div id="reqpag">
										<p><b>Requerimientos de pagos</b></p><br>
										<textarea name='req' rows='5' cols='30'><?php echo $payment_req; ?></textarea><br>
										<p><b>Fecha en que cubrió toda la documentación:  </b></p>
										<?php echo "<input type='date' name='documentacionok' value='".$doc_date."'>"?>
										<input type='checkbox' id='si' value=1><br>
										<div id="ok"></div>
										<!--
										<p>Fecha tentativa de pago</p><input type="date" name="fechapago" value=""><br>
               							 <br>
										-->
               							 <br>
									</div>
								<script src="../js/actreqpag.js"></script> <!-- ======OJO CON SCRIPT====== -->
							</section>
						</div>	

						<!--//======================Elementos de: Requerimentos Fase 2========================-->
						<div id="fdos">
							<br>
							<hr>
							<br>
							<section id="cuerpo">
                					<p><b>Nombre del diseñador: </b></p>
                						<?php echo "<input type='text' name='nombredisenador' value='".$designer."'><br>"?>
                					<p><b>Fecha de entrega de documentos e información al diseñador: </b></p>
                						<?php echo "<input type='date' name='fechaentrega' value='".$des_date."'><br>"?>
                					<p>Fotografías en alta resolución: </p>
                						<?php 
											if($media_fotos[0]==1)
											{
												echo "<input type='checkbox' name='fotografias' value='1' checked>";
											}
											else
											{
												echo "<input type='checkbox' name='fotografias' value='1'>";
											}
										?>
                						
                					<p>   Viñeta: </p>
                							<?php 
											if($media_fotos[1]==1)
											{
												echo "<input type='checkbox' name='viñeta' value='1' checked>";
											}
											else
											{
												echo "<input type='checkbox' name='viñeta' value='1'>";
											}
											?>
                								
                					<p>    Logotipos: </p>
                						<?php 
											if($media_fotos[1]==1)
											{
												echo "<input type='checkbox' name='logotipos' value='1' checked><br>";
											}
											else
											{
												echo "<input type='checkbox' name='logotipos' value='1'><br>";
											}
										?>
                								
                					<p><b>Lugar: </b></p>
                						<?php echo "<input type='text' name='lugar' value='".$des_place."'>"?>
                					<p><b> Fecha: </b></p>
                							<?php echo "<input type='date' name='fechaentrega2' value='".$des_place_date."'>"?>
                					<p><b> Hora: </b></p>
                						<input type='number' min='0' max='24' step='1' id='horas1' name='horariohoras' value=''>hrs<input type='number' min='0' max='60' step='5' id='minutos1' name='horariominutos' value=''>min<br>
                					<p><b>Leyenda, repertorio, etc. </b></p>
                						<?php echo "<input type='message' name='leyenda' value='".$repertory."'><br>"?>
                					<p><b>Fecha estimada de entrega del diseño: </b></p>
                						<?php echo "<input type='date' name='fechadiseño' value='".$prob_del_date."'><br>"?>
               						<p>Cartel: </p>
               							<?php 
											if($media_comp_array[0]==1)
											{
												echo "<input type='checkbox' name='cartel' value='1' checked>";
											}
											else
											{
												echo "<input type='checkbox' name='cartel' value='1'>";
											}
										?>
               							
               						<p> Para web: </p>
               							<?php 
											if($media_comp_array[1]==1)
											{
												echo "<input type='checkbox' name='web' value='1' checked>";
											}
											else
											{
												echo "<input type='checkbox' name='web' value='1'>";
											}
										?>
               							
               						<p> Cortesías: </p>
               							<?php 
											if($media_comp_array[2]==1)
											{
												echo "<input type='checkbox' name='cortesias'value='1' checked>";
											}
											else
											{
												echo "<input type='checkbox' name='cortesias'value='1'>";
											}
										?>
               							
               						<p> Programa de mano: </p>
               							<?php 
											if($media_comp_array[3]==1)
											{
												echo "<input type='checkbox' name='programamano' value='1' checked>";
											}
											else
											{
												echo "<input type='checkbox' name='programamano' value='1'>";
											}
										?>
               							
               						<p> Invitación: </p>
               							<?php 
											if($media_comp_array[4]==1)
											{
												echo "<input type='checkbox' name='invitacion'value='1' checked><br>";
											}
											else
											{
												echo "<input type='checkbox' name='invitacion'value='1'><br>";
											}
										?>
               							
       						</section>
						</div>	

						<!--//======================Elementos de: Entrega cartel y cortesias========================-->
						<div id="car-cor">
							<br>
							<hr>
							<br>
							<section id="cuerpo">
                					<p><b>Impresion digital: </b></p>
                						<?php echo "<input type='date' name='digital' value ='".$dig_print."'><br>"?>
                					<p><b>Impresion offset: </b></p>
                						<?php echo "<input type='date' name='offset' value ='".$offset_print."'><br>"?>
               						<p><b>Serigrafía: </b></p>
               							<?php echo "<input type='date' name='serigrafia' value ='".$serigraphy."'><br>"?>
                					<p><b>Por fuera: </b></p>
                						<?php echo "<input type='date' name='fuera' value ='".$out_date."'><br>"?>
               						<p><b>Fecha entrega programa de mano: </b></p>
               							<?php echo "<input type='date' name='programamano' value ='".$hand_prog_date."'><br>"?>
               						<p><b>Invitación: </b></p>
               							<?php echo "<input type='date' name='invitacion' value ='".$inv_date."'><br>"?>
                					<p><b>Volante: </b></p>
                						<?php echo "<input type='date' name='volante' value ='".$broshure."'><br>"?>
        					</section>
						</div>	

						<!--//======================Elementos de: Textos al corrector ========================-->
						<div id="tex-cor">
							<br>
							<hr>
							<br>
							<section id="cuerpo">
                					<p><b>Fecha de entrega de textos al corrector: </b></p>
                						<?php echo "<input type='date' name='fechacorrector' value='".$cortext_init_date."'><br>"?>
                					<p><b>Nombre del corrector de textos: </b></p>
                						<?php echo "<input type='text' name='nombre' value='".$cortext_name."'><br>"?>
                					<p><b>Fecha de entrega de textos del corrector de textos: </b></p>
                						<?php echo "<input type='date' name='entregacorrector' value='".$cortext_due_date."'><br>"?>
       						</section>
						</div>	

						<!--//======================Elementos de: fase 3========================-->
						<div id="ftres">
							<br>
							<hr>
							<br>
							<section id="cuerpo">
              						<p><b>Fecha estimada para que la difusión se encuentre en función, pegada , en redes sociales, blog y WhatsApp: </b></p>
              							<?php echo "<input type='date' name='fechadifusion' value='".$spread."'><br>"?>
              				</section>
						</div>	

						<!--//======================BOTONES DE CONFIRMACION Y ACCIONES DE BD========================-->
					<div id="fin">
						<br>
						<hr>
						<br>
						<p id='control'>
							<button id ='boton' type='submit' name='confirma' onclick="funciona();">Confirmar</button>
						</p>	
						<?php
							if($user->getCargo() == "Administrador")
							{
								echo "<a type='button' id = \"boton\" href=\"administracion.php\">Regresar</a><br>";
							}
						?>
					<?php

					if(isset($_POST['confirma']))
					{
						$servidor = "localhost";
            			$nombreusuario = "root";
            			$password = "QQWWEERR1";
            			$db = "prueba";
            			$conexion = new mysqli($servidor, $nombreusuario, $password, $db);
						if($conexion->connect_error)
						{
             			   die("Conexión fallida: " . $conexion->connect_error);
						}

						//:::::::::::::::::::::::::FASE 1:::::::::::::::::::::::::::::::::
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
						if(isset($_POST['disciplina']))
						{
							$disciplina = $_POST['disciplina'];
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

						$sql = "UPDATE `requerimientoactividad` SET `fechaProgramacion` = CURRENT_DATE() WHERE `idRequerimientoActividad` =".$id_req_act."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientoactividad` SET `fechaEvento` = '".$fechaeve."' WHERE `idRequerimientoActividad` =".$id_req_act."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientoactividad` SET `nombreCompania` ='".$nomcom."' WHERE `idRequerimientoActividad` =".$id_req_act."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientoactividad` SET `nombreActividad` ='".$nomact."' WHERE `idRequerimientoActividad` = ".$id_req_act."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientoactividad` SET `disciplina` ='".$disciplina."' WHERE `idRequerimientoActividad` =".$id_req_act."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientoactividad` SET `lugar` ='".$lugar."' WHERE `idRequerimientoActividad` =".$id_req_act."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientoactividad` SET `tipoEntrada` ='".$ticket_type."' WHERE `idRequerimientoActividad` =".$id_req_act."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientoactividad` SET `duracion` ='".$duracionh.":".$duracionm.":00' WHERE `idRequerimientoActividad` =".$id_req_act."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientoactividad` SET `horario` ='".$horariohoras.":".$horariominutos.":00' WHERE `idRequerimientoActividad` =".$id_req_act."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}


						//:::::::::::::::::::::::::REQUERIMIENTOS DISEÑO:::::::::::::::::::::::::::::::::

						if($_POST['entregareq'])
						{
							$fechaentrega = $_POST['entregareq'];
						}
						else{$fechaentrega = "";}
						/*if($_FILES['fotos']['tmp_name'])
						{
							$imagen = addslashes(file_get_contents($_FILES['fotos']['tmp_name']));
						}
						else{$imagen = "";}
						if($_FILES['logos']['tmp_name'])
						{
							$logo = addslashes(file_get_contents($_FILES['logos']['tmp_name']));
						}
						else{$logo = "";}*/
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


						$sql = "UPDATE `requerimientodiseno` SET `fechaEntrega` ='".$fechaentrega."' WHERE `idRequerimientoDiseno` =".$id_req_dis."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						/*$sql = "UPDATE `requerimientodiseno` SET `fotografia` ='".$imagen."' WHERE `idRequerimientoDiseno` =".$id_req_dis."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientodiseno` SET `logotipo` ='".$logo."' WHERE `idRequerimientoDiseno` =".$id_req_dis."";*/
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientodiseno` SET `semblanzaCompania` ='".$semblanzacom."' WHERE `idRequerimientoDiseno` =".$id_req_dis."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientodiseno` SET `semblanzaActividad` ='".$semblanzaact."' WHERE `idRequerimientoDiseno` =".$id_req_dis."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientodiseno` SET `programaMano` ='".$programamano."' WHERE `idRequerimientoDiseno` =".$id_req_dis."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::REQ TECNICO:::::::::::::::::::::::::::::::::

						if(isset($_POST['message']))
						{
							$requerimientotecnico = $_POST['message'];
						}else $requrimientotecnico ="";

						$sql = "UPDATE `requerimientotecnico` SET `requerimiento` ='".$requerimientotecnico."' WHERE `idRequerimientoTecnico` =".$id_req_tec."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::REQ PAGO:::::::::::::::::::::::::::::::::
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

						$sql = "UPDATE `requerimientopago` SET `requerimiento` ='".$requerimientos."' WHERE `idRequerimientoPago` =".$id_req_pago."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientopago` SET `fechaDocumentacion` ='".$fecha."' WHERE `idRequerimientoPago` =".$id_req_pago."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientopago` SET `fechaTentativa` ='".$fechapago."' WHERE `idRequerimientoPago` =".$id_req_pago."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::FASE 2:::::::::::::::::::::::::::::::::

						//$nombrediseñador = $_POST['nombredisenador'];
          		    	$entregaaldiseñador = $_POST['fechaentrega'];
                		//$fotos = $_POST['fotografias'];
                		//$viñeta = $_POST['vineta'];
                		//$logos = $_POST['logotipos'];
                		$lugar = $_POST['lugar'];
                		$fecha = $_POST['fechaentrega2'];
                		$Hora = $_POST['horariohoras'].":".$_POST['horariominutos'].":00";
                		$leyenda = $_POST['leyenda'];
                		$fechaentrega = $_POST['fechadiseño'];
                		$cartel = $_POST['cartel'];
                		$web = $_POST['web'];
                		$cortesias = $_POST['cortesias'];
                		$programa = $_POST['programamano'];
                		$invitacion = $_POST['invitacion'];
						
						//$sql = "UPDATE `fase2` SET `nombredisenador` ='".$nombrediseñador."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `fechaentra` ='".$entregaaldiseñador."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `fotos` ='".$fotos."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						//$sql = "UPDATE `fase2` SET `vineta` ='".$viñeta."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						//$sql = "UPDATE `fase2` SET `logos` ='".$logos."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `lugar` ='".$lugar."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `fecha` ='".$fecha."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `hora` ='".$Hora."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `leyenda` ='".$leyenda."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `fechasalida` ='".$fechaentrega."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `cartel` ='".$cartel."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `web` ='".$web."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `cortesias` ='".$cortesias."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `programa` ='".$programa."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `invitacion` ='".$invitacion."' WHERE `idfase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::CARTELES Y CORTESIAS:::::::::::::::::::::::::::::::::
						$digital = $_POST['digital'];
                		$offset = $_POST['offset'];
                		$serigrafia = $_POST['serigrafia'];
    		            $fuera = $_POST['fuera'];
   		            	$programa = $_POST['programamano'];
   		             	$invitacion = $_POST['invitacion'];
   			            $volante = $_POST['volante'];

   			            $sql= "UPDATE `cartelycortesias` SET `digital` ='".$digital."' WHERE `idcartelycortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `offset` ='".$offset."' WHERE `idcartelycortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `serigrafia` ='".$serigrafia."' WHERE `idcartelycortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `fuera` ='".$fuera."' WHERE `idcartelycortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `entregaprograma` ='".$programa."' WHERE `idcartelycortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `invitacion` ='".$invitacion."' WHERE `idcartelycortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `volante` ='".$volante."' WHERE `idcartelycortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::TEXTOS AL CORR:::::::::::::::::::::::::::::::::

						$fechacorrector = $_POST['fechacorrector'];
                		$nombre = $_POST['nombre'];
                		$fechaentrega = $_POST['entregacorrector'];

                		$sql= "UPDATE `corrector` SET `fechaentra` ='".$fechaentrega."' WHERE `idcorrector` =".$id_corrector."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `corrector` SET `nombrecorrector` ='".$nombre."' WHERE `idcorrector` =".$id_corrector."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `corrector` SET `fechasale` ='".$fechacorrector."' WHERE `idcorrector` =".$id_corrector."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::FASE 3:::::::::::::::::::::::::::::::::

						$difusion = $_POST['fechadifusion'];

						$sql= "UPDATE `difusion` SET `fechadifusion` ='".$difusion."' WHERE `idDifusion` =".$id_f3."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

               			echo "<script>alert('Datos actualizados con éxito'); </script>";
                    	echo "<script>window.location='administracion.php';</script>";
						$conexion->close();
					}
					?>
					</div>
				</form>
			</section>
		</div>
		</div>
	</body>
</html>