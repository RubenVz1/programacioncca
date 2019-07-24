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
            <h1>Textos y corrector</h1>
        </section>
        <section id="cuerpo">
            <form method="post">
                <p>Fecha de entrega de textos al corrector: </p><input type="date" name="fechacorrector"><br>
                <p>Nombre del corrector de textos: </p><input type="text" name="nombre"><br>
                <p>Fecha de entrega de textos del corrector de textos : </p><input type="date" name="entregacorrector"><br>

                <input type="submit" name="agrega" value="Continuar">

            </form>
        </section>
        <?php
            if(isset($_POST['agrega']))
            {
                $fechacorrector = $_POST['fechacorrector'];
                $nombre = $_POST['nombre'];
                $fechaentrega = $_POST['entregacorrector'];

                $db = new DB();
                $query = $db->connect()->prepare("INSERT INTO `corrector`(`fechaentra`, `nombrecorrector`, `fechasale`) VALUES ('$fechaentrega','$nombre','$fechacorrector')");
                $result = $query->execute();
                $result = $query->fetchAll();

                $servidor = "localhost";
            		$nombreusuario = "root";
            		$password = "QQWWEERR1";
            		$db = "prueba";
                    $mysqli = new mysqli($servidor, $nombreusuario, $password, $db);
                
                    
                //trae el id del ultimo insert de fase2
						$getidprogramacion = "SELECT MAX(idfase2) as id FROM `fase2`";
						$resprogramacion = $mysqli->query($getidprogramacion);
						$objetoidprogramacion = $resprogramacion->fetch_assoc();
                        $idfase2 = $objetoidprogramacion['id'];
                        
						//trae el id del ultimo insert de cartel y cortesias
						$getiddiseño =  "SELECT MAX(idcartelycortesias) as id FROM `cartelycortesias`";
						$resdiseno =  $mysqli->query($getiddiseño);
						$objetoiddiseño = $resdiseno->fetch_assoc();
                        $idcartelycortesias = $objetoiddiseño['id'];

						//trae el id del ultimo insert de corrector
						$getidtecnico =  "SELECT MAX(idcorrector) as id FROM `corrector`";
						$restecnico =  $mysqli->query($getidtecnico);
						$objetoidtecnico = $restecnico->fetch_assoc();
                        $idcorrector = $objetoidtecnico['id'];


                        //inset que junta todas las tablas de la fase de diseño
                        /*$query= $db->prepare("INSERT INTO `diseño`(`idfase2`, `idcartelycortesias`, `idcorrector`) VALUES (".$idfase2.",".$idcartelycortesias.",".$idcorrector.",)");
                        $query->execute();
                        $result = $query->fetchAll();*/

                        $sqlprogramacion = "INSERT INTO `diseno`(`idfase2`, `idcartelycortesias`, `idcorrector`) VALUES ('$idfase2','$idcartelycortesias','$idcorrector')";

                        $mysqli->query($sqlprogramacion);
                        echo $mysqli->error;                        

                echo "<script>window.location='fase3.php';</script>";            
            }
        ?>
    </div>
</body>
</html>