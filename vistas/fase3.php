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
    <title>Fase 3</title>
	<link href="../img/icon.ico" type="image/ico" rel="shortcut icon">
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

                /*$db = new DB();
                $query = $db->connect()->prepare("INSERT INTO `difusion`(`fechadifusion`) VALUES ('$difusion')");
                $query->execute();
                $result = $query->fetchAll();*/

                $servidor = "localhost";
            		$nombreusuario = "root";
            		$password = "QQWWEERR1";
            		$db = "prueba";
                    $mysqli = new mysqli($servidor, $nombreusuario, $password, $db);
                
                $mysqli->query("INSERT INTO `difusion`(`fechadifusion`) VALUES ('$difusion')");

                //trae el id del ultimo insert de fase1
				$getidprogramacion = "SELECT MAX(idProgramacion) as id FROM `programacion`";
				$resprogramacion = $mysqli->query($getidprogramacion);
				$objetoidprogramacion = $resprogramacion->fetch_assoc();
                $idprogramacion = $objetoidprogramacion['id'];
                
                //trae el id del ultimo insert de fase2
                $getiddiseño = "SELECT MAX(iddiseno) as id FROM `diseno`";
                $resdiseño = $mysqli->query($getiddiseño);
                echo $mysqli->error; 
				$objetoiddiseño = $resdiseño->fetch_assoc();
                $iddiseño = $objetoiddiseño['id'];
                echo $iddiseño;

                //trae el id del ultimo insert de fase3
                $getiddifusion = "SELECT MAX(idDifusion) as id FROM `difusion`";
				$resdifusion = $mysqli->query($getiddifusion);
				$objetoiddifusion = $resdifusion->fetch_assoc();
                $idDifusion = $objetoiddifusion['id'];
                        
                // inserta en una tabla de actividad
				$sqlactividad = "INSERT INTO `actividad`(`idProgramacion`, `idDiseno`, `idDifusion`) VALUES ('$idprogramacion','$iddiseño','$idDifusion')";
                $mysqli->query($sqlactividad);
                
                echo "<script>window.location='home.php';</script>";            
            }
        ?>
    </div>
    <div id="abajo"></div>
</body>
</html>