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
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Administracion</title>
		<link rel="stylesheet" href="../styles/adminStylo.css">
		<link href="../img/icon.ico" type="image/ico" rel="shortcut icon">

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
				$db = new DB();
				if(isset($_GET['id']))
				{
					$query = $db->connect()->prepare('SELECT a.idProgramacion, p.idRequerimientoActividad, p.idRequerimientoDiseno, p.idRequerimientoTecnico, p.idRequerimientoPago
													FROM actividad a, programacion p
													WHERE a.idProgramacion = p.idProgramacion 
													AND a.idActividad ='.$_GET['id']);
					$query->execute();
					$result = $query->fetchAll();
					if($query->rowCount())
					{
						$query = $db->connect()->prepare('DELETE FROM requerimientoPago WHERE idRequerimientoPago ='.$result[0][4]);
						$query->execute();
						$query = $db->connect()->prepare('DELETE FROM requerimientoTecnico WHERE idRequerimientoTecnico ='.$result[0][3]);
						$query->execute();
						$query = $db->connect()->prepare('DELETE FROM requerimientoDiseno WHERE idRequerimientoDiseno ='.$result[0][2]);
						$query->execute();
						$query = $db->connect()->prepare('DELETE FROM requerimientoActividad WHERE idRequerimientoActividad ='.$result[0][1]);
						$query->execute();
						$query = $db->connect()->prepare('DELETE FROM programacion WHERE idProgramacion ='.$result[0][0]);
						$query->execute();
						$query = $db->connect()->prepare('DELETE FROM actividad WHERE idActividad ='.$_GET['id']);
						$query->execute();
					}
				}
			    $query = $db->connect()->prepare('SELECT a.idActividad,r.nombreActividad,r.fechaProgramacion
			    						 		  FROM actividad a, programacion p, requerimientoActividad r
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
					    echo "<td><a href=\"administracion.php\">Actualizar</a></td>";
					    echo "<td><a href=\"administracion.php?id=".$result[$i][0]."\">Eliminar</a></td>";
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