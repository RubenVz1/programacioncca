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
    <link href="../images/icon.ico" type="image/ico" rel="shortcut icon">
	<script src="../js/jquery.min.js"></script>
	<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="../styles/Fase1Stylo.css">
</head>
<body>
<div id="arriba"></div>
    <div id="inicioSesion">
        <section id="cabecera">
            <h1>Fecha de entrega de cartel impreso y cortesías</h1>
        </section>
        <section id="cuerpo">
            <form method="post">
                <p>Impresion digital: </p><input type="date" name="digital"><br>
                <p>Impresion offset: </p><input type="date" name="offset"><br>
                <p>Serigrafía: </p><input type="date" name="serigrafia"><br>
                <p>Por fuera: </p><input type="date" name="fuera"><br>
                <p>fecha entrega programa de mano: </p><input type="date" name="programamano"><br>
                <p>Invitación: </p><input type="date" name="invitacion"><br>
                <p>Volante: </p><input type="date" name="volante"><br>

                <input type="submit" name="agrega" value="Continuar">

            </form>
        </section>
        <?php
            if(isset($_POST['agrega']))
            {
                $digital = $_POST['digital'];
                $offset = $_POST['offset'];
                $serigrafia = $_POST['serigrafia'];
                $fuera = $_POST['fuera'];
                $programa = $_POST['programamano'];
                $invitacion = $_POST['invitacion'];
                $volante = $_POST['volante'];

                $db = new DB();
                $query = $db->connect()->prepare("INSERT INTO `cartelycortesias`(`digital`, `offset`, `serigrafia`, `fuera`, `entregaPrograma`, `invitacion`, `volante`) VALUES ('$digital','$offset','$serigrafia','$fuera','$programa','$invitacion','$volante')");
                $query->execute();
                header("location: ../vistas/textosalcorrector.php");
      
            }
        ?>
    </div>
    <div id="abajo"></div>
</body>
</html>