<?php
	$numberVisas = substr_count("$_SERVER[REQUEST_URI]", "vistas");
	if($numberVisas >= 1)
		$isInside = true;
	else
		$isInside = false;
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<?php echo $isInside ? "<link rel='stylesheet' href='../styles/general.css'>" : "<link rel='stylesheet' href='styles/general.css'>" ?>
		<title>Sitio de la FES Acatlán</title>
	</head>
	<body>
		<header>
			<section class="main-header-logos__container">
				<div class="container-fluid">
					<div class="row justify-content-around mt-2">
						<div class="col-4">
							<div class="text-left">
							<?php echo $isInside ? "<img src='../img/logo_UNAM.png'>" : "<img src='img/logo_UNAM.png'>" ?>
							</div>
						</div>
						<div class="col-4">
							<div class="text-right">
							<?php echo $isInside ? "<img src='../img/logo_fesa.png'>" : "<img src='img/logo_fesa.png'>" ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="main-header-menu__container">
				<div class="container-fluid">
					<div class="row justify-content-center">
						<div class="col-10 my-3">
							<div>
								<ul class="main-header-menu__list">
									<li>
										<?php echo $isInside ? "<a href='../vistas/calendar.php'>" : "<a href='vistas/calendar.php'>" ?>
										Calendario</a>
									</li>
									<li>
										<?php echo $isInside ? "<a href='../vistas/administracion.php'>" : "<a href='vistas/administracion.php'>" ?>
										Administracion de Actividades</a>
									</li>
									<li>
										<?php echo $isInside ? "<a href='../vistas/fase1.php'>" : "<a href='vistas/fase1.php'>" ?>
										Nueva actividad</a>
									</li>
									<?php echo $isInside ? 
									"
										<li>
											<a href='../includes/logout.php'>Cerrar sesion</a>
										</li>
									"
									:
									""
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
		</header>