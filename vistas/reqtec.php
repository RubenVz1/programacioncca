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
						<h1>Requerimientos técnicos</h1>
					</section>
					<section class="section-menu__body fase-form__wrapper text-center">
						<form method="post" enctype="multipart/form-data">
							<p>Requerimientos</p>
							<textarea name="message" rows="5" cols="30"></textarea>
							<div class="mt-3">
								<p>Requerimientos PDF</p>
								<input name='pdf' type='file' accept='application/pdf'>
							</div>
							<div class="my-3">
								<p>Requerimientos Word</p>
								<input name='word' type='file' accept='application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword'>
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
	if(isset($_POST['agrega']))
	{
		if(isset($_POST['message']))
			$requrimientotecnico = $_POST['message'];
		else
			$requrimientotecnico ="";
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
		$mysqli = new DBA();
		$conexion = $mysqli->connect();
		$sql = "INSERT INTO `requerimientotecnico`( `requerimiento`,`direccionPdf`,`Word`) VALUES ('$requrimientotecnico','$direccionPdf','$direccionWord')";
		$resultado = $conexion->query($sql);
		if($resultado)
		{
			echo "<script> location.href='../vistas/reqpag.php'; </script>";
			exit;
		}
		else
		{
			echo "<script>alert('error');</script>";
			die("Error al insertar datos: " . $conexion->error);
		}
	}
?>