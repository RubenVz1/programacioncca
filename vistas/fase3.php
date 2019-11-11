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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fase 3</title>
    <link href="../images/icon.ico" type="image/ico" rel="shortcut icon">
	<script src="../js/jquery.min.js"></script>
	<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="../styles/Fase1Stylo.css">
</head>
<body>
<div id="arriba"></div>
    <div id="inicioSesion">
        <section id="cabecera">
            <h1>Difusión</h1>
        </section>
        <section id="cuerpo">
            <form method="post">
                <p>Fecha estimada para que la difusión se encuentre en función, pegada , en redes sociales, blog y WhatsApp; </p><input type="date" name="fechadifusion"><br>
                
                <input type="submit" name="agrega" value="Continuar">

            </form>
        </section>
        <?php
            if(isset($_POST['agrega']))
            {
                $difusion = $_POST['fechadifusion'];

                $mysqli = new DBA();
                $conexion = $mysqli->connect();
                $conexion->query("INSERT INTO `difusion`(`fechaDifusion`) VALUES ('$difusion')");

                //trae el id del ultimo insert de fase1
				$getidprogramacion = "SELECT MAX(idProgramacion) as id FROM `programacion`";
				$resprogramacion = $conexion->query($getidprogramacion);
				$objetoidprogramacion = $resprogramacion->fetch_assoc();
                $idprogramacion = $objetoidprogramacion['id'];
                
                //trae el id del ultimo insert de fase2
                $getiddiseño = "SELECT MAX(idDiseno) as id FROM `diseno`";
                $resdiseño = $conexion->query($getiddiseño);
                echo $conexion->error; 
				$objetoiddiseño = $resdiseño->fetch_assoc();
                $iddiseño = $objetoiddiseño['id'];
                echo $iddiseño;

                //trae el id del ultimo insert de fase3
                $getiddifusion = "SELECT MAX(idDifusion) as id FROM `difusion`";
				$resdifusion = $conexion->query($getiddifusion);
				$objetoiddifusion = $resdifusion->fetch_assoc();
                $idDifusion = $objetoiddifusion['id'];
                        
                // inserta en una tabla de actividad
				$sqlactividad = "INSERT INTO `actividad`(`idProgramacion`, `idDiseno`, `idDifusion`) VALUES ('$idprogramacion','$iddiseño','$idDifusion')";
                $conexion->query($sqlactividad);
                
                header("location: ../vistas/home.php");
            }
        ?>
    </div>
    <div id="abajo"></div>
</body>
</html>