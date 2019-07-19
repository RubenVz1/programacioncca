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
                <p>Fotografías en alta resolución:</p><input type="checkbox" name="fotografias"><p>Viñeta</p><input type="checkbox" name="viñeta"><p>Logotipos</p><input type="checkbox" name="logotipos"><br>
                <p>Lugar:</p><input type="text" name="lugar"><p>Fecha:</p><input type="date" name="fechaentrega2"><p>Hora:</p><input type="number" min="0" max="24" step="1" id="horas1" name="horariohoras" value="">hrs<input type="number" min="0" max="60" step="5" id="minutos1" name="horariominutos" value="">min<br>
                <p>Leyenda, repertorio, etc.</p><input type="message" name="leyenda"><br>
                <p>Fecha estimada de entrega del diseño:</p><input type="date" name="fechadiseño"><br>
                <p>Cartel</p><input type="checkbox" name="cartel"><p>Para web</p><input type="checkbox" name="web"><p>Cortesías</p><input type="checkbox" name="cortesias"><p>Programa de mano</p><input type="checkbox" name="programamano"><p>Invitación</p><input type="checkbox" name="invitacion"><br>

                <input type="submit" name="agrega" value="Continuar">

            </form>
        </section>
        <?php
            if(isset($_POST['agrega']))
            {
                echo "<script>window.location='entregacartelycortesias.php';</script>";            
            }
        ?>
    </div>
</body>
</html>