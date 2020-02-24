<?php
	include_once '../includes/user.php';
    include_once '../includes/user_session.php';
    $userSession = new UserSession();
    $user = new User();
    if(isset($_SESSION['user']))
    {
        $user->setUser($userSession->getCurrentUser());
    }
    else if(!isset($_SESSION['user']))
    {
        include_once 'vistas/login.php';
    }
    if($user->getCargo()!="Administrador")
    {
    	header("location: calendar.php");
    }
?>
<?php include 'header.php' ?>
	<div class="container-fluid px-0">
		<div class="row justify-content-center py-5">
			<div class="col-4">
				<section class="section-menu__container">
					<div class="section-menu__header text-center">
						<h1>Menu</h1>
					</div>
					<div  class="section-menu__body text-center">
						<ul>
							<li class="my-3"><a href="../vistas/calendar.php">Calendario</a></li>
							<li class="my-3"><a href="../vistas/administracion.php">Administracion de Actividades</a></li>
							<li class="my-3"><a href="../vistas/fase1.php">Nueva actividad</a></li>
						</ul>
					</div>
				</section>
			</div>
		</div>
	</div>
<?php include 'footer.php' ?>