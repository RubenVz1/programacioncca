<?php
	include_once '../includes/user.php';
    include_once '../includes/user_session.php';
    include_once '../includes/db.php';
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
                    <h1>Textos y corrector</h1>
                </section>
                <section class="section-menu__body fase-form__wrapper text-center">
                    <form method="post">
                        <div class="fase-input__container">
                            <p>Fecha de entrega de textos al corrector: </p><input type="date" name="fechacorrector">
                        </div>
                        <div class="fase-input__container">
                            <p>Nombre del corrector de textos: </p><input type="text" name="nombre">
                        </div>
                        <div class="fase-input__container">
                            <p>Fecha de entrega de textos del corrector de textos : </p><input type="date" name="entregacorrector">
                        </div>
                        <input class="button-golden" type="submit" name="agrega" value="Siguiente">
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
        $fechacorrector = $_POST['fechacorrector'];
        $nombre = $_POST['nombre'];
        $fechaentrega = $_POST['entregacorrector'];
        if($fechacorrector == "")
            $fechacorrector = "0000-00-00";
        if($fechaentrega == "")
            $fechaentrega = "0000-00-00";
        /*
        $db = new DB();
        $query = $db->connect()->prepare("INSERT INTO `corrector`(`fechaEntra`, `nombreCorrector`, `fechaSale`) VALUES ('$fechaentrega','$nombre','$fechacorrector')");
        $result = $query->execute();
*/
        $mysqli = new DBA();
        $conexion = $mysqli->connect();
        $idcorrector = obtenid('idCorrector','corrector',$conexion);
        $sql = "UPDATE `corrector` SET `fechaEntra`='$fechaentrega',`nombreCorrector`='$nombre',`fechaSale`='$fechacorrector' WHERE $idcorrector";
        $resultado = $conexion->query($sql);

        echo $conexion->error;
        echo "<script> location.href='../vistas/fase3.php'; </script>";
        exit;    
    }
?>