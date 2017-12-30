<div class="form-inicio">

	<h1>EDITAR NOVEDAD</h1>

	<form method="post">
		
		<?php  

		date_default_timezone_set('America/Lima');

		$editarNovedad = new MvcControllerNovedad();
		$editarNovedad -> editarNovedadController();
		$editarNovedad -> actualizarNovedadController();

		?>

	</form>



</div>