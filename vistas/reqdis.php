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
<?php include 'header.php' ?>
	<div class="container-fluid">
		<div class="row justify-content-center my-5">
			<div class="col-7">
				<div class="section-menu__container">
					<section class="section-menu__header text-center">
						<h1>Requerimientos para diseño</h1>
					</section>
					<section class="section-menu__body fase-form__wrapper text-center">
						<form id="reqdis" method="post" action="" enctype="multipart/form-data">
						<div class="fase-input__container">
							<p>Fecha de entrega: </p><input type="date" name="entregareq" value="">
						</div>
						<div class="my-4">
							<input type="hidden" name="numeroImagenes" id="numeroImagenes" value="0" size="1" >
							<p>Añadir fotografia</p>
							<input class="button-golden" id="masImagenes" name="masImagenes" type="button"value="+">
							<input class="button-golden" id="menosImagenes" name="menosImagenes" type="button" value="--">
							<div class="mt-3" id="imagenes">
							</div>
						</div>
						<div class="my-4">
							<input type="hidden" name="numeroLogos" id="numeroLogos" value="0" size="1" >
							<p>Añadir logo</p>
							<input class="button-golden" id="masLogos" name="masLogos" type="button"value="+">
							<input class="button-golden" id="menosLogos" name="menosLogos" type="button" value="--">
							<div class="mt-3" id="logos">
							</div>
						</div>
						<div class="mb-4">
							<p>Word: </p>
							<input name='word' type='file' accept='application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword'>
						</div>
						<div class="mb-4">
							<p>Requerimientos PDF:</p>
							<input name='pdf' type='file' accept='application/pdf'>
						</div>
						<div class="mb-3"><p>Programa de mano: </p><input type="checkbox" id="pm" name="programamano" value="1"></div>
						<div id="cstvalor">
						</div>
						<input class="button-golden" id="boton" type="submit" name="agrega" value="Siguiente">
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
		else
		{
			$programamano = "0";
		}
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
		$sql = "INSERT INTO `requerimientodiseno`(`fechaEntrega`, `semblanzaCompania`, `semblanzaActividad`, `programaMano`,`direccionPdf`,`Word`) VALUES ('$fechaentrega','$semblanzacom','$semblanzaact','$programamano','$direccionPdf','$direccionWord');";
		$resultado = $conexion->query($sql);
		$sql = "SELECT MAX(idRequerimientoDiseno) as id FROM requerimientodiseno;";
		$resultado = $conexion->query($sql);
		$row = $resultado->fetch_assoc();
		$idk = $row['id'];
		if($numeroImagenes != 0)
			for($i = 0; $i < $numeroImagenes; $i++)
			{
				if($imagenes[$i] == "")
					continue;
				$imgk = $imagenes[$i];
				$sql = "INSERT INTO `fotografia`(`fotografia`, `idRequerimientoDiseno`) VALUES ('$imgk','$idk');";
				$resultado = $conexion->query($sql);
			}
		if($numeroLogos != 0)
			for($i = 0; $i < $numeroLogos; $i++)
			{
				if($logos[$i] == "")
					continue;
				$logok = $logos[$i];
				$sql = "INSERT INTO `logotipo`(`logotipo`, `idRequerimientoDiseno`) VALUES ('$logok','$idk');";
				$resultado = $conexion->query($sql);
			}
		if($resultado)
		{
			echo "<script> location.href='../vistas/reqtec.php'; </script>";
			exit;
		}
		else
		{
			echo "<script>alert('error');</script>";
			die("Error al insertar datos: " . $conexion->error);
		}
	}
?>