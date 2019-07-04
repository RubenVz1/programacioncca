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
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Home</title>
		<link rel="stylesheet" href="../styles/homeStylo.css">
		<link href="img/icon.ico" type="image/ico" rel="shortcut icon">
	</head>
	<body>

		<header>
			<?php echo "<p>Bienvenido ".$user->getNombre()." con cargo ".$user->getCargo()."</p>"?>
			<a id = "boton" href="../includes/logout.php">Cerrar sesion</a>
		</header>
		<div id="enmedio">
			<section id="ventana">
				<div id="cabecera">
					<p>Menu</p>
				</div>
				<ul id="menu">
					<li><a href="../vistas/calendar.php">Calendario</a></li>
					<li><a href="../vistas/administracion.php">Administracion de Actividades</a></li>
					<li><a href="../vistas/fase1.php">Nueva actividad</a></li>
				</ul>
			</section>
		</div>
		<footer>
		</footer>
	</body>
</html>