<div class="form-inicio">

	<h1>EDITAR CLIENTE</h1>

	<form method="post">

		<?php  

		$editarCliente = new MvcControllerCliente();
		$editarCliente -> editarClienteController();
		$editarCliente -> actualizarClienteController();

		?>

	</form>



</div>