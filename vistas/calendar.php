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
<?php include 'header.php' ?>
	<div class="container-fluid my-5">
		<div class="row justify-content-center">
			<div class="col-8">
				<table class="calendar-table__container w-100">
					<caption>
						<h1>Calendario</h1>
					</caption>
					<thead>
						<tr>
							<?php
								include 'calendarfunc.php';
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
					</thead>
					<?php
						$primeraCelda = date("w",mktime(0,0,0,$mes,1,$anio))+7;
						$finMes = date("d",(mktime(0,0,0,$mes+1,1,$anio)-1));
						if($primeraCelda >= 8)
							$primeraCelda = $primeraCelda - 7;
						$ultimaCelda = $primeraCelda + $finMes;
						$limite = 6;
						if($ultimaCelda <= 36)
							$limite = 5;
						$contador = 1;
						$dia = 1;
						for($i = 0 ; $i < $limite ; $i++)
						{
							echo "<tr>";
							for($j = 0 ; $j < 7 ; $j++)
							{
								if($contador >= $primeraCelda && $contador < $ultimaCelda)
								{
									if($currentdia == $dia && $mes-1 == $currentmes)
										echo "<th class='today'>";
									else
										echo "<th>";
									echo "<p>".$dia."</p>";
									if($query->rowCount())
									{
										for($k = 0 ; $k < count($result) ; $k++)
										{
											if($result[$k][2] == fechaString($dia,$mes,$anio))
											{
												$caracteresespeciales = $result[$k][1];
												echo "<a href='calendar.php?mes=".$mes."&anio=".$anio."&id=".$result[$k][0]."'>".$caracteresespeciales."</a>";
											}
										}
									}
									$dia++;
								}
								else
								{
									echo "<th>";
								}
								echo "</th>";
								$contador++;
							}
							echo "</tr>";
						}
					?>
				</table>
			</div>

			<div class="col-3 order-last">
				<div class="calendar-info__container mb-5">
					<div class="calendar-info__head">
						<h1>Datos</h1>
					</div>
					<section class="calendar-info__body">
						<?php
							if(isset($_GET['id']))
							{
								$id = $_GET['id'];
								$query = $db->connect()->prepare("SELECT r.nombreActividad,r.nombreCompania,r.lugar,r.fechaProgramacion, r.fechaEvento
																FROM actividad a, programacion p, requerimientoactividad r
																WHERE a.idProgramacion = p.idProgramacion
																AND p.idRequerimientoActividad = r.idRequerimientoActividad
																AND a.idActividad = $id");
								$query->execute();
								$query->setFetchMode(PDO::FETCH_NUM);
								$result = $query->fetchAll();
								if($query->rowCount())
								{//utf8_decode($caracteresespeciales)
									echo $result[0][1]."</p>";
									echo $result[0][0]."</p>";
									echo $result[0][2]."</p>";
									echo "<p>Fecha de programacion: ".$result[0][3]."</p>";
									echo "<p>Fecha del evento: ".$result[0][4]."</p>";
								}
								$query = $db->connect()->prepare("SELECT h.horario
																FROM actividad a, programacion p, requerimientoactividad r, horario h
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
				<div class="calendar-info__container">
					<div class="calendar-info__head">
						<h1>Observaciones</h1>			
					</div>
					<section class="calendar-info__body">
						<?php
							if(isset($_GET['id']))
							{
								$id = $_GET['id'];
								$query = $db->connect()->prepare("SELECT r.observacion
																FROM actividad a, programacion p, requerimientoactividad r
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
				<div class="text-center mt-5">
					<?php
						if(isset($_GET['id']))
							echo "<a  class='button-golden' href='../vistas/activity.php?id=".$_GET['id']."'>Mas informacion</a>";
					?>
				</div>
			</div>
		</div>
	</div>
<?php include 'footer.php' ?>