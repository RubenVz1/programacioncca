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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fase 2</title>

	<link href="../img/icon.ico" type="image/ico" rel="shortcut icon">
	<script src="../js/jquery.min.js"></script>
	<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="../styles/Fase1Stylo.css">
</head>
<body>
    <div id="inicioSesion">
        <section id="cabecera">
            <h1>Diseño</h1>
        </section>
        <section id="cuerpo">
            <form method="post">
                <p>Nombre del diseñador:</p> <input type="text" name="nombrediseñador"><br>
                <p>Fecha de entrega de documentos e información al diseñador: </p><input type="date" name="fechaentrega"><br>
                <p>Fotografías en alta resolución:</p><input type="checkbox" name="fotografias" value="1"><p>Viñeta</p><input type="checkbox" name="viñeta"value="1"><p>Logotipos</p><input type="checkbox" name="logotipos"value="1"><br>
                <p>Lugar:</p><input type="text" name="lugar"><p>Fecha:</p><input type="date" name="fechaentrega2"><p>Hora:</p><input type="number" min="0" max="24" step="1" id="horas1" name="horariohoras" value="">hrs<input type="number" min="0" max="60" step="5" id="minutos1" name="horariominutos" value="">min<br>
                <p>Leyenda, repertorio, etc.</p><input type="message" name="leyenda"><br>
                <p>Fecha estimada de entrega del diseño:</p><input type="date" name="fechadiseño"><br>
                <p>Cartel</p><input type="checkbox" name="cartel"value="1"><p>Para web</p><input type="checkbox" name="web"value="1"><p>Cortesías</p><input type="checkbox" name="cortesias"value="1"><p>Programa de mano</p><input type="checkbox" name="programamano"value="1"><p>Invitación</p><input type="checkbox" name="invitacion"value="1"><br>

                <input type="submit" name="agrega" value="Continuar">

            </form>
        </section>
        <?php
            if(isset($_POST['agrega']))
            {
                $nombrediseñador = $_POST['nombrediseñador'];
                $entregaaldiseñador = $_POST['fechaentrega'];
                $fotos = $_POST['fotografias'];
                $viñeta = $_POST['viñeta'];
                $logos = $_POST['logotipos'];
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

                $db = new DB();
                $query = $db->connect()->prepare("INSERT INTO `fase2`(`nombrediseñador`, `fechaentra`, `fotos`, `viñeta`, `logos`, `lugar`, `fecha`, `hora`, `leyenda`, `fechasalida`, `cartel`, `web`, `cortesias`, `programa`, `invitacion`) VALUES ('$nombrediseñador','$entregaaldiseñador','$fotos','$viñeta','$logos','$lugar','$fecha','$Hora','$leyenda','$fechaentrega','$cartel','$web','$cortesias','$programa','$invitacion')");
                $query->execute();
				$result = $query->fetchAll();
                echo "<script>window.location='entregacartelycortesias.php';</script>";            
            }
        ?>
    </div>
</body>
</html>