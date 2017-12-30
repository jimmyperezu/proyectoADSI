<div class="form-inicio">

	<h1>EDITAR AGENCIA</h1>

	<form method="post">
		
		<?php  

		$editarAgencia = new MvcControllerAgencia();
		$editarAgencia -> editarAgenciaController();
		$editarAgencia -> actualizarAgenciaController();

		?>

	</form>



</div>