<?php
	include_once '../includes/user.php';
    include_once '../includes/user_session.php';
    include_once '../includes/db.php';
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
<div id="arriba"></div>
    <div id="inicioSesion">
        <section id="cabecera">
            <h1>Diseño</h1>
        </section>
        <section id="cuerpo">
            <form method="post">
                <p>Nombre del diseñador:</p> <input type="text" name="nombrediseñador"><br>
                <p>Fecha de entrega de documentos e información al diseñador: </p><input type="date" name="fechaentrega"><br><br>
                <p>Fotografías en alta resolución:<br></p>Fotos<input type="checkbox" name="fotografias" value="1"><p>  Viñetas</p><input type="checkbox" name="viñeta"value="1"><p>  Logotipos</p><input type="checkbox" name="logotipos"value="1"><br>
                <p>Lugar:</p><input type="text" name="lugar"><p><br>Fecha:</p><input type="date" name="fechaentrega2"><p><br>Hora:</p><input type="number" min="0" max="24" step="1" id="horas1" name="horariohoras" value=""> hrs <input type="number" min="0" max="60" step="5" id="minutos1" name="horariominutos" value=""> min<br>
                <p>Leyenda, repertorio, etc: </p><input type="message" name="leyenda"><br>
                <p>Fecha estimada de entrega del diseño:</p><input type="date" name="fechadiseño"><br>
                <p>Cartel</p><input type="checkbox" name="cartel"value="1"><p> Para web</p><input type="checkbox" name="web"value="1"><p> Cortesías</p><input type="checkbox" name="cortesias"value="1"><p> Programa de mano</p><input type="checkbox" name="programamano"value="1"><p> Invitación</p><input type="checkbox" name="invitacion"value="1"><br>
                <input type="submit" name="agrega" value="Continuar">
            </form>
        </section>
        <?php
            if(isset($_POST['agrega']))
            {
                echo "<script>window.location='entregacartelycortesias.php';</script>"; 
                $nombrediseñador = $_POST['nombrediseñador'];
                $entregaaldiseñador = $_POST['fechaentrega'];
                if(isset($_POST['fotografias']))
                {
                    $fotos = $_POST['fotografias'];
                }else $fotos=0;
                if(isset($_POST['viñeta']))
                {
                    $viñeta = $_POST['viñeta'];
                }else $viñeta=0;
                if(isset($_POST['logotipos']))
                {
                    $logos = $_POST['logotipos'];
                }else $logos=0;
                if(isset($_POST['lugar']))
                {
                    $lugar = $_POST['lugar'];
                }
                if(isset($_POST['fechaentrega2']))
                {
                    $fecha = $_POST['fechaentrega2'];
                }
                if(isset($_POST['horariohoras']) && isset($_POST['horariominutos']))
                {
                    $Hora = $_POST['horariohoras'].":".$_POST['horariominutos'].":00";
                }
                if(isset($_POST['leyenda']))
                {
                    $leyenda = $_POST['leyenda'];
                }
                if(isset($_POST['fechadiseño']))
                {
                    $fechaentrega = $_POST['fechadiseño'];
                }
                if(isset($_POST['cartel']))
                {
                    $cartel = $_POST['cartel'];
                }else $cartel=0;
                if(isset($_POST['web']))
                {
                    $web = $_POST['web'];
                }else $web=0;
                if(isset($_POST['cortesias']))
                {
                    $cortesias = $_POST['cortesias'];
                }else $cortesias=0;
                if(isset($_POST['programamano']))
                {
                    $programa = $_POST['programamano'];
                }else $programa=0;
                if(isset($_POST['invitacion']))
                {
                    $invitacion = $_POST['invitacion'];
                }else $invitacion=0;
                $db = new DB();
                $query = $db->connect()->prepare("INSERT INTO `Fase2`(`nombreDisenador`, `fechaEntra`, `fotos`, `vineta`, `logos`, `lugar`, `fecha`, `hora`, `leyenda`, `fechaSalida`, `cartel`, `web`, `cortesias`, `programa`, `invitacion`) VALUES ('$nombrediseñador','$entregaaldiseñador','$fotos','$viñeta','$logos','$lugar','$fecha','$Hora','$leyenda','$fechaentrega','$cartel','$web','$cortesias','$programa','$invitacion')");
                $query->execute();
				$result = $query->fetchAll();           
            }
        ?>
    </div>
    <div id="abajo"></div>
</body>
</html>