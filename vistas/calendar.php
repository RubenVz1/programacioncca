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
        header("location: ../index.php");
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Calendario</title>
		<link rel="stylesheet" href="../styles/calendarStylo.css">
		<link href="../images/icon.ico" type="image/ico" rel="shortcut icon">

	</head>
	<body>
	<header>
			<?php echo "<p>Bienvenido ".$user->getNombre()." con cargo ".$user->getCargo()."</p>";
			if($user->getCargo() == "Administrador")
				{
					echo "<a id = \"botonRegresar\" href=\"home.php\">Regresar</a>";
				}
			?>
			<a id="botonSalir" href="../includes/logout.php">Cerrar sesion</a>
	</header>
		<div id="calendario">
			<table border="1" id="tabla">
				<section id="cabecera">
					<h1>Calendario</h1>
				</section>
				<tr>
					<?php
					function fechaAnterior($anterior)
					{
						if($anterior[0]==1)
						{
							$anterior[0]=12;
							$anterior[1]-=1;
						}
						else
							$anterior[0]-=1;
						if($anterior[0]<10)
							$anterior[0] = "0".$anterior[0];
						return $anterior;
					}

					function fechaSiguiente($siguiente)
					{
						if($siguiente[0]>11)
						{
							$siguiente[0]=1;
							$siguiente[1]+=1;
						}
						else
							$siguiente[0]+=1;
						if($siguiente[0]<10)
							$siguiente[0] = "0".$siguiente[0];
						return $siguiente;
					}

					function fechaString($dia,$mes,$anio)
					{
						if($dia<10)
						{
							$dia = "0".$dia;
						}
						return $anio."-".$mes."-".$dia;
					}

					$nombreMeses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
					$fecha = new DateTime();
					$mes = $fecha->format('m');
					$anio = $fecha->format('Y');

					$siguiente = fechaSiguiente(array($mes,$anio));
					$anterior = fechaAnterior(array($mes,$anio));

					if(isset($_GET['mes'])&&isset($_GET['anio']))
					{
						$siguiente = fechaSiguiente(array($_GET['mes'],$_GET['anio']));
						$anterior = fechaAnterior(array($_GET['mes'],$_GET['anio']));
						$mes = $_GET['mes'];
						$anio = $_GET['anio'];
					}
					$db = new DB();
					
					$query = $db->connect()->prepare("SELECT a.idActividad,r.nombreCompania,r.fechaEvento
			    						 		  FROM Actividad a, Programacion p, requerimientoActividad r
			    						 		  WHERE a.idProgramacion = p.idProgramacion
			    						 		  AND p.idRequerimientoActividad = r.idRequerimientoActividad
			    						 		  AND r.fechaEvento >= '$anio-$mes-01'
			    						 		  AND r.fechaEvento <= '$anio-$mes-31'");
					$query->execute();
					$query->setFetchMode(PDO::FETCH_NUM);
				    $result = $query->fetchAll();
					echo "<th id='atras'><a href='calendar.php?mes=".$anterior[0]."&anio=".$anterior[1]."'>atras</a></th>";
					echo "<th id='fecha' colspan='5'>".$nombreMeses[$mes-1]." del ".$anio."</th>";
					echo "<th id='siguiente'><a href='calendar.php?mes=".$siguiente[0]."&anio=".$siguiente[1]."'>siguiente</a></th>";
					?>
				</tr>
				<tr id='semana'>
					<th>Lunes</th>
					<th>Martes</th>
					<th>Miercoles</th>
					<th>Jueves</th>
					<th>Viernes</th>
					<th>Sabado</th>
					<th>Domingo</th>
				</tr>
				<?php
					$primeraCelda = date("w",mktime(0,0,0,$mes,1,$anio))+7;
					$finMes = date("d",(mktime(0,0,0,$mes+1,1,$anio)-1));
					if($primeraCelda >= 8)
					{
						$primeraCelda = $primeraCelda - 7;
					}
					$ultimaCelda = $primeraCelda + $finMes;
					$limite = 6;
					if($ultimaCelda <= 36)
					{
						$limite = 5;
					}
					$contador = 1;
					$dia = 1;
					for($i = 0 ; $i < $limite ; $i++)
					{
						echo "<tr>";
						for($j = 0 ; $j < 7 ; $j++)
						{
							if($contador >= $primeraCelda && $contador < $ultimaCelda)
							{
								echo "<th id='exists'>";
								echo $dia;
								if($query->rowCount())
								{
									for($k = 0 ; $k < count($result) ; $k++)
									{
									    if($result[$k][2] == fechaString($dia,$mes,$anio))
										{//echo utf8_decode(  /  html_entity_decode(htmlentities($test))
											$caracteresespeciales = $result[$k][1];
									    	echo "<br><a href='calendar.php?mes=".$mes."&anio=".$anio."&id=".$result[$k][0]."'>".$caracteresespeciales."</a><br>";
									    }
									}
								}
								$dia++;
							}
							else
							{
								echo "<th id='noexists'>-";
							}
							echo "</th>";
							$contador++;
						}
						echo "</tr>";
					}
				?>
			</table>
		</div>

		<div id="observaciones">
			<section id="cabecera2">
				<h1>Observaciones</h1>			
			</section>
			<section id="cuerpo">
			<?php
				if(isset($_GET['id']))
            	{
	                $id = $_GET['id'];
	                $query = $db->connect()->prepare("SELECT r.observacion
	                                                  FROM Actividad a, Programacion p, requerimientoActividad r
	                                                  WHERE a.idProgramacion = p.idProgramacion
	                                                  AND p.idRequerimientoActividad = r.idRequerimientoActividad
	                                                  AND a.idActividad = $id");
	                $query->execute();
	                $query->setFetchMode(PDO::FETCH_NUM);
	                $result = $query->fetchAll();
	                if($query->rowCount())
	                {
	                    echo "<p>".$result[0][0]."</p>";
	                }
	                else
	                {
	                    echo "Hubo un error al cargar la actividad";
	                }
            	}
			?>	
			</section>
		</div>
		<div id="datos">
			<section id="cabecera2">
				<h1>Datos</h1>
			</section>
			<section id="cuerpo">
				<?php
				if(isset($_GET['id']))
            	{
	                $id = $_GET['id'];
	                $query = $db->connect()->prepare("SELECT r.nombreActividad,r.nombreCompania,r.lugar,r.fechaProgramacion, r.fechaEvento
	                                                  FROM Actividad a, Programacion p, requerimientoActividad r
	                                                  WHERE a.idProgramacion = p.idProgramacion
	                                                  AND p.idRequerimientoActividad = r.idRequerimientoActividad
	                                                  AND a.idActividad = $id");
	                $query->execute();
	                $query->setFetchMode(PDO::FETCH_NUM);
	                $result = $query->fetchAll();
	                if($query->rowCount())
	                {//utf8_decode($caracteresespeciales)
	                	echo "<p>Nombre de la compania: ".$result[0][1]."</p>";
	                    echo "<p>Nombre de la actividad: ".$result[0][0]."</p>";
	                    echo "<p>Lugar del evento: ".$result[0][2]."</p>";
	                    echo "<p>Fecha de programacion: ".$result[0][3]."</p>";
	                    echo "<p>Fecha del evento: ".$result[0][4]."</p>";
	                }
	                $query = $db->connect()->prepare("SELECT h.horario
	                                                  FROM Actividad a, Programacion p, requerimientoActividad r, Horario h
	                                                  WHERE a.idProgramacion = p.idProgramacion
	                                                  AND p.idRequerimientoActividad = r.idRequerimientoActividad
	                                                  AND r.idRequerimientoActividad = h.idRequerimientoActividad
	                                                  AND a.idActividad = $id");
	                $query->execute();
	                $query->setFetchMode(PDO::FETCH_NUM);
	                $result = $query->fetchAll();
	                if($query->rowCount())
	                	for($i = 0 ; $i < count($result) ; $i++)
	                        echo "<p>Horarios ".($i+1).": ".$result[$i][0]."</p>";
            	}
			?>
			</section>
		</div>
		<?php
			if(isset($_GET['id']))
			{
				echo "<a id='boton'href='../vistas/activity.php?id=".$_GET['id']."'>Mas informacion</a>";
			}
		?>
		<a href='../vistas/activity'></a>
	</body>
</html>