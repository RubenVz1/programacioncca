<!DOCTYPE html>
<html lang = "es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Inicio de sesion</title>
		<link rel="stylesheet" href="styles/indexStylo.css">
		<link href="img/icon.ico" type="image/ico" rel="shortcut icon">
	</head>
	<body>
		<div id="inicioSesion">
			<section id="cabecera">
				<h1>Iniciar sesion</h1>
			</section>
			<section id="cuerpo">
				<form action="" method="post">
					<p>Usuario: </p><input type="text" name="username" value="Usuario" onFocus="if (this.value=='Usuario') this.value='';"><br>
					<p>Contraseña: </p><input type="password" name="password" value="Contraseña" onFocus="if (this.value=='Contraseña') this.value='';"><br>
					<input id = "boton"type="submit" value="Iniciar sesion">
				</form>
			</section>
		</div>
		
			<?php 
				if(isset($errorLogin))
				{
					echo "<div id='error'>";
					echo "<style type="."text/css".">
					#error
					{
						grid-area: c;
						background-color: rgb(75,86,92);
						padding-top: 5px;
						color: white;
						border: 1px solid black;
						box-shadow: 3px 3px 10px black;
						height: 25px;
						width: 300px;
						margin: auto;
					}
					</style>", $errorLogin;
					echo "</div>";
					
				}
			?>
		
	</body>
</html>