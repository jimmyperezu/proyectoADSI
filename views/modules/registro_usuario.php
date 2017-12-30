<div class="form-inicio">

	<h1>REGISTRO DE USUARIO</h1>

	<form method="post">
		
		<input type="text" placeholder="Usuario" name="usuarioRegistro" required>

		<input type="password" placeholder="Contraseña" name="passwordRegistro" required>

		<input type="email" placeholder="Email" name="emailRegistro" required>

		<input type="submit" value="Enviar">

	</form>

	<a href="index.php?action=inicio">Ir al Inicio</a>
	<a href="index.php?action=inicio_sesion">Iniciar Sesión</a>

<?php  

$registro = new MvcControllerUsuario();
$registro -> registroUsuarioController();

if(isset($_GET["action"])){
	if($_GET["action"] == "ok"){
		echo '<br><br><p class="resultado">Registro exitoso</p>';
	}
}

?>

</div>

