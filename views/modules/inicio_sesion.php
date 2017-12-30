<div class="form-inicio">

	<h1>INICIO DE SESIÓN</h1>

	<form method="post">
	
		<input type="text" placeholder="Usuario" name="usuarioIngreso" required>

		<input type="password" placeholder="Contraseña" name="passwordIngreso" required>

		<input type="submit" value="Enviar">

	</form>

	<a href="index.php?action=inicio">Ir al Inicio</a>
	<a href="index.php?action=registro_usuario">Registrarse</a>


	<?php  

	$ingreso = new MvcControllerUsuario();
	$ingreso -> ingresoUsuarioController();

	if(isset($_GET["action"])){
		if($_GET["action"] == "fallo"){
			echo '<br><br><p class="fallo">Error al ingresar</p>';
		}
	}

	?>
</div>