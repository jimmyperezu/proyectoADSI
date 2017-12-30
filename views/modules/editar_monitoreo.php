<div class="form-inicio">

	<h1>EDITAR MONITOREO</h1>

	<form method="post">
		
		<?php  

		date_default_timezone_set('America/Lima');

		$editarMonitoreo = new MvcControllerMonitoreo();
		$editarMonitoreo -> editarMonitoreoController();
		$editarMonitoreo -> actualizarMonitoreoController();

		?>

	</form>



</div>