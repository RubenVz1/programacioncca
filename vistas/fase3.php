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
                    <h1>Difusión</h1>
                </section>
                <section class="section-menu__body fase-form__wrapper text-center">
                    <form method="post">
                        <div>
                            <p>Fecha estimada para que la difusión se encuentre en función, pegada , en redes sociales, blog y WhatsApp: </p><input type="date" name="fechadifusion"><br>
                            <input class="my-3 button-golden" type="submit" name="agrega" value="Crear actividad">
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
<?php
    if(isset($_POST['agrega']))
    {
        $difusion = $_POST['fechadifusion'];
        $mysqli = new DBA();
        $conexion = $mysqli->connect();
        if($difusion == "") {
            $difusion = "0000-00-00";
        }
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
        //trae el id del ultimo insert de fase3
        $getiddifusion = "SELECT MAX(idDifusion) as id FROM `difusion`";
        $resdifusion = $conexion->query($getiddifusion);
        $objetoiddifusion = $resdifusion->fetch_assoc();
        $idDifusion = $objetoiddifusion['id'];
        // inserta en una tabla de actividad
        $sqlactividad = "INSERT INTO `actividad`(`idProgramacion`, `idDiseno`, `idDifusion`) VALUES ('$idprogramacion','$iddiseño','$idDifusion')";
        $conexion->query($sqlactividad);
        echo "<script> location.href='../vistas/home.php'; </script>";
        exit; 
    }
?>