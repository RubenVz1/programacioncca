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
    $mysqli = new DBA();
	$conexion = $mysqli->connect();
    if (mysqli_connect_errno()) {
    	printf("Conexión a base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}

	function generateRandomString($length = 6)
	{
		$possibleChars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$pdfid = '';
		for($i = 0; $i < $length; $i++)
		{
			$rand = rand(0, strlen($possibleChars) - 1);
			$pdfid .= substr($possibleChars, $rand, 1);
		}
		return $pdfid;
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
    //---------------Variables a usar para el fetching de la base de datos y control de elementos
	
	//
	//TODOS LAS SIGUIENTES VARIABLES PODRIAN SER GUARDADAS EN UN ARREGLO,
	//PERO POR CUESTIONES DE ENTENDIMIENTOS LAS HE HECHO COMO ESTAN A CONTINUACION
    //

    $id_act = $_GET['id']; //<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<ID PRINCIPAL: ACTIVIDAD

  	$consulta= "SELECT * FROM actividad WHERE idActividad = ".$id_act;
	if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
        	$id_prog = $obj->idProgramacion;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
        	$id_dis = $obj->idDiseno;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
        	$id_dif = $obj->idDifusion;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
  		  }
    	$resultado->close();
    }

    $consulta= "SELECT * FROM diseno WHERE idDiseno = ".$id_dis;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$id_f2 = $obj->idFase2;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
        	$id_cartel = $obj->idCartelyCortesias;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
        	$id_corrector = $obj->idCorrector;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
  		  }
    	$resultado->close();
    }

    $consulta= "SELECT * FROM programacion WHERE idProgramacion = ".$id_prog;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$id_req_act = $obj->idRequerimientoActividad;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
    		$id_req_dis = $obj->idRequerimientoDiseno;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
   			$id_req_tec = $obj->idRequerimientoTecnico;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
    		$id_req_pago = $obj->idRequerimientoPago;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
  		  }
    	$resultado->close();
    }

    $consulta= "SELECT * FROM difusion WHERE idDifusion = ".$id_dif;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$id_f3 = $obj->idDifusion;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID  NOTA: (idDifusion = idDifusion)
  		  }
    	$resultado->close();
    }
    $i=0;
    $consulta= "SELECT * FROM fotografia WHERE idRequerimientoDiseno = ".$id_req_dis;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$id_foto[$i] = $obj->idFotografia;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
    		$i++;
    	}
    	$resultado->close();
    }
    $numfotos = $i;
    $i=0;
    $consulta= "SELECT * FROM horario WHERE idRequerimientoActividad = ".$id_req_act;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$id_horario[$i] = $obj->idHorario;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
    		$i++;
  		  }
    	$resultado->close();
    }
    $i=0;
    $consulta= "SELECT * FROM logotipo WHERE idRequerimientoDiseno = ".$id_req_dis;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$id_logo[$i] = $obj->idLogotipo;//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<Variable de ID
            $i++;
  		  }
    	$resultado->close();
    }
    $numlogos=$i;
    $i=0;
    //===================================VARIABLES UTILIZADAS PARA ACTUALIZACION================================

    $consulta= "SELECT * FROM requerimientoactividad WHERE idRequerimientoActividad = ".$id_req_act;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$event_date = $obj->fechaEvento;
    		$artist = $obj->nombreCompania;
    		$activity = $obj->nombreActividad;
    		$discipline = $obj->disciplina;
    		$fes_place = $obj->lugar;
    		$ticket_type = $obj->tipoEntrada;
    		$price = $obj->costo;
    		$duration = $obj->duracion;
    		$observation = $obj->observacion;
  		  }
    	$resultado->close();
    }


    //-----------------------------------------------

    $consulta= "SELECT * FROM requerimientodiseno WHERE idRequerimientoDiseno = ".$id_req_dis;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$delivery_date = $obj->fechaEntrega ;
    		$programano = $obj->programaMano ;
    		$artist_info = $obj->semblanzaCompania ;
    		$semblance = $obj->semblanzaActividad ;
            $pdfdiseno = $obj->direccionPdf;
            $worddiseno = $obj->word;
  		  }
    	$resultado->close();
    }

    //------------------------------------------------

    $consulta= "SELECT * FROM requerimientotecnico WHERE idRequerimientoTecnico = ".$id_req_tec;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$tech_req = $obj->requerimiento;
    		$tech_pdf = $obj->direccionPdf;
            $tech_word = $obj->word;
  		  }
    	$resultado->close();
    }

    //------------------------------------------------

    $consulta= "SELECT * FROM requerimientopago WHERE idRequerimientoPago = ".$id_req_pago;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$payment_req = $obj->requerimiento;
    		$doc_date = $obj->fechaDocumentacion;
    		$payment_date = $obj->fechaTentativa;
            $payment_pdf = $obj->direccionPdf;
            $payment_word = $obj->word;
            $payment_pic = $obj->imagen;
  		  }
    	$resultado->close();
    }

    //------------------------------------------------

    $consulta= "SELECT * FROM fase2 WHERE idFase2 = ".$id_f2;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$designer = $obj->nombreDisenador;
    		$des_date = $obj->fechaEntra;
   			//$media_photos = array($obj->fotos,$obj->vineta,$obj->logos);
    		//$des_place = $obj->lugar;
   		 	//$des_place_date = $obj->fecha;
    		//$des_place_time = $obj->hora;
    		//$repertory = $obj->leyenda;
    		$prob_del_date = $obj->fechaSalida;
    		$media_comp_array = array($obj->cartel,$obj->web,$obj->cortesias,$obj->programa,$obj->invitacion);
  		  }
    	$resultado->close();
    }

    //-------------------------------------------------

    $consulta= "SELECT * FROM cartelycortesias WHERE idCartelyCortesias = ".$id_cartel;
    if ($resultado = $conexion->query($consulta)) {
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

    $consulta= "SELECT * FROM corrector WHERE idCorrector = ".$id_corrector;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$cortext_init_date = $obj->fechaEntra;
    		$cortext_name = $obj->nombreCorrector;
    		$cortext_due_date = $obj->fechaSale;
  		  }
    	$resultado->close();
    }

    //-----------------------------------------------

    $consulta= "SELECT * FROM difusion WHERE idDifusion = ".$id_dif;
    if ($resultado = $conexion->query($consulta)) {
    	while ($obj = $resultado->fetch_object()) {
    		$spread = $obj->fechaDifusion;
  		  }
    	$resultado->close();
    }
    //---------------------------------------------
    $i=0;
    while(isset($id_horario[$i]))
    {
    	$consulta= "SELECT * FROM horario WHERE idHorario = ".$id_horario[$i];
    	if ($resultado = $conexion->query($consulta)) {
    		while ($obj = $resultado->fetch_object()) {
    			$timef1[$i] = $obj->horario;
  			  }
    		$resultado->close();
    	}
        $i++;
    }

    for($i=0;$i<$numfotos;$i++)
    {
        for($j=0;$j<3;$j++)
        {
            if($j==0)
            {
                $cont_foto[$i][$j] = 0;
            }
            else if($j==1)
            {
                $cont_foto[$i][$j] = $id_foto[$i];
            }
            else
            {
                $consulta= "SELECT * FROM fotografia WHERE idFotografia = ".$id_foto[$i];
                if ($resultado = $conexion->query($consulta)) {
                while ($obj = $resultado->fetch_object()) {
                    $cont_foto[$i][$j] = $obj->fotografia;
                    }
                    $resultado->close();
                }
            }
        }
    }

    for($i=0;$i<$numlogos;$i++)
    {
        for($j=0;$j<2;$j++)
        {
            if($j==0)
            {
                $cont_logo[$i][$j] = 0;
            }
            else if($j==1)
            {
                $cont_logo[$i][$j] = $id_logo[$i];
            }
            else
            {
                $consulta= "SELECT * FROM logotipo WHERE idLogotipo = ".$id_logo[$i];
                if ($resultado = $conexion->query($consulta)) {
                while ($obj = $resultado->fetch_object()) {
                    $cont_logo[$i][$j] = $obj->logotipo;
                    }
                    $resultado->close();
                }
            }
        }
    }

    $hcount=0;

    $conexion->close();
?>
<!DOCTYPE html>
<html lang = "es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Actualización de datos</title>

		<!--<link rel="stylesheet" href="../styles/Fase1c.css">-->
		<link href="../images/icon.ico" type="image/ico" rel="shortcut icon">
		<script src="../js/jquery.min.js"></script>
		<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="../styles/actualizacionStyle.css">
	</head>
	<!-- DECLARACION DE VARIABLES EN JS -->
	<?php
		for($i=0;$i<3;$i++)
		{
			if(isset($id_horario[$i]))
			{
				$hcount++;
			}
		}
        for($i=0;$i<3;$i++)
        {
            if(!isset($timef1[$i]))
            {
                $timef1[$i] = NULL;
            }
        }
	?>

	<script>
		var js_price = "<?php echo $price; ?>";
		var js_hcount = "<?php echo $hcount;?>";
        var js_payment_date = "<?php echo $payment_date;?>";
        var js_numfotos = "<?php echo $numfotos;?>";
        var js_numlogos = "<?php echo $numlogos;?>";
        var js_timef1_1 = "<?php echo $timef1[0];?>";
        var js_timef1_2 = "<?php echo $timef1[1];?>";
        var js_timef1_3 ="<?php echo $timef1[2];?>";
	</script>

	<!-- <script src="../js/fase1a.js"></script>
	<script src="../js/reqdiseño.js"></script>
	<script src="../js/reqpag.js"></script> -->

	<body>
		<div id="inicioSesion">
			<section id="cabecera" style="font-size: 25px;">
				<h1 id="h1pro" >Actualización</h1>
			</section>
			
			<section id="cuerpo">

				<form id="pro" method="post" action="" enctype="multipart/form-data">
                    <div id="franja">Programación</div>
                    <br>
					<p id="diadehoy"><b>Fecha de actualización:</b> </p>
					<br>
					<p id="fcheve"><b>Fecha del evento: </b></p>
					<?php echo "<input type='date' id='fch' name='fechaeve' value='".$event_date."'><br>"?>
					<div id="retraso"></div>

						<!--//======================Elementos de: Requerimentos fase 1========================-->

						<p><b>Nombre de la la compañía, grupo, artista, ponente, ciclo, etc: </b></p>
						<?php echo"<input type='text' id='compañia' name='nomcom' value='".utf8_encode($artist)."' ><br>"?>

						<p><b>Nombre de la actividad: </b></p>
							<?php echo "<input type='text' id='actividad' name='nomact' value='".utf8_encode($activity)."'><br>"?>
						<p><b>Disciplina: </b></p>
							<?php echo "<input type='text' id='disc' name='disciplina' value='".utf8_encode($discipline)."'><br>"?>
						<p><b>Lugar: </b></p>
							<?php echo "<input type='text' id='place' name='lugar' value='".utf8_encode($fes_place)."'><br>"?>
						<br>
						<p><b>Horario(s): </b></p>

                        <?php 

                            echo "<input type=\"hidden\" name=\"numeroHorarios\" id=\"numeroHorarios\" value=".$hcount." size=\"1\" ><br><br>";
                        ?>
                        <button type="button" id="mas">Agregar</button>
                        <button type="button" id="menos">Quitar</button>

                        <?php 
                            $tiempo = $timef1[0];
                               echo "<div id='agrhor'>
                                <input type='number' min='0' max='24' step='1' id='horas1' name='horariohoras1' value='".$tiempo[0].$tiempo[1]."' required> hrs <input type='number' min='0' max='60' step='5' id='minutos1' name='horariominutos1' value='".$tiempo[3].$tiempo[4]."' required> min
                                </div>";
                        ?>

						<br>
						<p><b>Tipo de entrada:   </b></p>
							<?php 
								if($ticket_type=='1')
								{
                                    echo "<p>  libre: </p><p id='nobox1'></p><p id='silbr'>";
									echo "<input id='lbr' type='checkbox' name='elibre' value='3' checked>";
								}
								else
								{
                                    echo "<p>  libre: </p><p id='nobox1'><p id='croxbox1'><b> X </b></p></p><p id='silbr'>";
									echo "<input id='lbr' type='checkbox' name='elibre' value='3'>";
                                    echo "<script>document.getElementById('lbr').style.display = 'none' </script>";
								}
							?>	
							</p>
							
							<?php 
								if($ticket_type=='2')
								{
                                    echo "<p>  cortesia: </p><p id='nobox2'></p><p id='sicort'>";
									echo "<input type='checkbox' id='cort'name='ecortesia' value='2' checked>";
								}
								else
								{
                                    echo "<p>  cortesia: </p><p id='nobox2'><p id='croxbox2'><b> X </b></p></p><p id='sicort'>";
									echo "<input type='checkbox' id='cort'name='ecortesia' value='2' >";
                                    echo "<script>document.getElementById('cort').style.display = 'none' </script>";
								}
							?>	

							<?php 
								if($ticket_type=='3')
								{
                                    echo "<p>  costo: </p><p id='nobox3'></p><p id='sicst'>";
									echo "<input type='checkbox' id='cst' name='ecosto' value='1' checked>";
                                    echo "<div id='cstvalor'><div id='si'><p><b>Costo: </b>$</p><input type='number' name='costo' value='".$price."'><br></div></div>";
								}
								else
								{
                                    echo "<p>  costo: </p><p id='nobox3'><p id='croxbox3'><b> X </b></p></p><p id='sicst'>";
									echo "<input type='checkbox' id='cst' value='1' name='ecosto' >";
                                    echo "<script>document.getElementById('cst').style.display = 'none' </script>";
                                    echo "<div id='cstvalor'></div>";
								}
							?>	
							</p><br>
							<script src="../js/act_fase1a.js"></script>
							<p><b>Duracion: </b></p>
							<?php
								echo "<input type='number' id='durh' name='duracionh' min='0' max='5' step='1' value='".$duration[0].$duration[1]."'>
							<p>horas</p>
								<input type='number' id='durmin' min='0' max='60' step='5' name='duracionm' value='".$duration[3].$duration[4]."' >
							<p>minutos</p><br>";
							?>
							<br>


						<!--//======================Elementos de: Requerimentos diseño========================-->
						<div id="req-dis">
                            <script src='../js/act_reqdiseno.js'></script> <!--  ===============OJO-->

							<br>
							<div id="franja">Requerimientos de diseño</div>
							<br>
							<section id="cuerpo">
								<!--<form id="reqdis" method="post" action="" enctype="multipart/form-data">-->
								<p><b>Fecha de entrega:  </b></p>
									<?php 
                                        echo"<input type='date' name='entregareq' value='".$delivery_date."'><br><br>"
                                    ?>
                                <br>
                                <?php
                                    if($programano == '0')
                                    {
                                        echo " <p><b>Programa de mano: </b></p><input type='checkbox' id='programamano' name='programamano' value='1'><br><br>
                                        <div id='progman'></div>";
                                    }
                                    else
                                    {
                                        echo " <p><b>Programa de mano: </b></p><input type='checkbox' id='programamano' name='programamano' value='1' checked><br><br>

                                        <div id='semblanzas'><p><b>Semblanza de la compañía grupo, artista, ponente,ciclo, etc:</b></p><br>
                                        <textarea name='semcom' rows='5' cols='30'>".$artist_info."</textarea><br>
                                        <p><b>Semblanza de la actividad:</b></p><br>
                                        <textarea name='semact' rows='5' cols='30'>".$semblance."</textarea><br></div>

                                        <div id='progman'></div>";
                                    }
                                ?>

                                    <br><br><p><b>Word de Requerimientos de Diseño:</b></p><br>
                                        <?php
                                            if(isset($worddiseno))
                                            {
                                                echo "<br><a href='".$worddiseno."' target='_blank' id='wordlink' name='wordlink'>".substr($worddiseno,17)."</a><br>";
                                            }
                                        ?>
                                        <p><b>Actualizar Word: <b></p><input name='word' type='file' accept='application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword'>
                                        <br><br>
                                    <br><br><p><b>PDF de Requerimientos de Diseño:</b></p><br>
                                        <?php
                                            if(isset($pdfdiseno))
                                            {
                                                echo "<br><a href='".$pdfdiseno."' target='_blank' id='pdfdlink' name='pdfdlink'>".substr($pdfdiseno,16)."</a><br>";
                                            }
                                        ?>
                                        <p><b>Actualizar PDF: <b></p><input name='pdfdis' type='file' accept='application/pdf'>
                                        <br>
                                <br>

                                <br><div id="franja">Fotografías</div><br>
								<!--<p><h2>Fotografia(s)</h2></p><br><br>-->
                                <input type="hidden" name="numeroImagenes" id="numeroImagenes" value="0" size="1" >
								
								<?php
									$db = new DB();
									$query = $db->connect()->prepare("SELECT f.fotografia
                                                      FROM actividad a, programacion p, requerimientodiseno r, fotografia f
                                                      WHERE a.idProgramacion = p.idProgramacion
                                                      AND p.idRequerimientoDiseno = r.idRequerimientoDiseno
                                                      AND f.idRequerimientoDiseno = r.idRequerimientoDiseno 
                                                      AND a.idActividad = $id_act;");
                    				$query->execute();
                    				$query->setFetchMode(PDO::FETCH_NUM);
                    				$result = $query->fetchAll();
                    				for($i = 0 ; $i < count($result) ; $i++)
                    				{   
                        				echo "<div id='foto".($i+1)."'><p style='font-size: 20px;'><b>Fotografia ".($i+1).":</b><br><br><img height='150px' src='".$result[$i][0]."'></p><br><p style= 'color: red;'><b>Eliminar: </b></p><input type='checkbox' name='efoto".($i+1)."' value='".($i+1)."'><input type='hidden' id='".($i+1)."' value='0'><br><br>";
                        				echo "<a href='".$result[$i][0]."' target='_blank'>".substr($result[$i][0],18)."</a><br><br></div><hr><br>";
                    				}
								?>
                                    <br>
                                    <p><b>Agregar más imágenes: </b></p>
									<input id="masImagenes" name="masImagenes" type="button" value="+">
                                    <p><b>Quitar: </b></p>
									<input id="menosImagenes" name="menosImagenes" type="button" value="--"><br>
									<div id="imagenes">
									</div>
                                <br>
                                <br>
                                <div id="franja">Logotipos</div>
								<!--<p><h2>Logotipo(s)</h2></p><br><br>-->
                                <input type="hidden" name="numeroLogos" id="numeroLogos" value="0" size="1" ><br>
                                <br>
                                <?php
                                    $query2 = $db->connect()->prepare("SELECT l.logotipo
                                                      FROM actividad a, programacion p, requerimientodiseno r, logotipo l
                                                      WHERE a.idProgramacion = p.idProgramacion
                                                      AND p.idRequerimientoDiseno = r.idRequerimientoDiseno
                                                      AND l.idRequerimientoDiseno = r.idRequerimientoDiseno 
                                                      AND a.idActividad = $id_act;");
                                    $query2->execute();
                                    $query2->setFetchMode(PDO::FETCH_NUM);
                                    $result2 = $query2->fetchAll();
                                    for($i = 0 ; $i < count($result2) ; $i++)
                                    {
                                        echo "<div id='logo".($i+1)."'><p style='font-size: 20px;'><b>Logotipo ".($i+1).":</b><br><br><img height='150px' src='".$result2[$i][0]."'></p><br><p style= 'color: red;'><b>Eliminar: </b></p><input type='checkbox' name='elogo".($i+1)."' value='".($i+1)."'><input type='hidden' id='".($i+1)."' value='0'><br><br>";
                                        echo "<a href='".$result2[$i][0]."' target='_blank'>".substr($result2[$i][0],18)."</a><br><br></div><hr><br>";
                                    }
                                ?>
                                    <p><b>Agregar más logotipos: </b></p>
									<input id="masLogos" name="masLogos" type="button" value="+">
                                    <p><b>Quitar: </b></p>
									<input id="menosLogos" name="menosLogos" type="button" value="--"><br>
									<div id="logos">
									</div>
                                    <br>
								<!-- <p><b>Fotografias en alta resolucion:  </b></p>
									<input type='file' name='fotos'><br>
								<p><b>Logotipos: </b></p>
									<input type='file' name='logos'><br><br>
								<p><b>Programa de mano: </b></p>
									<input type='checkbox' id='pm' name='programamano' value='1'><br>
								<div id="cstvalor"></div> -->

								<!--</form>-->
							</section>
							<script src="../js/act_reqdiseno.js"></script> <!-- =============OJO CON SCRIPT============= -->
						</div>	

                        <!--//======================Elementos de: Requerimentos Fase 2========================-->
                        <div id="fdos">
                            <br>
                            <div id="franja">Información de diseñador</div>
                            <br>
                            <section id="cuerpo">
                                    <p><b>Nombre del diseñador: </b></p>
                                    <?php 
                                        $test = utf8_encode($designer);
                                        echo "<input type='text' name='nombredisenador' value='".$test."'><br>"
                                    ?>
                                    <p><b>Fecha de entrega de documentos e información al diseñador: </b></p>
                                        <?php echo "<input type='date' name='fechaentrega' value='".$des_date."'><br>"?>
                                    <p><b>Fecha estimada de entrega del diseño: </b></p>
                                        <?php echo "<input type='date' name='fechadiseño' value='".$prob_del_date."'><br>"?>
                                    <p>Cartel: </p>
                                        <?php 
                                            if($media_comp_array[0]>0)
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
                                            if($media_comp_array[1]>0)
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
                                            if($media_comp_array[2]>0)
                                            {
                                                echo "<input type='checkbox' name='cortesias' value='1' checked>";
                                            }
                                            else
                                            {
                                                echo "<input type='checkbox' name='cortesias' value='1'>";
                                            }
                                        ?>
                                        
                                    <p> Programa de mano: </p>
                                        <?php 
                                            if($media_comp_array[3]>0)
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
                                            if($media_comp_array[4]>0)
                                            {
                                                echo "<input type='checkbox' name='invitacion' value='1' checked><br>";
                                            }
                                            else
                                            {
                                                echo "<input type='checkbox' name='invitacion' value='1'><br>";
                                            }
                                        ?>
                                        
                            </section>
                        </div>  
						<!--//======================Elementos de: Requerimentos tecnicos========================-->
						<div id="req-tec">
							<br>
							<div id="franja">Requerimientos técnicos</div>
							<br>
							<section id="cuerpo">
								<div id="reqtec">
									<p><b>Requerimientos técnicos</b></p><br>
									<textarea name='message' rows='5' cols='30'><?php echo utf8_encode($tech_req); ?></textarea><br>
									<br>
                                    <br><p><b>Word de Requerimientos Técnicos:</b></p><br>
                                        <?php
                                            if(isset($tech_word))
                                            {
                                                echo "<br><a href='".$tech_word."' target='_blank' id='techwordlink' name='techwordlink'>".substr($tech_word,17)."</a><br>";
                                            }
                                        ?>
                                        <p><b>Actualizar Word: <b></p><input name='techword' type='file' accept='application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword'>
                                        <br><br><br>
									<p><b>PDF de Requerimientos Técnicos</b></p><br>
									<?php
										if(isset($tech_pdf))
										{
											echo "<br><a href='".$tech_pdf."' target='_blank' id='pdflink' name='pdflink'>".substr($tech_pdf,16)."</a><p>   </p><br>
												<p>Actualizar: </p><input id='pdf' name='pdf' type='file' accept='application/pdf'><br><br>
												";
                                            //echo "<p>Eliminar: </p><button type='button' id='eliminapdf' name='eliminapdf'>Eliminar</button>";
										}
										else
										{
											echo "<input id='pdf' name='pdf' type='file' accept='application/pdf'><br>";
										}

									?>
                                    
									<br>
								</div>
							</section>
						</div>	

						<!--//======================Elementos de: Requerimentos pagos========================-->
						<div id="req-pag">
							<br>
							<div id="franja">Requerimientos de pagos</div>
							<br>
							<section id="cuerpo">
									<div id="reqpag">
										<p><b>Requerimientos de pagos</b></p><br>
										<textarea name='req' rows='5' cols='30'><?php echo $payment_req; ?></textarea><br>
										<p><b>Fecha en que cubrió toda la documentación:  </b></p>
										<?php echo "<input type='date' name='documentacionok' value='".$doc_date."'>"?>
										<?php
											if($doc_date!='0000-00-00')
											{
												echo "<input type='checkbox' id='wow' name='wow' value='1' checked><br>";
                                                echo "<div id='aqui' name='aqui'><div name='paydate' id='paydate'><p><b>Fecha tentativa de pago:</b> </p><input type='date' name='fechapago' value='".$payment_date."'><br><br><div></div>";
											}
											else
											{
												echo "<input type='checkbox' id='wow' name='wow' value='1'><br>";
                                                echo "<div id='aqui' name='aqui'></div>";
											}
										?>
                                        <br><br><p><b>Word de Requerimientos de Pagos:</b></p><br>
                                        <?php
                                            if(isset($payment_word))
                                            {
                                                echo "<br><a href='".$payment_word."' target='_blank' id='paywordlink' name='paywordlink'>".substr($payment_word,17)."</a><br>";
                                            }
                                        ?>
                                        <p><b>Actualizar Word: <b></p><input name='payword' type='file' accept='application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword'>
                                        <br><br>
                                    <br><br><p><b>PDF de Requerimientos de Pagos:</b></p><br>
                                        <?php
                                            if(isset($payment_pdf))
                                            {
                                                echo "<br><a href='".$payment_pdf."' target='_blank' id='paypdfdlink' name='paypdfdlink'>".substr($payment_pdf,16)."</a><br>";
                                            }
                                        ?>
                                        <p><b>Actualizar PDF: <b></p><input name='paypdf' type='file' accept='application/pdf'>

                                        <br><br><p><b>Imagen:</b></p><br><br>
                                        <?php
                                            if(isset($payment_pic))
                                            {
                                                echo "<div id='paymentpic'><img height='150px' src='".$payment_pic."'><br><br>";
                                                echo "<a href='".$payment_pic."' target='_blank'>".substr($payment_pic,18)."</a><br><br></div>";
                                            }
                                            
                                        ?>
                                        <p><b>Actualizar Imagen: <b></p><input name='paypic' type='file' accept='image/x-png,image/gif,image/jpeg'>
                                        <script src="../js/act_reqpago.js"></script>
										<!--
										<p>Fecha tentativa de pago</p><input type="date" name="fechapago" value=""><br>
               							 <br>
										-->
               							 <br><br>
									</div>
								<!-- ======OJO CON SCRIPT====== -->
							</section>
						</div>	

						

						<!--//======================Elementos de: Entrega cartel y cortesias========================-->
						<div id="car-cor">
							<br>
							<div id="franja">Entrega de cartel y cortesias</div>
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
               							<?php echo "<input type='date' name='programamanofecha' value ='".$hand_prog_date."'><br>"?>
               						<p><b>Invitación: </b></p>
               							<?php echo "<input type='date' name='invitacionfecha' value ='".$inv_date."'><br>"?>
                					<p><b>Volante: </b></p>
                						<?php echo "<input type='date' name='volante' value ='".$broshure."'><br>"?>
        					</section>
						</div>	

						<!--//======================Elementos de: Textos al corrector ========================-->
						<div id="tex-cor">
							<br>
							<div id="franja">Textos al corrector</div>
							<br>
							<section id="cuerpo">
                					<p><b>Fecha de entrega de textos al corrector: </b></p>
                						<?php echo "<input type='date' name='fechacorrector' value='".$cortext_init_date."'><br>"?>
                					<p><b>Nombre del corrector de textos: </b></p>
                						<?php echo "<input type='text' name='nombre' value='".utf8_encode($cortext_name)."'><br>"?>
                					<p><b>Fecha de entrega de textos del corrector de textos: </b></p>
                						<?php echo "<input type='date' name='entregacorrector' value='".$cortext_due_date."'><br>"?>
       						</section>
						</div>	

						<!--//======================Elementos de: fase 3========================-->
						<div id="ftres">
							<br>
							<div id="franja">Fechas de difusión</div>
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
                        <?php
                            if($user->getCargo() == "Administrador")
                            {
                                echo "<a type='button' id = \"boton\" href=\"administracion.php\" style='margin: 10px'> Regresar </a>";
                            }
                        ?>
						<p id='control'>
							<button id ='botonconfirma' type='submit' name='confirma' onclick="funciona();"><b> Confirmar </b></button>
						</p>	
					<?php

					if(isset($_POST['confirma']))
					{
						$mysqli = new DBA();
						$conexion = $mysqli->connect();
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
                            $horarios[($i-1)] = $horarioHoras.":".$horarioMinutos.":00";
                        }

                        for($i = 0; $i < 3; $i++)
                        {
                            $hrk = $horarios[$i];
                            if(isset($id_horario[$i])&&isset($horarios[$i]))
                            {
                                
                                $sql = "UPDATE `horario` SET `horario` = '$hrk' WHERE `idRequerimientoActividad` =".$id_req_act." AND `idHorario` =".$id_horario[$i];
                                if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
                            }
                            if(!(isset($id_horario[$i]))&&isset($horarios[$i]))
                            {
                                $sql = "INSERT INTO `horario`(`horario`, `idRequerimientoActividad`) VALUES ('$hrk','$id_req_act');";
                                $resultado = $conexion->query($sql);
                            }
                            if((isset($id_horario[$i]))&&!isset($horarios[$i]))
                            {
                                $sql = "DELETE FROM `horario` WHERE `idHorario` =".$id_horario[$i];
                                $resultado = $conexion->query($sql);
                            }
                        }

						if(isset($_POST['elibre']))
						{
							$ticket_type = 1;
						}
						if(isset($_POST['ecortesia']))
						{
							$ticket_type = 2;
						}
						if(isset($_POST['ecosto']))
						{
							$ticket_type = 3;
						}
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
                        $sql = "UPDATE `requerimientoactividad` SET `costo` ='".$costo."' WHERE `idRequerimientoActividad` =".$id_req_act."";
                        if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientoactividad` SET `duracion` ='".$duracionh.":".$duracionm.":00' WHERE `idRequerimientoActividad` =".$id_req_act."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}


						//:::::::::::::::::::::::::REQUERIMIENTOS DISEÑO:::::::::::::::::::::::::::::::::

						if($_POST['entregareq'])
						{
							$fechaentrega = $_POST['entregareq'];
						}
						else{$fechaentrega = "";}
						if(isset($_POST['semcom']))
						{
							$semblanzacom = utf8_decode($_POST['semcom']);
						}
						else{$semblanzacom = "";}
						if(isset($_POST['semact']))
						{
							$semblanzaact = utf8_decode($_POST['semact']);
						}
						else{$semblanzaact = "";}
						if(isset($_POST['programamano']))
						{
							$programamano = "1";
						}
						else{$programamano = "0";}   

                        if($_FILES['word']['tmp_name'])
                        {
                            unlink($worddiseno);
                            $requerimientodisenoWord = $_FILES['word']['name'];
                            $direccionWord = "../words/".generateRandomString()."__".$requerimientodisenoWord;
                            move_uploaded_file($_FILES['word']['tmp_name'],$direccionWord);
                        }
                        else
                        {
                            $direccionWord = $worddiseno;
                        }

                        $sql = "UPDATE `requerimientodiseno` SET `word` ='".$direccionWord."' WHERE `idRequerimientoDiseno` =".utf8_encode($id_req_dis)."";
                            if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

                        if($_FILES['pdfdis']['tmp_name'])
                        {
                            unlink($pdfdiseno);
                            $requerimientodisenoPdf = $_FILES['pdfdis']['name'];
                            $dirPdfDis = "../pdfs/".generateRandomString()."__".$requerimientodisenoPdf;
                            move_uploaded_file($_FILES['pdfdis']['tmp_name'],$dirPdfDis);
                        }
                        else
                        {
                            $dirPdfDis = $pdfdiseno;
                        }

                        $sql = "UPDATE `requerimientodiseno` SET `direccionPdf` ='".$dirPdfDis."' WHERE `idRequerimientoDiseno` =".utf8_encode($id_req_dis)."";
                            if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						$sql = "UPDATE `requerimientodiseno` SET `fechaEntrega` ='".$fechaentrega."' WHERE `idRequerimientoDiseno` =".$id_req_dis."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//ELIMINANDO FOTOS Y LOGOS DE BD

                        for($i=1;$i<=$numfotos;$i++)
                        {
                            $auxn = "efoto".$i;
                            if(!empty($_POST[$auxn]))
                            {
                                $cont_foto[($i-1)][0]=1;
                            }
                        }

                        for($i=0;$i<$numfotos;$i++)
                        {
                            if($cont_foto[$i][0]==1)
                            {
                                $sql = "DELETE FROM `fotografia` WHERE `idFotografia` ='".utf8_encode($cont_foto[$i][1])."'";
                                if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

                                unlink($cont_foto[$i][2]);
                            }
                        }

                        for($i=1;$i<=$numlogos;$i++)
                        {
                            $auxn = "elogo".$i;
                            if(!empty($_POST[$auxn]))
                            {
                                $cont_logo[($i-1)][0]=1;
                            }
                        }

                        for($i=0;$i<$numlogos;$i++)
                        {
                            if($cont_logo[$i][0]==1)
                            {
                                $sql = "DELETE FROM `logotipo` WHERE `idLogotipo` ='".utf8_encode($cont_logo[$i][1])."'";
                                if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

                                unlink($cont_logo[$i][2]);
                            }
                        }
                        $numeroImagenes = $_POST['numeroImagenes'];
                        for($i = 0; $i < $numeroImagenes; $i++)
                        {
                            $nombre = "uphoto".($i+1);
                            if($_FILES[$nombre]['tmp_name'])
                            {
                                if(!isImageValid($_FILES[$nombre]))
                                {
                                    echo "<script>alert('La imagen ".($i+1)." tiene un formato invalido, no se guardara en la base de datos')</script>";
                                    $imagenes[$i] = "";
                                    continue;
                                }
                                $imagen = "../images/".generateRandomString()."__".$_FILES[$nombre]['name'];
                                move_uploaded_file($_FILES[$nombre]['tmp_name'],$imagen);
                                $imagenes[$i] = $imagen;

                            }
                            else
                            {
                                $imagenes[$i] = "";
                            }
                        }
                        $numeroLogos = $_POST['numeroLogos'];
                        for($i = 0; $i < $numeroLogos; $i++)
                        {
                            $nombre = "ulog".($i+1);
                            if($_FILES[$nombre]['tmp_name'])
                            {
                                if(!isImageValid($_FILES[$nombre]))
                                {
                                    echo "<script>window.location='actualizacion.php';</script>";
                                    $logos[$i] = "";
                                    continue;
                                }
                                $logo = "../images/".generateRandomString()."__".$_FILES[$nombre]['name'];
                                move_uploaded_file($_FILES[$nombre]['tmp_name'],$logo);
                                $logos[$i] = $logo;
                            }
                            else
                            {
                                $logos[$i] = "";
                            }
                        }
                        if($numeroImagenes != 0)
                        {
                            for($i = 0; $i < $numeroImagenes; $i++)
                            {
                                if($imagenes[$i] != "")
                                {
                                    $imgk = $imagenes[$i];
                                    $sql = "INSERT INTO `fotografia` (`fotografia`, `idRequerimientoDiseno`) VALUES ('".$imgk."','".$id_req_dis."')";
                                    $resultado = $conexion->query($sql);
                                }
                            }
                        }
                        if($numeroLogos != 0)
                        {
                            for($i = 0; $i < $numeroLogos; $i++)
                            {
                                if($logos[$i] != "")
                                {
                                    $logok = $logos[$i];
                                    $sql = "INSERT INTO `logotipo` (`logotipo`, `idRequerimientoDiseno`) VALUES ('".$logok."','".$id_req_dis."')";
                                    $resultado = $conexion->query($sql);
                                }
                            }
                        }
                        //---
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientodiseno` SET `semblanzaCompania` ='".utf8_encode($semblanzacom)."' WHERE `idRequerimientoDiseno` =".$id_req_dis."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientodiseno` SET `semblanzaActividad` ='".utf8_encode($semblanzaact)."' WHERE `idRequerimientoDiseno` =".$id_req_dis."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientodiseno` SET `programaMano` ='".$programamano."' WHERE `idRequerimientoDiseno` =".$id_req_dis."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::REQ TECNICO:::::::::::::::::::::::::::::::::

						if(isset($_POST['message']))
						{
							$requerimientotecnico = utf8_decode($_POST['message']);
						}else $requrimientotecnico ="";

                        if($_FILES['techword']['tmp_name'])
                        {
                            unlink($tech_word);
                            $requerimientotecnicoWord = $_FILES['techword']['name'];
                            $direccionWord = "../words/".generateRandomString()."__".$requerimientotecnicoWord;
                            move_uploaded_file($_FILES['techword']['tmp_name'],$direccionWord);
                        }
                        else
                        {
                            $direccionWord = $tech_word;
                        }

                        $sql = "UPDATE `requerimientotecnico` SET `word` ='".$direccionWord."' WHERE `idRequerimientoTecnico` =".utf8_encode($id_req_tec)."";
                            if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

                        if($_FILES['pdf']['tmp_name'])
                        {
                            unlink($tech_pdf);
                            $requerimientotecnicoPdf = $_FILES['pdf']['name'];
                            $direccionPdf = "../pdfs/".generateRandomString()."__".$requerimientotecnicoPdf;
                            move_uploaded_file($_FILES['pdf']['tmp_name'],$direccionPdf);
                        }
                        else
                        {
                            $direccionPdf = $tech_pdf;
                        }

                        $sql = "UPDATE `requerimientotecnico` SET `direccionPdf` ='".$direccionPdf."' WHERE `idRequerimientoTecnico` =".utf8_encode($id_req_tec)."";
                            if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}


						$sql = "UPDATE `requerimientotecnico` SET `requerimiento` ='".$requerimientotecnico."' WHERE `idRequerimientoTecnico` =".utf8_encode($id_req_tec)."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::REQ PAGO:::::::::::::::::::::::::::::::::
						if(isset($_POST['req']))
						{
							$requerimientos = utf8_decode($_POST['req']);
						}else $requerimientos="";
						if(isset($_POST['documentacionok']))
						{
							$fecha = $_POST['documentacionok'];
						}else $fecha="";
						if(isset($_POST['fechapago']))
						{
							$fechapago=$_POST['fechapago'];
						}else $fechapago="";

                        if($_FILES['payword']['tmp_name'])
                        {
                            unlink($payment_word);
                            $requerimientopagoWord = $_FILES['payword']['name'];
                            $direccionWord = "../words/".generateRandomString()."__".$requerimientopagoWord;
                            move_uploaded_file($_FILES['payword']['tmp_name'],$direccionWord);
                        }
                        else
                        {
                            $direccionWord = $payment_word;
                        }

                        $sql = "UPDATE `requerimientopago` SET `word` ='".$direccionWord."' WHERE `idRequerimientoPago` =".utf8_encode($id_req_pago)."";
                            if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

                        if($_FILES['paypdf']['tmp_name'])
                        {
                            unlink($payment_pdf);
                            $requerimientopagoPdf = $_FILES['paypdf']['name'];
                            $direccionPdf = "../pdfs/".generateRandomString()."__".$requerimientopagoPdf;
                            move_uploaded_file($_FILES['paypdf']['tmp_name'],$direccionPdf);
                        }
                        else
                        {
                            $direccionPdf = $payment_pdf;
                        }

                        $sql = "UPDATE `requerimientopago` SET `direccionPdf` ='".$direccionPdf."' WHERE `idRequerimientoPago` =".utf8_encode($id_req_pago)."";
                            if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

                        if($_FILES['paypic']['tmp_name'])
                        {
                            unlink($payment_pic);
                            $requerimientopagoImage = $_FILES['paypic']['name'];
                            $direccionImage = "../images/".generateRandomString()."__".$requerimientopagoImage;
                            move_uploaded_file($_FILES['paypic']['tmp_name'],$direccionImage);
                        }
                        else
                        {
                            $direccionImage = $payment_pic;
                        }

                        $sql = "UPDATE `requerimientopago` SET `imagen` ='".$direccionImage."' WHERE `idRequerimientoPago` =".utf8_encode($id_req_pago)."";
                            if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						$sql = "UPDATE `requerimientopago` SET `requerimiento` ='".utf8_encode($requerimientos)."' WHERE `idRequerimientoPago` =".$id_req_pago."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientopago` SET `fechaDocumentacion` ='".$fecha."' WHERE `idRequerimientoPago` =".$id_req_pago."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `requerimientopago` SET `fechaTentativa` ='".$fechapago."' WHERE `idRequerimientoPago` =".$id_req_pago."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::FASE 2:::::::::::::::::::::::::::::::::

						$nombrediseñador = utf8_decode($_POST['nombredisenador']);
          		    	$entregaaldiseñador = $_POST['fechaentrega'];
          		    	$fotos = 0;
          		    	$vineta = 0;
          		    	$logos = 0;
                		$lugardiseno = "";
                		$fecha = "";
                		$Hora = "00:00:00";
                		$leyenda = "";
                		$fechaentrega = $_POST['fechadiseño'];

                        /*if($_POST['cartel']!=0)
                        {
                            $cartel = 1;
                        }
                        else $cartel = 0;
                        if($_POST['web']!=0)
                        {
                            $web = 1;
                        }
                        else $web = 0;
                        if($_POST['cortesias']!=0)
                        {
                            $cortesias = 1;
                        }
                        else $cortesias = 0;
                        if($_POST['programamano']!=0)
                        {
                            $programa = 1;
                        }
                        else $programa = 0;
                        if($_POST['invitacion']!=0)
                        {
                            $invitacion = 1;
                        }
                        else $invitacion = 0;
						*/ 
						$sql = "UPDATE `fase2` SET `nombreDisenador` ='".$nombrediseñador."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `fechaentra` ='".$entregaaldiseñador."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						/*$sql = "UPDATE `fase2` SET `fotos` ='".$fotos."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `vineta` ='".$vineta."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `logos` ='".$logos."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `lugar` ='".$lugardiseno."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `fecha` ='".$fecha."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `hora` ='".$Hora."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `leyenda` ='".$leyenda."' WHERE `idFase2` =".$id_f2."";*/
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `fechasalida` ='".$fechaentrega."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `cartel` ='".$cartel."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `web` ='".$web."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `cortesias` ='".$cortesias."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `programa` ='".$programa."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql = "UPDATE `fase2` SET `invitacion` ='".$invitacion."' WHERE `idFase2` =".$id_f2."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::CARTELES Y CORTESIAS:::::::::::::::::::::::::::::::::
						$digital = $_POST['digital'];
                		$offset = $_POST['offset'];
                		$serigrafia = $_POST['serigrafia'];
    		            $fuera = $_POST['fuera'];
   		            	$programaf = $_POST['programamanofecha'];
   		             	$invitacionf = $_POST['invitacionfecha'];
   			            $volante = $_POST['volante'];

   			            $sql= "UPDATE `cartelycortesias` SET `digital` ='".$digital."' WHERE `idCartelyCortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `offset` ='".$offset."' WHERE `idCartelyCortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `serigrafia` ='".$serigrafia."' WHERE `idCartelyCortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `fuera` ='".$fuera."' WHERE `idCartelyCortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `entregaprograma` ='".$programaf."' WHERE `idCartelyCortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `invitacion` ='".$invitacionf."' WHERE `idCartelyCortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `cartelycortesias` SET `volante` ='".$volante."' WHERE `idCartelyCortesias` =".$id_cartel."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::TEXTOS AL CORR:::::::::::::::::::::::::::::::::

						$fechacorrector = $_POST['fechacorrector'];
                		$nombre = utf8_decode($_POST['nombre']);
                		$fechaentrega = $_POST['entregacorrector'];

                		$sql= "UPDATE `corrector` SET `fechaEntra` ='".$fechaentrega."' WHERE `idCorrector` =".$id_corrector."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `corrector` SET `nombreCorrector` ='".$nombre."' WHERE `idCorrector` =".$id_corrector."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
						$sql= "UPDATE `corrector` SET `fechaSale` ='".$fechacorrector."' WHERE `idCorrector` =".$id_corrector."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}

						//:::::::::::::::::::::::::FASE 3:::::::::::::::::::::::::::::::::

						$difusion = $_POST['fechadifusion'];

						$sql= "UPDATE `difusion` SET `fechaDifusion` ='".$difusion."' WHERE `idDifusion` =".$id_f3."";
						if(!($conexion->query($sql) === true)){die("Error al insertar datos: " . $conexion->error);}
                        $conexion->close();

               			echo "<script>alert('Datos actualizados con éxito'); </script>";
                    	echo "<script>window.location='actualizacion.php?id=".$id_act."';</script>";
                        //echo "<script>window.location='administracion.php';</script>";
					}
					?>
					</div>
				</form>
			</section>
		</div>
		</div>
	</body>
</html>