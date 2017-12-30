<div class="form-inicio">

	<h1>EDITAR ASIGNACIÓN</h1>

	<form method="post">
		
		<?php  

		date_default_timezone_set('America/Lima');

		$editarAsignacion = new MvcControllerAsignacion();
		$editarAsignacion -> editarAsignacionController();
		$editarAsignacion -> actualizarAsignacionController();

		?>

	</form>



</div>