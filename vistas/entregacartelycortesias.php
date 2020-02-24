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
<?php include 'header.php' ?>
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <div class="col-7">
                <div class="section-menu__container">
                    <section class="section-menu__header text-center">
                        <h1>Fecha de entrega de cartel impreso y cortesías</h1>
                    </section>
                    <section class="section-menu__body fase-form__wrapper text-center">
                        <form method="post">
                            <div class="fase-input__container">
                                <p>Impresion digital: </p><input type="date" name="digital">
                            </div>
                            <div class="fase-input__container">
                                <p>Impresion offset: </p><input type="date" name="offset">
                            </div>
                            <div class="fase-input__container">
                                <p>Serigrafía: </p><input type="date" name="serigrafia">
                            </div>
                            <div class="fase-input__container">
                                <p>Por fuera: </p><input type="date" name="fuera">
                            </div>
                            <div class="fase-input__container">
                                <p>fecha entrega programa de mano: </p><input type="date" name="programamano">
                            </div>
                            <div class="fase-input__container">
                                <p>Invitación: </p><input type="date" name="invitacion">
                            </div>
                            <div class="fase-input__container mb-3">
                                <p>Volante: </p><input type="date" name="volante">
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
    if(isset($_POST['agrega']))
    {
        $digital = $_POST['digital'];
        $offset = $_POST['offset'];
        $serigrafia = $_POST['serigrafia'];
        $fuera = $_POST['fuera'];
        $programa = $_POST['programamano'];
        $invitacion = $_POST['invitacion'];
        $volante = $_POST['volante'];
        if($digital == '')
            $digital = '0000-00-00';
        if($offset == '')
            $offset = '0000-00-00';
        if($serigrafia == '')
            $serigrafia = '0000-00-00';
        if($fuera == '')
            $fuera = '0000-00-00';
        if($programa == '')
            $programa = '0000-00-00';
        if($invitacion == '')
            $invitacion = '0000-00-00';
        if($volante == '')
            $volante = '0000-00-00';
        $db = new DB();
        $query = $db->connect()->prepare("INSERT INTO `cartelycortesias`(`digital`, `offset`, `serigrafia`, `fuera`, `entregaPrograma`, `invitacion`, `volante`) VALUES ('$digital','$offset','$serigrafia','$fuera','$programa','$invitacion','$volante')");
        $query->execute();
        echo "<script> location.href='../vistas/textosalcorrector.php'; </script>";
        exit;
    }
?>