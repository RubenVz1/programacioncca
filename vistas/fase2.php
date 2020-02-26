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
                        <h1>Diseño</h1>
                    </section>
                    <section class="section-menu__body fase-form__wrapper text-center">
                        <form method="post">
                            <div class="fase-input__container">
                                <p>Nombre del diseñador:</p> <input type="text" name="nombrediseñador">
                            </div>
                            <div class="fase-input__container">
                                <p>Fecha de entrega de documentos e información al diseñador: </p><input type="date" name="fechaentrega">
                            </div>
                            <div class="fase-input__container">
                                <p>Fecha estimada de entrega del diseño:</p><input type="date" name="fechadiseño">
                            </div>
                            <div class="fase-input__container check-input__container my-3">
                                <p>Cartel</p><input type="checkbox" name="cartel"value="1"><p> Para web</p><input type="checkbox" name="web"value="1"><p> Cortesías</p><input type="checkbox" name="cortesias"value="1"><p> Programa de mano</p><input type="checkbox" name="programamano"value="1"><p> Invitación</p><input type="checkbox" name="invitacion"value="1">
                            </div>
                            <input id='boton' type="submit" name="agrega" value="Siguiente">
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>
<?php
    function obtenid($nombreid,$tabla,$conexion)
	{
		$getid = "SELECT MAX($nombreid) as id FROM `$tabla`";
        $res = $conexion->query($getid);
        $objetoid = $res->fetch_assoc();
		$id = $objetoid['id'];
		return $id;
	}
    if(isset($_POST['agrega']))
    {
        $nombrediseñador = $_POST['nombrediseñador'];
        $entregaaldiseñador = $_POST['fechaentrega'];
        $viñeta=0;
        $logos=0;
        $lugar = "";
        $fecha = "";
        $Hora = "00:00:00";
        $leyenda = "";
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
        if($fechaentrega == "")
            $fechaentrega = '0000-00-00';
        if($entregaaldiseñador == "")
            $entregaaldiseñador = '0000-00-00';


        $mysqli = new DBA();
        $conexion = $mysqli->connect();
        $idfase2 = obtenid('idFase2','fase2',$conexion);
        $sql = "UPDATE `fase2` SET `nombreDisenador`='$nombrediseñador',`fechaEntra`='$entregaaldiseñador',`fechaSalida`='$fechaentrega',`cartel`='$cartel',`web`='$web',`cortesias`='$cortesias',`programa`='$programa',`invitacion`='$invitacion' WHERE $idfase2";
        $resultado = $conexion->query($sql);

        echo "<script> location.href='../vistas/entregacartelycortesias.php'; </script>";
		exit;
    }
?>