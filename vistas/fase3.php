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
        $difusion = $_POST['fechadifusion'];
        if($difusion == "") 
        {
            $difusion = "0000-00-00";
        }

        $mysqli = new DBA();
        $conexion = $mysqli->connect(); 
        $iddifusion = obtenid('idDifusion','difusion',$conexion); 
        $sql = "UPDATE `difusion` SET `fechaDifusion`='$difusion' WHERE $iddifusion";
        $conexion->query($sql);


        echo "<script> location.href='../vistas/home.php'; </script>";
        exit; 
    }
?>