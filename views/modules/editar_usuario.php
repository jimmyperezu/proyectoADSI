<div class="form-inicio">

	<h1>EDITAR USUARIO</h1>

	<form method="post">
		
		<?php  

		$editarUsuario = new MvcControllerUsuario();
		$editarUsuario -> editarUsuarioController();
		$editarUsuario -> actualizarUsuarioController();

		?>

	</form>



</div>
