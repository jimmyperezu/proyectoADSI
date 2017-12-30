<?php  
if(!isset($_SESSION)){
	session_start();
}

if(!$_SESSION["validar"]){

	header("location:index.php?action=inicio_sesion");

	exit();

}

$usuario = new MvcControllerUsuario();
$usuario -> borrarUsuarioController();

?>

<div class="tabla">

	<h1>USUARIOS</h1>

	<table class="usuarios">
		<thead>
			<tr>
				<th>Usuario</th>
				<th>Contraseña</th>
				<th>Email</th>
				<th></th>
				<th></th>

			</tr>
		</thead>

		<tbody>
			
			<?php $usuario -> vistaUsuariosController(); ?>

		</tbody>


	</table>

</div>