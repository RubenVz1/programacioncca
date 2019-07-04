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
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Administracion</title>
		<link rel="stylesheet" href="../styles/calendarStylo.css">
	</head>
	<body>
		<header>
			<?php echo "<p>Bienvenido ".$user->getNombre()." con cargo ".$user->getCargo()."</p>"?>
			<a id = botonRegresar" href="home.php">Regresar</a>
			<a id = "boton" href="../includes/logout.php">Cerrar sesion</a>
		</header>
	</body>
</html>