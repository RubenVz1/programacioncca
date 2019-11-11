<?php
	include_once '../includes/user.php';
    include_once '../includes/user_session.php';
    include_once '../includes/db.php';
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
	<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Administracion</title>
		<link rel="stylesheet" href="../styles/adminStylo.css">
		<link href="../images/icon.ico" type="image/ico" rel="shortcut icon">

	</head>
	<body>
		<header>
			<?php echo "<p>Bienvenido ".$user->getNombre()." con cargo ".$user->getCargo()."</p>"?>
			<a id = "botonRegresar" href="home.php">Regresar</a>
			<a id = "botonSalir" href="../includes/logout.php">Cerrar sesion</a>
		</header>
		<div id="datos">
			<table border="1" id="tabla">
				<?php
				if(isset($_GET['id']))
				{
					echo "
						<script language='javascript'>
						function redireccion()
						{
							var condicion = confirm('¿Estas seguro de eliminar esta actividad?');
							if(condicion)
							{
								window.location='delete.php?id=".$_GET['id']."';
							}
						}
						window.onload = redireccion; 
						</script>";
				}
				$db = new DB();
			    $query = $db->connect()->prepare('SELECT a.idActividad,r.nombreActividad,r.fechaProgramacion
			    						 		  FROM actividad a, programacion p, requerimientoactividad r
			    						 		  WHERE a.idProgramacion = p.idProgramacion
			    						 		  AND p.idRequerimientoActividad = r.idRequerimientoActividad');
				$query->execute();
				$query->setFetchMode(PDO::FETCH_NUM);
			    $result = $query->fetchAll();
			    if($query->rowCount())
				{
					echo "<section id='cabecera'>
							<h1>Eventos</h1>
						  </section>
							<tr>
								<th>Nombre del evento</th>
								<th>Fecha del evento</th>
								<th>Informacion</th>
								<th>Actualizar</th>
								<th>Eliminar</th>
							</tr>";
					for($i = 0 ; $i < count($result) ; $i++)
					{
						echo "<tr>";
					    for($j = 1 ; $j < 3 ; $j++)
					    {
					    	echo "<td>".$result[$i][$j]."</td>";
					    }
					    echo "<td><a href='activity.php?id=".$result[$i][0]."'>Informacion</a></td>";
					    echo "<td><a href='actualizacion.php?id=".$result[$i][0]."'>Actualizar</a></td>";
					    echo "<td><a href='administracion.php?id=".$result[$i][0]."'>Eliminar</a></td>";
					    echo "</tr>";
					}
				}
			    else
			    {
			    	echo "No hay actividades registradas";
			    }
				?>
			</table>
		</div>
	</body>
</html>