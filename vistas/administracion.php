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
<?php include 'header.php' ?>
	<div class="container-fluid">
		<div class="row justify-content-center my-5">
			<div class="col-10">
				<table class="calendar-table__container w-100 text-center">
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
					$query = $db->connect()->prepare('SELECT a.idActividad,r.nombreCompania,r.fechaEvento
													FROM actividad a, programacion p, requerimientoactividad r
													WHERE a.idProgramacion = p.idProgramacion
													AND p.idRequerimientoActividad = r.idRequerimientoActividad');
					$query->execute();
					$query->setFetchMode(PDO::FETCH_NUM);
					$result = $query->fetchAll();
					if($query->rowCount())
					{
						echo "
						<caption>
							<h1>Eventos</h1>
						</caption>
						<thead>
							<tr>
								<th>Compañia</th>
								<th>Fecha del evento</th>
								<th>Informacion</th>
								<th>Actualizar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						";
						for($i = 0 ; $i < count($result) ; $i++)
						{
							echo "<tr>";
							for($j = 1 ; $j < 3 ; $j++)
							{
								echo "<td>".$result[$i][$j]."</td>";
							}
							echo "<td><a href='activityadmin.php?id=".$result[$i][0]."'>Informacion</a></td>";
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
		</div>
	</div>
<?php include 'footer.php' ?>