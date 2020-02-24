<?php include 'header.php' ?>
	<div class="container-fluid mt-5 mb-4">
		<div class="row justify-content-center">
			<div class="col-4">
				<div class="main-login__container text-center" id="inicioSesion">
					<section class="main-login__head">
						<h1>Iniciar sesion</h1>
					</section>
					<section class="main-login__body my-4">
						<form action="" method="post">
							<div class="mb-4">
								<p class="mr-3">Usuario: </p><input type="text" name="username" value="Usuario" onFocus="if (this.value=='Usuario') this.value='';">
							</div>
							<div class="mb-4">
								<p class="mr-3">Contraseña: </p><input type="password" name="password" value="Contraseña" onFocus="if (this.value=='Contraseña') this.value='';">
							</div>
							<input class="button-golden" id="boton" type="submit" value="Iniciar sesion">
						</form>
					</section>
				</div>
			</div>
		</div>
	</div>
	<?php 
		if(isset($errorLogin))
		{
			echo 
			"
			<div class='container-fluid mb-5'>
				<div class='row justify-content-center'>
					<div class='col-6'>
						<div class='main-login-error text-center'>
							<p>".$errorLogin."</p>
						</div>
					</div>
				</div>
			</div>
			";				
		}
	?>
<?php include 'footer.php' ?>