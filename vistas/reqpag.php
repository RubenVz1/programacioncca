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
						<h1 id="h1pag">Requerimientos para pagos</h1>
				</section>
				<section class="section-menu__body fase-form__wrapper text-center">
					<form method="post"action="" enctype="multipart/form-data">
						<p>Requerimientos</p><textarea name="req" rows="5" cols="30"></textarea>
						<div class="my-3">
							<p>Fecha en que cubrió toda la documentación</p><input type="date" name="documentacionok" value="">
							<input type="checkbox" id="si" value=1>
							<div id="ok"></div>
						</div>
						<div class="mb-3">
							<p>Requerimientos PDF</p>
							<input name='pdf' type='file' accept='application/pdf'>
						</div>
						<div class="mb-3">
							<p>Requerimientos Word</p>
							<input name='word' type='file' accept='application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword'>
						</div>
						<div class="mb-3">
							<p>Imagen:</p>
							<input id='photo' type='file' accept='image/x-png,image/gif,image/jpeg' name='foto'>
						</div>
						<input class="button-golden" id='boton' type="submit" name="agrega" value="Siguiente">
					</form>
				</section>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>
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
		
		if($_FILES['pdf']['tmp_name'])
		{
			$requrimientotecnicoPdf = $_FILES['pdf']['name'];
			$direccionPdf = "../pdfs/".generateRandomString()."__".$requrimientotecnicoPdf;
			move_uploaded_file($_FILES['pdf']['tmp_name'],$direccionPdf);
		}
		else
		{
			$direccionPdf ="";
		}
		if($_FILES['word']['tmp_name'])
		{
			$requrimientotecnicoPdf = $_FILES['word']['name'];
			$direccionWord = "../words/".generateRandomString()."__".$requrimientotecnicoPdf;
			move_uploaded_file($_FILES['word']['tmp_name'],$direccionWord);
		}
		else
		{
			$direccionWord ="";
		}
		$imagen="";
		if($_FILES['foto']['tmp_name'])
			{
				if(!isImageValid($_FILES['foto']))
				{
					echo "<script>alert('La imagen tiene un formato invalido, no se guardara en la base de datos')</script>";
				}
				$imagen = "../images/".generateRandomString()."__".$_FILES['foto']['name'];
				move_uploaded_file($_FILES['foto']['tmp_name'],$imagen);
			}
		
		$mysqli = new DBA();
		$conexion = $mysqli->connect();
		if($fechapago == '')
			$fechapago = '0000-00-00';
		if($fecha == '')
			$fecha = '0000-00-00';
		$sqlreqpag = "INSERT INTO `requerimientopago`(`requerimiento`, `fechaDocumentacion`, `fechaTentativa`, `direccionPdf`, `imagen`, `word`) VALUES ('$requerimientos','$fecha','$fechapago','$direccionPdf','$imagen','$direccionWord')";
		$resultadoreqpag = $conexion->query($sqlreqpag);
		if($resultadoreqpag)
		{
			//trae el id del ultimo insert de requerimientos de programacion
			$getidprogramacion = "SELECT MAX(idRequerimientoActividad) as id FROM `requerimientoactividad`";
			$resprogramacion = $conexion->query($getidprogramacion);
			$objetoidprogramacion = $resprogramacion->fetch_assoc();
			$idprogramacion = $objetoidprogramacion['id'];
			//trae el id del ultimo insert de requerimientos de diseño
			$getiddiseño =  "SELECT MAX(idRequerimientoDiseno) as id FROM `requerimientodiseno`";
			$resdiseno =  $conexion->query($getiddiseño);
			$objetoiddiseño = $resdiseno->fetch_assoc();
			$iddiseño = $objetoiddiseño['id'];
			//trae el id del ultimo insert de requerimientos técnicos
			$getidtecnico =  "SELECT MAX(idRequerimientoTecnico) as id FROM `requerimientotecnico`";
			$restecnico =  $conexion->query($getidtecnico);
			$objetoidtecnico = $restecnico->fetch_assoc();
			$idtecnico = $objetoidtecnico['id'];
			//trae el id del ultimo insert de requerimientos para pagos
			$getidpagos =  "SELECT MAX(idRequerimientoPago) as id FROM `requerimientopago`";
			$respago =  $conexion->query($getidpagos);
			$objetoidpago = $respago->fetch_assoc();
			$idpago = $objetoidpago['id'];
			//inset que junta todas las tablas de la fase de programacion
			$sqlprogramacion = "INSERT INTO `programacion`(`idRequerimientoActividad`, `idRequerimientoDiseno`, `idRequerimientoTecnico`, `idRequerimientoPago`) VALUES ('$idprogramacion','$iddiseño','$idtecnico','$idpago')";
			$resultadofusion = $conexion->query($sqlprogramacion);			
			echo "<script> location.href='../vistas/fase2.php'; </script>";
			exit;
		}
		else
		{
			echo "<script>alert('error');</script>";
			die("Error al insertar datos: " . $conexion->error);
		}
	}
?>